<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Раздел Оплата
     *
     * @return \Illuminate\Http\Response
     */  
    public function index()
    {
        try {
            $payments = \App\Adm_payments::all();
        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return view( 'payment', array( 'payments' => $payments ) );
    }
    public function save(Request $request)
    {
        try {
            $id = $request->input('payment_id');
            $payments = \App\Adm_payments::findOrFail( $id );
            $payments->identity_string = $request->input('identity_string');
            $payments->password = $request->input('password');
            $payments->save();
        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return redirect('/payment')->with('message', 'Оплата изменена');
    }
}
