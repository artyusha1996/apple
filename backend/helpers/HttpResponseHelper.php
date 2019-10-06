<?php
namespace App\Helpers;

class HttpResponseHelper
{
    /**
     * Http codes
     */
    const SUCCESS                              = 200;
    const CREATED                              = 201;
    const NO_CONTENT                           = 204;
    const BAD_REQUEST                          = 400;
    const AUTHENTICATION_FAILED                = 401;
    const PERMISSION_DENIED                    = 403;
    const NOT_FOUND                            = 404;
    const DUPLICATE_REQUEST                    = 409;
    const SERVER_SIDE_PROBLEM                  = 500;

    const APPLE_ALREADY_FALLED                 = 601;
    const VALIDATION_ERROR                     = 602;
    const INVALID_CREDENTIALS                  = 603;

    /**
     * @var array
     */
    public static $titles = [
        // main statuses
        self::CREATED                              => ['httpCode' => self::CREATED,                    'message' => ''],
        self::NO_CONTENT                           => ['httpCode' => self::NO_CONTENT,                 'message' => ''],
        self::AUTHENTICATION_FAILED                => ['httpCode' => self::AUTHENTICATION_FAILED,      'message' => 'http_response.unauthorized'],
        self::PERMISSION_DENIED                    => ['httpCode' => self::PERMISSION_DENIED,          'message' => 'http_response.permission_denied'],
        self::NOT_FOUND                            => ['httpCode' => self::NOT_FOUND,                  'message' => 'http_response.not_found'],
        self::DUPLICATE_REQUEST                    => ['httpCode' => self::DUPLICATE_REQUEST,          'message' => 'http_response.duplicate_request'],
        self::SERVER_SIDE_PROBLEM                  => ['httpCode' => self::SERVER_SIDE_PROBLEM,        'message' => 'http_response.server_side_problem'],
        self::BAD_REQUEST                          => ['httpCode' => self::BAD_REQUEST,                'message' => 'http_response.bad_request'],

        // application statuses
        self::APPLE_ALREADY_FALLED                 => ['httpCode' => self::BAD_REQUEST,                  'message' => 'The apple has already been falled.'],
        self::VALIDATION_ERROR                     => ['httpCode' => self::BAD_REQUEST,                  'message' => null],
        self::INVALID_CREDENTIALS                  => ['httpCode' => self::AUTHENTICATION_FAILED,        'message' => 'http_response.invalid_credentials'],
    ];
}
