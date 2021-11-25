<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\contactMail;

class mailController extends Controller
{
    public function sendEmail($mail){

       // $test = user::with('usersName')->get();
        $data = [
            'name' => " mail from welyne",
            'verfication_code' => "hello from welyne we are testin mail send"
        ];

        Mail::to($mail)->send(new contactMail($data));
        return "email envoyée";
    }
}
