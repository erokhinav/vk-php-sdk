<?php

namespace VK\Exceptions\Api;

class ApiPermissionException extends VKApiException {
    public function __construct($message) {
        parent::__construct(7,  'Permission to perform this action is denied',  $message);
    }
}
