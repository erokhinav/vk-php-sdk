<?php

namespace VK\Exceptions\Api;

class ApiEnabledInTestException extends VKApiException {
    public function __construct($message) {
        parent::__construct(11,  'In test mode application should be disabled or user should be authorized',  $message);
    }
}
