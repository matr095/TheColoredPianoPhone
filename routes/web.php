<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('blogstation', function () {
    $lastblog = DB::select('select email from users');
    return view('blogstation', ['login' => '', 'register' => "", 'lastblog' => $lastblog]);
});

Route::post('register', function (Request $request) {
    $emailExists = DB::select('select email from users where email = :email', ['email' => $request->input('email')]);
    if(count($emailExists) > 0) {
        return view('blogstation', ['login' => '', "register" => "Cet email existe déjà, en prendre un autre"]);
    } else {
        $users = DB::insert('insert into users (email, password) VALUES (:email, :password)', ['email' => $request->input('email'), 'password' => $request->input('password') ]);
        return view('blogstation', ['login' => '', "register" => "Votre compte est bien créé"]);
    }
});

Route::post('login', function (Request $request) {
    $users = DB::select('select password from users where email = :email', ['email' => $request->input('email')]);
    if(count($users)) {
        $password = $users[0]->password;
        if($password == $request->input('password')) {
            $request->session()->put('user', $request->input('email'));
            return view('backoffice', ['currentUser' => $request->session()->get('user')]);
        } else {
            return view('blogstation', ["login" => "Le mot de passe est incorrect", 'register' => '']);
        }
    } else {
        return view('blogstation', ["login" => "Le compte n'existe pas", 'register' => '']);
    }
});

Route::post('saveblog', function (Request $request) {
    if($request->session()->get('user')) {
        $meta = $request->input('metadata');
        $sky = $request->input('sky');
        $floor = $request->input('floor');
        $wall = $request->input('wall');
        $datas = $sky.','.$floor.','.$wall.','.$meta;
        DB::update('UPDATE users SET maison = :datas WHERE email = :email', ['email' => $request->session()->get('user'), 'datas' => $datas]);
        return view('backoffice', ['currentUser' => $request->session()->get('user')]);
    } else {
        return view('blogstation', ["login" => "Veuillez vous connecter", 'register' => '']);
    }
});

Route::get('blog/{email}', function (Request $request, $email) {
    $maison = DB::select('select maison from users where email = :email', ['email' => $email]);
    if(count($maison) > 0) {
        $string = $maison[0]->maison;
        $maison[0]->maison = explode(',', $maison[0]->maison);
        if(strlen($string) == 0) {
            return view('view', ['sky' => 1,'floor' => 1,'wall' => 1,'texte' => "Ce blog n'existe pas ou n'a pas encore été rempli !!!"]);
        }
        $sky = $maison[0]->maison[0];
        $floor = $maison[0]->maison[1];
        $wall = $maison[0]->maison[2];
        $texte = substr($string, (strpos($string, $wall)+strlen($wall))+1);
        return view('view', ['sky' => $sky,'floor' => $floor,'wall' => $wall,'texte' => $texte]);
    } else {
        return view('view', ['sky' => 1,'floor' => 1,'wall' => 1,'texte' => "Ce blog n'existe pas ou n'a pas encore été rempli !!!"]);
    }
});
