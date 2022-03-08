<?php


namespace App\Http\Response;

class JsonResponse implements IResponse
{
    static function send(array $error_content, array $response = [])
    {
        $error = TRUE;

        if (
            $error_content['header_code'] == StatusCodes::SUCCESS['header_code']
        ) {
            $error = FALSE;
        }

        $error_array = ['error' => $error, 'header_code' => $error_content['header_code'], 'message' => $error_content['message']];

        if (count($response) > 0) {
            if (isset($response['message'])) {
                $error_array['meta'] = $response['message'];
                unset($response['message']);
            }
            $error_array['data'] = $response;
        } else {
            $error_array['data'] = null;
        }

        return response()->json($error_array, $error_content['header_code']);
    }
}
