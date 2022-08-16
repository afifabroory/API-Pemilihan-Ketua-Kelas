<?php

namespace App\Http\Controllers;

use App\Models\Candidate;

class CandidateController extends Controller
{
    public function index() {
        $data = Candidate::get();

        return response($data, 201)
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', 'http://localhost');;
    }
}