<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;

class OtherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Раздел Другое
     *
     * @return \Illuminate\Http\Response
     */  
    public function index()
    {
        try {
            $ref_value = \App\Adm_common::firstOrFail()->ref_value;
            // $users_total = \App\Wag_users::all()->count();
            $feedbacks = \App\Adm_feedback::all();
            $counter = 1;
            // \DB::statement("SET lc_time_names = 'ru_RU'");
            // $days = is_int( (int)$days ) ? (int)$days : 5;
            // $graph_array = \App\Adm_plays_statistics::whereDate( 'play_date', '>=', Carbon::today()->subDay( $days )->toDateString() )
            //     ->groupBy('DATE(play_date)')
            //     ->selectRaw('sum(sum) as sum, DATE(play_date), DATE_FORMAT(DATE(play_date), \'%d %M\') as date_month')
            //     ->lists('sum','date_month')
            //     ->toArray();

            // $sums = array_keys( $graph_array );
            // $dates = array_values( $graph_array );

        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return view( 'other', array( 'ref_value' => $ref_value, 
                'feedbacks' => $feedbacks , 
                'counter' => $counter// ,
                // 'sums' => $sums,
                // 'dates' => $dates
            ) 
        );
    }
    public function save_ref(Request $request)
    {
        try {
            $common = \App\Adm_common::firstOrFail();
            $common->ref_value = $request->input('ref_value');
            $common->save();
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return redirect('/other')->with('message', 'Реферальный процент изменен');
    }
    public function feedback_edit(Request $request)
    {
        try {
            $id = $request->input('feedback_id');
            $feedback = \App\Adm_feedback::findOrFail( $id );
            if ( $request->input('response_text', '') != '' )
                $feedback->response_text = $request->input('response_text');
            if ( $request->input('status', '') != '' )
                $feedback->status = $request->input('status');            
            $feedback->save();
        } catch (Exception $e) {
            die("Ошибка в БД");
        }
        return redirect('/other')->with('message', 'Сохранено');
    }
    public function clear_db(Request $request)
    {
        try {
            $days_count = $request->input('days_count');
            $days_count = (int)$days_count;

            if ( $days_count < 0 ) {
                return redirect('/other')
                  ->withErrors( array('days_count' => 'Не верное число дней') );
            } 

            $sql = \App\Adm_plays_statistics::whereDate( 'play_date', '<', Carbon::today()->subDay( $days_count )->toDateString() )
                ->delete();

        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return redirect('/other')->with('message', 'Удалена статистика старше ' . Carbon::today()->subDay( $days_count )->format('d.m.Y') );
    } 

}
