<?php
namespace App\Utilities;

class JsonUtil
{
    private static $meta = [
        'version' => 1
    ];

    private static $paginateKeys = ['total', 'per_page', 'current_page', 'last_page'];

    public static function error($message = 'Error', $status = 422, $exceptions = null)
    {
        self::$meta['status'] = $status;

        $response = [
            'meta' => self::$meta,
            'message' => $message
        ];

        if ($exceptions) {
            $response['exceptions'] = $exceptions;
            return response()->json($response, self::$meta['status'], ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }

        return response()->json($response, self::$meta['status'], ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public static function success($message = 'success', $responseData = [])
    {
        self::$meta['status'] = 200;

        $response = [
            'meta' => self::$meta,
            'message' => $message
        ];

        foreach ($responseData as $key => $item) {
            $response[$key] = $item;
        }

        return response()->json($response, self::$meta['status'], ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public static function data($collection = null, $withPagination = false, $options = [])
    {
        self::$meta['status'] = 200;

        $response = [
            'meta' => self::$meta
        ];

        if ($withPagination) {
            $filtered = array_filter($collection, function($key) {
                return in_array($key, self::$paginateKeys);
            }, ARRAY_FILTER_USE_KEY);

            $response['pagination'] = $filtered;
            $response['data'] = $collection['data'];
        } else {
            $response['data'] = $collection;
        }

        if (count($options)) {
            foreach ($options as $option) {
                $response[$option] = $collection[$option];
            }
        }

        return response()->json($response, self::$meta['status'], ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
    }
}
