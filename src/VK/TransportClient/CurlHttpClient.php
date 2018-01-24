<?php

namespace VK\TransportClient;

use VK\Exceptions\VKClientException;

class CurlHttpClient implements TransportClient {
    const UPLOAD_CONTENT_TYPE_HEADER = 'Content-Type: multipart/form-data';

    protected $connection_timeout;
    protected $initial_opts;

    public function __construct($connection_timeout) {
        $this->connection_timeout = $connection_timeout;
        $this->initial_opts = array(
            CURLOPT_POST => 1,
            CURLOPT_HEADER => true,
            CURLOPT_CONNECTTIMEOUT => $this->connection_timeout,
            CURLOPT_RETURNTRANSFER => true,
        );
    }

    /**
     * Makes post request.
     *
     * @param string $url
     * @param array $payload
     *
     * @return TransportClientResponse
     * @throws VKClientException
     */
    public function post($url, $payload = null) {
        return $this->sendRequest($url, array(
            CURLOPT_POSTFIELDS => $payload
        ));
    }

    /**
     * Makes upload request.
     *
     * @param string $url
     * @param string $parameter_name
     * @param string $path
     *
     * @return TransportClientResponse
     * @throws VKClientException
     */
    public function upload($url, $parameter_name, $path) {
        $payload = array();
        $payload[$parameter_name] = (class_exists('CURLFile', false)) ?
            new \CURLFile($path) : '@' . $path;

        return $this->sendRequest($url, array(
            CURLOPT_HTTPHEADER => array(
                static::UPLOAD_CONTENT_TYPE_HEADER,
            ),
            CURLOPT_POSTFIELDS => $payload
        ));
    }

    /**
     * Makes and sends request.
     *
     * @param string $url
     * @param array $opts
     *
     * @return TransportClientResponse
     * @throws VKClientException
     */
    public function sendRequest($url, $opts) {
        $curl = curl_init($url);

        curl_setopt_array($curl, $this->initial_opts + $opts);

        $response = curl_exec($curl);

        $curl_error_code = curl_errno($curl);
        $curl_error = curl_error($curl);

        curl_close($curl);

        if ($curl_error || $curl_error_code) {
            throw new VKClientException($curl_error, $curl_error_code);
        }

        return $this->parseRawResponse($response);
    }

    /**
     * Breaks the raw response down into its headers, body and http status code.
     *
     * @param string $response
     *
     * @return TransportClientResponse
     */
    protected function parseRawResponse($response) {
        list($raw_headers, $body) = $this->extractResponseHeadersAndBody($response);
        list($http_status, $headers) = $this->getHeaders($raw_headers);
        return new TransportClientResponse($http_status, $headers, $body);
    }

    /**
     * Extracts the headers and the body into a two-part array.
     *
     * @return array
     */
    protected function extractResponseHeadersAndBody($response) {
        $parts = explode("\r\n\r\n", $response);
        $raw_body = array_pop($parts);
        $raw_headers = implode("\r\n\r\n", $parts);

        return [trim($raw_headers), trim($raw_body)];
    }

    /**
     * Parses the raw headers and sets as an array.
     *
     * @param string The raw headers from the response.
     *
     * @return array
     */
    protected function getHeaders($raw_headers) {
        // Normalize line breaks
        $raw_headers = str_replace("\r\n", "\n", $raw_headers);

        // There will be multiple headers if a 301 was followed
        // or a proxy was followed, etc
        $header_collection = explode("\n\n", trim($raw_headers));
        // We just want the last response (at the end)
        $raw_header = array_pop($header_collection);

        $header_components = explode("\n", $raw_header);
        $result = array();
        $http_status = 0;
        foreach ($header_components as $line) {
            if (strpos($line, ': ') === false) {
                $http_status = $this->getHttpStatus($line);
            } else {
                list($key, $value) = explode(': ', $line, 2);
                $result[$key] = $value;
            }
        }

        return array($http_status, $result);
    }

    /**
     * Sets the HTTP response code from a raw header.
     *
     * @param string
     *
     * @return int
     */
    protected function getHttpStatus($raw_response_header) {
        preg_match('|HTTP/\d\.\d\s+(\d+)\s+.*|', $raw_response_header, $match);
        return (int)$match[1];
    }
}