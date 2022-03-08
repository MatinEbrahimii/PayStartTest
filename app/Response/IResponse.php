<?php


namespace App\Http\Response;

interface IResponse
{
    static function send(array $error_content, array $response = []);
}
