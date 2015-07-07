<?php

use These\Admin\Database\BackupDBTable;

$router->get('csv', function ($table = ['answers', 'failed_jobs']) {
    $backup = new BackupDBTable($table);

    return $backup->saveToCSV(storage_path().'/db-backups/');
});
//////////////////
// Static Pages //
//////////////////
$router->get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

/////////////////
// City search //
/////////////////
$router->get('city/{search?}', 'CityController@show');

//////////////////
// Mailing list //
//////////////////
$router->get('subscribe/med-centers/all', ['as' => 'subscribe.medcenters.all', 'uses' => 'SubscriptionController@importCentersInNewsletterManager']);

$router->post('subscribe/{toWhat?}', ['as' => 'subscribe.answerer', 'uses' => 'SubscriptionController@subscribeAnswerer']);
$router->post('unsubscribe/{fromWhat?}', ['as' => 'unsubscribe.answerer', 'uses' => 'SubscriptionController@unSubscribeAnswerer']);

///////////////////
// Questionnaire //
///////////////////
$router->get('answer/{token?}', ['as' => 'survey.index', 'uses' => 'SurveyController@index']);
$router->post('answer', 'SurveyController@store');

$router->get('thankyou', ['as' => 'answer.saved', 'uses' => 'PagesController@thankyou']);

/////////////
// Results //
/////////////
$router->get('results', ['as' => 'results.index', 'uses' => 'ResultsController@index']);
$router->get('results/listAllAnswers', ['as' => 'results.listAllAnswers', 'uses' => 'ResultsController@listAllAnswers']);
$router->get('results/listExploded', ['as' => 'results.listAllExploded', 'uses' => 'ResultsController@listAllExplodedAnswers']);
$router->get('results/analyse', ['as' => 'results.analyse', 'uses' => 'ResultsController@analyse']);
$router->get('results/admin', ['as' => 'results.admin', 'uses' => 'ResultsController@admin']);

///////////
// Admin //
///////////
$router->get('admin/log/{filename}', ['as' => 'log.view', 'uses' => 'AdminController@viewLog']);

/////////
// API //
/////////
$router->group(['prefix' => 'api/v1/'], function () use ($router) {
    $router->get('answers', 'ApiController@answers');
    $router->get('answers/{answerId}', 'ApiController@answer');
});

/*
|--------------------------------------------------------------------------
| Authentication & Password Reset Controllers
|--------------------------------------------------------------------------
|
| These two controllers handle the authentication of the users of your
| application, as well as the functions necessary for resetting the
| passwords for your users. You may modify or remove these files.
|
*/

// $router->controllers([
//     'auth' => 'Auth\AuthController',
//     'password' => 'Auth\PasswordController',
// ]);

$router->get('/auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

$router->get('/auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
$router->post('/auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
