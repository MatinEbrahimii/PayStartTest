<?php


namespace App\Http\Response;

class StatusCodes
{
    const MESSAGE = 'message', HEADER_CODE = 'header_code';

    const CREATED = [
        self::MESSAGE => 'CREATED',
        self::HEADER_CODE => 201
    ];

    const SUCCESS = [
        self::MESSAGE => 'SUCCESS',
        self::HEADER_CODE => 200
    ];

    const NOT_FOUND = [
        self::MESSAGE => 'NOT_FOUND',
        self::HEADER_CODE => 404
    ];

    const INVALID_INPUT = [
        self::MESSAGE => 'INVALID_INPUT',
        self::HEADER_CODE => 422
    ];

    const BAD_REQUEST = [
        self::MESSAGE => 'BAD_REQUEST',
        self::HEADER_CODE => 400
    ];

    const UPDATED = [
        self::MESSAGE => 'Updated',
        self::HEADER_CODE => 204
    ];

    const UNAUTHORIZED = [
        self::MESSAGE => 'UNAUTHORIZED',
        self::HEADER_CODE => 401
    ];

    const FORBIDDEN = [
        self::MESSAGE => 'FORBIDDEN',
        self::HEADER_CODE => 403
    ];
}
