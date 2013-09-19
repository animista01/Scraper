<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
	/*scrape();*/ //Call the function if you have already users in the DB 
});
Route::post('/', function()
{
	$username = Input::get('txtuser');
	$password = Input::get('txtpass');
	$name = Input::get('txtname');
	$mail = Input::get('txtmail');
	
	$user = new User;
	$user->username = $username;
	$user->password = $password;
	$user->name = $name;
	$user->email = $mail;
	$user->save();

	scrape();
});

function scrape(){
	//Get all users
	$users = User::all();

	foreach ($users as $user) {
		$usuario = $user->username;
		$contrasena = $user->password;
		//Curl Copycat
		$cc = new Copycat;
		//Logear al usuario
		$cc->setCURL(array(
		  	CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
			CURLOPT_URL => 'Here your url where the login form is',
	  		CURLOPT_POST => 1,
	  		CURLOPT_POSTFIELDS => 'username='.$usuario.'&password='.$contrasena.'',
		  	CURLOPT_RETURNTRANSFER => 1,
		  	CURLOPT_CONNECTTIMEOUT => 5,
	  		CURLOPT_FOLLOWLOCATION => 1,
	  		CURLOPT_COOKIEJAR => 'cookie.txt'));
		$cc->matchAll(array(
			'datos' => 'here your regex with html tags ex:(/column c1">.*?href="(.*?)".*?<\/div>/ms)',)) //Get the href of <a> anchor inside of a div
		->URLs('Here your url where you gonna scrape');
		$result = $cc->get();
		//Traer las tareas del usuario con la cookie que tenemos
		foreach ($result[0]['datos'] as $url) {
			$cc->setCURL(array(
			  	CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.17 (KHTML, like Gecko) Chrome/24.0.1312.57 Safari/537.17',
			  	CURLOPT_CONNECTTIMEOUT => 5,
		  		CURLOPT_COOKIEJAR => 'cookie.txt'));
			$cc->matchAll(array(
				'datos' => 'here your regex with html tags',)) //Get the content of <a> anchor inside of a div
			->URLs($url);
			$tareas = $cc->get();
		}//End Traer tareas
		foreach ($tareas[0]['datos'] as $tarea) {
			$data = array('tarea' => $tarea);
		}//End recorrer tareas
		//Send the email
					//Email Template
		Mail::send('emails.template', $data, function ($message) use ($user){
		    $message->subject('(Recordatorio)Tareas para el Aula Extendida');
		    $message->to($user->email);
		});
		
		unlink('/var/www/larv/cookie.txt');//Delete the last Cookie every single time
	}//End foreach User
}