<?php

namespace App\Http\Controllers;

use App\Models\NotYetVoted;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    public function verify(Request $req) {
        $nim = $req->input('nim');

        $isValid = !is_null(NotYetVoted::where('nim', $nim)->first());
        $data = [
            'voter' => $nim,
            'valid' => $isValid,
        ];

        if ($nim != '' && !$isValid) 
            $data['message'] = 'Hak suara sudah digunakan';


        return response($data)
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', 'http://localhost');
    }

    public function vote(Request $req) {
        Vote::create([
            'voter' => "{$req->input('nim')}",
            'candidate' => "{$req->input('candidate')}",
        ]);

        return response(null, 201);
    }
}