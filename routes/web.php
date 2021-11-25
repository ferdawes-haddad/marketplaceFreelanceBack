<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/', 'CurriculumController@getCV');

Route::get('/send-notification', [NotificationController::class, 'sendOfferNotification']);


Route::get('/send-mail', function () {
    $contact = [
        'title' => 'ferdawes',
        'body' => 'Je voulais vous dire que votre site est magnifique !'
    ];
    \Contact::to('ferdawes.haddad@sesame.com.tn')->send (new \App\Mail\Contact($contact));
    echo ("Email envoyée !!!");
});

Route::get('/chat', function () {
    return view('chat');
});

