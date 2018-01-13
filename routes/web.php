<?php

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


Route::get('/', 'HomeController@index')->name('home');

Route::get('registered/users', 'HomeController@users')->name('users');

Route::get('register/form/{token}', 'HomeController@register')->name('form');

Route::put('register/{token}/update', 'HomeController@update')->name('update');

Route::get('register/github', 'HomeController@redirectToProvider')->name('register');

Route::get('register/github/callback', 'HomeController@handleProviderCallback')->name('callback');

Route::post('contact/store', 'HomeController@contact')->name('contact');

Route::post('feedback/store', 'HomeController@feedback')->name('feedback');

// from here
Route::get('autocomplete', function()
{
    return View::make('autocomplete');
});

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

Route::get('getdata', function()
{
  //$client = new GuzzleHttp\Client();
  // $res = $client->request('GET', 'https://api.github.com/search/users?q=obinnaeye', [
  //     'auth' => ['user', 'pass']
  // ]);
    $term = Str::lower(Input::get('term'));
    // $json = json_decode(file_get_contents(`https://api.github.com/search/users?q=` + $term), true);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, "https://api.github.com/search/users?q=".$term);
    curl_setopt($ch, CURLOPT_USERAGENT, "obinnaeye");
    $data = curl_exec($ch);
    curl_close($ch);
    $ok = json_decode($data);
    $result = array();
    if (!empty($ok->items)) {
      $result = $ok->items;
    }

    $return_array = array();

    foreach ($result as $key => $value) {
          $return_array[] = array('value' => $value->login, 'id' =>$key);
    }
    return Response::json($return_array);
});
