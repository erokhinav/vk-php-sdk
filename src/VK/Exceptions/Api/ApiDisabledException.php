<?php

namespace VK\Exceptions\Api;

class ApiDisabledException extends VKApiException {
    public function __construct($message) {
        parent::__construct(2,  'Application is disabled. Enable your application or use test mode',  $message);
    }
}
