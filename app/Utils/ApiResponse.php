<?php

namespace App\Utils;

class ApiResponse
{
    static function error(String $message, Int $statut = 500)
    {
        return response($statut)->json([
            "statut" => "error",
            "error" => $message
        ]);
    }


    static function done($data, String $message = "")
    {
        return response()->json([
            "statut" => "success",
            "data" => $data,
            "message" => $message
        ]);
    }
}