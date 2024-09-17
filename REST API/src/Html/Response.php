<?php

namespace App\Html;

class Response
{
    const STATUSES = [
        100 => "Continue",
        101 => "Switching Protocols",
        200 => "OK",
        201 => "Continue",
        400 => "Bad Request",
        404 => "Not found",
    ];

    public function __call($name,$arguments)
    {
        $this->response(['data' => []], 404);
    }

    static function response(
        array $data, $code = 200, $message ='')
    {
        if (isset(self::STATUSES[$code])) {
            http_response_code($code);
            if (!$message) {
                $message = self::STATUSES[$code];
            }
            $protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.0';
            header($protocol . ' ' . $code . ' ' . self::STATUSES[$code]);
        }
        header('Content-Type: application/json');
        $response = [
            'data' => $data,
            'message' => $message,
            'code' => $code,
        ];

        echo json_encode($response, JSON_THROW_ON_ERROR);
    }



}