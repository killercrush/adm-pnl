<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class MyDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        try {
            $user = \App\Adm_users::first();
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return view('mydata', array('user' => $user));
    }
    public function save(Request $request)
    {
        try {
            $user = \App\Adm_users::first();
            $user->email = $request->input('email');

            // getting all of the post data
            $input = $request->all();
            // setting up custom error messages for the field validation
             $messages = [
                 'email.required' => 'Введите email',
                 'email.email' => 'Введите действительный email адрес',
                 'password.confirmed' => 'Пароли не совпадают'
             ];
            $rules = [
              'email' => 'required|email',
              'password' => 'confirmed'
            ];

            $validator = Validator::make($input, $rules, $messages);
            if ($validator->fails()) {
                return redirect('/mydata')->withInput()->withErrors($validator);
            }
            else {
                $password = $request->input('password');
                if ( isset( $password ) && $password != '') {
                    $user->password = \Hash::make( $password );
                    $user->psw_restore = $password;
                }
                $user->save();
                return redirect('/mydata');
            }


        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return view('mydata', array('user' => $user));
    }       
}
