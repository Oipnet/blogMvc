<?php

namespace Core\Exception;

class NotAllowedException extends \Exception {
    public function __construct($message)
    {
        parent::__construct($message);
    }
}