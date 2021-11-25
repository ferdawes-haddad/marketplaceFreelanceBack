<?php

namespace App\Http\Controllers;

use App\Mail\missionMail ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class missionMailController extends Controller
{
    public function sendEmail($mail){
        $data = [
            'name' => " mail from welyne",
            'verfication_code' => "hello from welyne we are testin mail send"
        ];

        Mail::to($mail)->send(new missionMail($data));
        return "mission acceptée";
    }
}
