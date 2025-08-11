<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function apiResponseSuccess($data)
    {
        return response()->json(['status' => 200, 'message' => "OKE", 'data' => $data]);
    }

    public function apiResponseBadRes($data)
    {
        return response()->json(['status' => 400, 'message' => "BAD_REQUEST", 'data' => $data], 400);
    }

    public function apiResponseUnauthorized($data)
    {
        return response()->json(['status' => 401, 'message' => "UNAUTHORIZE", 'data' => $data], 401);
    }

    public function apiResponseNotFound($data)
    {
        return response()->json(['status' => 404, 'message' => "NOT_FOUND", 'data' => $data], 404);
    }

    public function apiResponseServerError($data)
    {
        return response()->json(['status' => 500, 'message' => "NOT_FOUND", 'data' => $data], 500);
    }
}
