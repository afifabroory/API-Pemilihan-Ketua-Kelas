<?php

namespace App\Http\Controllers;

use App\Models\NotYetVoted;
use App\Models\Result;

class DataController extends Controller
{
    public function result() {
        $data = Result::get();

        return response($data)
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', 'http://localhost');
    }

    public function voter() {
        $golput = count(NotYetVoted::get());
        $voted = 24 - $golput;

        $data = [
            "golput" => $golput,
            "memilih" => $voted,
        ];

        return response($data)
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', 'http://localhost');
    }
}