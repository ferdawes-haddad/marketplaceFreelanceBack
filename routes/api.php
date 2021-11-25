<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\ChangePasswordController;
/*
Route::group([
    'middleware' => 'api',
], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Emplois
//Route::get('emploi', 'EmploisController@getEmplois');
Route::get('emplois/{id}', 'EmploisController@getEmploisById');
Route::post('addEmplois', 'EmploisController@ajoutEmplois');
Route::put('updateEmplois/{id}', 'EmploisController@updateEmplois');
Route::delete('deleteEmplois/{id}', 'EmploisController@deleteEmplois');
Route::get('userName/{id}', 'EmploisController@getUserByEmplois');
Route::get('allEmplois', 'EmploisController@getallEmplois');
Route::get('image/{filename}', 'EmploisController@displayImage')->name('image.displayImage');
Route::post('uploadimage/{id}', 'EmploisController@uploadimage');
Route::post('getUser', 'EmploisController@getUser');

//Missions
Route::get('missions', 'MissionController@getMission');
Route::get('mission/{id}', 'MissionController@getMissionById');
Route::post('addMission', 'MissionController@addMission');
Route::put('updateMission/{id}', 'MissionController@updateMission');
Route::delete('deleteMission/{id}', 'MissionController@deleteMission');

//Articles
Route::get('articles', 'ArticleController@getArticle');
Route::get('article/{id}', 'ArticleController@getArticleById');
Route::post('addArticle', 'ArticleController@addArticle');
Route::put('updateArticle/{id}', 'ArticleController@updateArticle');
Route::delete('deleteArticle/{id}', 'ArticleController@deleteArticle');

Route::get('imagearticle/{filename}', 'ArticleController@displayImage')->name('image.displayImage');
Route::post('uploadimagearticle/{id}', 'ArticleController@uploadimage');

//Categories
Route::get('categories', 'CategoriesController@getCategorie');
Route::get('categorie/{id}', 'CategoriesController@getCategorieById');
Route::post('addCategorie', 'CategoriesController@addCategorie');
Route::put('updateCategorie/{id}', 'CategoriesController@updateCategorie');
Route::delete('deleteCategorie/{id}', 'CategoriesController@deleteCategorie');

//SkylesEmplois
Route::get('skillsEmplois', 'skillsEmploisController@getSkyles');
Route::get('skillsEmplois/{id}', 'skillsEmploisController@getSkylesById');
Route::get('skillsEmploisT/{type}', 'skillsEmploisController@getSkylesTechnique');
Route::get('skillsEmploisF/{type}', 'skillsEmploisController@getSkylesFonctionnel');
Route::post('addSkillsEmplois', 'skillsEmploisController@addSkyles');
Route::put('updateSkillsEmplois/{id}', 'skillsEmploisController@updateSkyles');
Route::delete('deleteSkillsEmplois/{id}', 'skillsEmploisController@deleteSkyles');
Route::get('skillsEmploisTitreT/{type}', 'skillsEmploisController@getTitreSkylesTechnique');

//skills
Route::get('skills', 'SkillsController@getSkills');
Route::get('skill/{id}', 'SkillsController@getSkillsById');
Route::post('addSkills', 'SkillsController@addSkills');
Route::put('updateSkills/{id}', 'SkillsController@updateSkills');
Route::delete('deleteSkills/{id}', 'SkillsController@deleteSkills');

//Curriculum
Route::get('allcvs', 'CvController@getall');
Route::get('cvs/{id}', 'CvController@getCVById');
Route::post('addCv', 'CvController@addCV');
Route::put('updateCv/{id}', 'CvController@updateCV');
Route::delete('deleteCv/{id}', 'CvController@deleteCV');

//User
Route::get('users', 'UserController@getUsers');
Route::get('user/{id}', 'UserController@getUserById');
//Route::post('addUser', 'UserController@addUser');
Route::put('updateUser/{id}', 'UserController@updateUser');
Route::delete('deleteUser/{id}', 'UserController@deleteUser');
Route::post('register', 'UserController@register');
Route::get('freelancers/{role}', 'UserController@getFreelancer');
Route::get('esns/{role}', 'UserController@getESN');
Route::post('addFreelancer', 'UserController@addFreelancer');

Route::get('imageuser/{filename}', 'UserController@displayImage')->name('image.displayImage');
Route::post('uploadimageuser/{id}', 'UserController@uploadimage');

//login
Route::post('login', 'UserController@login');

//EmploisSkyles (skillsEmplois)
Route::get('empsskyles', 'EmploisSkylesController@getEmploisSkyles');
Route::get('empskyles/{id}', 'EmploisSkylesController@getEmploisSkylesById');
Route::post('addEmpSkyles', 'EmploisSkylesController@ajoutEmploisSkyles');
Route::put('updateEmpSkyles/{id}', 'EmploisSkylesController@updateEmploisSkyles');
Route::delete('deleteEmpSkyles/{id}', 'EmploisSkylesController@deleteEmploisSkyles');
Route::get('EmploisBySkilles', 'EmploisSkylesController@getEmploisBySkills');

//UserSkyles  (skills+user)
Route::get('usersSkyles', 'UserSkylesController@getUserSkyles');
Route::get('userSkyles/{id}', 'UserSkylesController@getUserSkylesById');
Route::post('addUserSkyl', 'UserSkylesController@addUserSkyles');
Route::put('updateUserSkyles/{id}', 'UserSkylesController@updateUserSkyles');
Route::delete('deleteUserSkyles/{id}', 'UserSkylesController@deleteUserSkyles');

//Mail postulation
Route::get('send-email/{mail}', 'mailController@sendEmail')->name('test_mail');

//mail acceptation
Route::get('mission-email/{mail}', 'missionMailController@sendEmail')->name('test_mail');

Route::get('chat', 'chatController@Messagerie');
//Route::get('chat',[chatController::class, 'chat']);

//Webinar
Route::get('webinars', 'webinarController@getWebinar');
Route::get('webinars/{id}', 'webinarController@getWebinarById');
Route::post('addWebinnar', 'webinarController@addEvenement');
Route::put('updateWebinar/{id}', 'webinarController@updateWebinar');
Route::delete('deleteWebinar/{id}', 'webinarController@deleteWebinar');
Route::get('allwebinars', 'webinarController@getallWebinar');


//Route::post('/reset-password-request','PasswordResetRequestController@sendPasswordResetEmail');
//Route::post('/change-password', 'ChangePasswordController@passwordResetProcess');

Route::post('/reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
Route::post('/change-password', [ChangePasswordController::class, 'passwordResetProcess']);
//Route::post('/change-password',  'ChangePasswordController@changePassword');
