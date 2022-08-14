<?php

namespace App\Http\Controllers;

use App\Models\Candidate;

class CandidateController extends Controller
{
    public function index() {
        $data = Candidate::get();

        return response($data, 201);
    }
}