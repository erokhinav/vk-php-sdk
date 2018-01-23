<?php

namespace VK\Actions;

use VK\VKAPIClient;
use VK\Exceptions\VKClientException;
use VK\VKResponse;

class Secure {
    /**
     * @var VKAPIClient
     **/
    private $client;

    public function __construct($client) {
        $this->client = $client;
    }

    /**
     * Returns payment balance of the application in hundredth of a vote.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getAppBalance($access_token, $params = array()) {
        return $this->client->request('secure.getAppBalance', $access_token, $params);
    }

    /**
     * Shows history of votes transaction between users and the application.
     * 
     * @param $access_token string
     * @param $params array
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getTransactionsHistory($access_token, $params = array()) {
        return $this->client->request('secure.getTransactionsHistory', $access_token, $params);
    }

    /**
     * Shows a list of SMS notifications sent by the application using
     * [vk.com/dev/secure.sendSMSNotification|secure.sendSMSNotification] method.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id:
     *      - integer date_from: filter by start date. It is set as UNIX-time.
     *      - integer date_to: filter by end date. It is set as UNIX-time.
     *      - integer limit: number of returned posts. By default — 1000.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getSMSHistory($access_token, $params = array()) {
        return $this->client->request('secure.getSMSHistory', $access_token, $params);
    }

    /**
     * Sends 'SMS' notification to a user's mobile device.
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: ID of the user to whom SMS notification is sent. The user shall allow the
     *        application to send him/her notifications (, +1).
     *      - string message: 'SMS' text to be sent in 'UTF-8' encoding. Only Latin letters and numbers are
     *        allowed. Maximum size is '160' characters.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function sendSMSNotification($access_token, $params = array()) {
        return $this->client->request('secure.sendSMSNotification', $access_token, $params);
    }

    /**
     * Sends notification to the user.
     * 
     * @param $access_token string
     * @param $params array
     *      - array user_ids:
     *      - integer user_id:
     *      - string message: notification text which should be sent in 'UTF-8' encoding ('254' characters
     *        maximum).
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function sendNotification($access_token, $params = array()) {
        return $this->client->request('secure.sendNotification', $access_token, $params);
    }

    /**
     * Sets a counter which is shown to the user in bold in the left menu.
     * 
     * @param $access_token string
     * @param $params array
     *      - array counters:
     *      - integer user_id:
     *      - integer counter: counter value.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function setCounter($access_token, $params = array()) {
        return $this->client->request('secure.setCounter', $access_token, $params);
    }

    /**
     * Sets user game level in the application which can be seen by his/her friends.
     * 
     * @param $access_token string
     * @param $params array
     *      - array levels:
     *      - integer user_id:
     *      - integer level: level value.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function setUserLevel($access_token, $params = array()) {
        return $this->client->request('secure.setUserLevel', $access_token, $params);
    }

    /**
     * Returns one of the previously set game levels of one or more users in the application.
     * 
     * @param $access_token string
     * @param $params array
     *      - array user_ids:
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function getUserLevel($access_token, $params = array()) {
        return $this->client->request('secure.getUserLevel', $access_token, $params);
    }

    /**
     * Adds user activity information to an application
     * 
     * @param $access_token string
     * @param $params array
     *      - integer user_id: ID of a user to save the data
     *      - integer activity_id: there are 2 default activities: , * 1 – level. Works similar to ,, * 2 –
     *        points, saves points amount, Any other value is for saving completed missions
     *      - integer value: depends on activity_id: * 1 – number, current level number,, * 2 – number, current
     *        user's points amount, , Any other value is ignored
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function addAppEvent($access_token, $params = array()) {
        return $this->client->request('secure.addAppEvent', $access_token, $params);
    }

    /**
     * Checks the user authentication in 'IFrame' and 'Flash' apps using the 'access_token' parameter.
     * 
     * @param $access_token string
     * @param $params array
     *      - string token: client 'access_token'
     *      - string ip: user 'ip address'. Note that user may access using the 'ipv6' address, in this case it is
     *        required to transmit the 'ipv6' address. If not transmitted, the address will not be checked.
     * 
     * @return VKResponse
     * @throws VKClientException
     * 
     **/
    public function checkToken($access_token, $params = array()) {
        return $this->client->request('secure.checkToken', $access_token, $params);
    }
}