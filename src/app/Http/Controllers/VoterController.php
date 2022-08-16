<?php

namespace App\Http\Controllers;

use App\Models\NotYetVoted;
use App\Models\Vote;
use App\Models\Token;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VoterController extends Controller
{
    public function verify(Request $req) {
        $nim = $req->input('nim');

        $isValid = !is_null(NotYetVoted::where('nim', $nim)->first());

        $token = hash('sha256', Str::random(60));
        $data = [
            'voter' => $nim,
            'valid' => $isValid,
        ];

        if ($nim != '' && !$isValid) 
            $data['message'] = 'Hak suara sudah digunakan atau tidak terdaftar';
        else 
            $data['token'] = $token;

        Token::where('Voter_NIM', $nim)
            ->update(['token' => $token]);

        return response($data)
            ->header('Content-type', 'application/json')
            ->header('Access-Control-Allow-Origin', 'http://localhost');
    }

    public function vote(Request $req) {
        $nim = $req->input('nim');
        $candidate = $req->input('candidate');
        $token = $req->input('token');

        if (is_null(NotYetVoted::where('nim', $nim)->first()) == true) {
            Token::where('Voter_NIM', $nim)
                ->update(['token' => hash('sha256', Str::random(60))]);

            return response([
                'voter' => $nim,
                'message' => 'Hak suara sudah digunakan',
            ])->header('Content-type', 'application/json')
              ->header('Access-Control-Allow-Origin', 'http://localhost');
        }

        if ($token != Token::where('Voter_NIM', $nim)->first()['token']) {
            Token::where('Voter_NIM', $nim)
                ->update(['token' => hash('sha256', Str::random(60))]);

            return response([
                'voter' => $nim,
                'message' => 'Token tidak valid!',
            ])->header('Content-type', 'application/json')
              ->header('Access-Control-Allow-Origin', 'http://localhost');
        }

        Token::where('Voter_NIM', $nim)
            ->update(['token' => hash('sha256', Str::random(60))]);

        Vote::create([
            'voter' => "$nim",
            'candidate' => "$candidate",
        ]);

        return response(null, 201)
            ->header('Access-Control-Allow-Origin', 'http://localhost');
    }

    public function cors() {
        return response('')
        ->header('Access-Control-Allow-Headers', 'Content-type')
        ->header('Access-Control-Allow-Origin', 'http://localhost');
    }
}