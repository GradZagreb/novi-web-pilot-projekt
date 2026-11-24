<?php

namespace gradZagrebWeb2024\exception;
use Exception;
use Throwable;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class SendMailException extends Exception
{
    public function __construct( $message, $code = 0, Throwable $previous = null ) {
        parent::__construct( $message, $code, $previous );
    }
}
