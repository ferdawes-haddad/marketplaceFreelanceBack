<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class contactController extends Controller
{
    public function create()
    {
        /*$contact = [
            'title' => 'ferdawes',
            'body' => 'Je voulais vous dire que votre site est magnifique !'
        ];
        \Contact::to('ferdawes.haddad@sesame.com.tn')->send (new \App\Mail\Contact($contact));
        echo ("Email envoyée !!!");*/

        //return view('contact');
    }

    public function store(ContactRequest $request)
    {
        Mail::to('ferdaweshaddad2@gmail.com')
            ->send(new Contact($request->except('_token')));

        //return view('confirm');
    }



}
