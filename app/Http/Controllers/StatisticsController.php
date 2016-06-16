<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Раздел Статистика
     *
     * @return \Illuminate\Http\Response
     */  
    public function index($days = '5')
    {
        try {
            $statistics = \App\Adm_plays_statistics::whereDate( 'play_date', '=', Carbon::today()->toDateString() );
            $users_total = \App\Wag_users::all()->count();
            $users_today = \App\Wag_users::whereDate( 'date', '=', Carbon::today()->toDateString() )->count();

            \DB::statement("SET lc_time_names = 'ru_RU'");
            $days = is_int( (int)$days ) ? (int)$days : 5;
            $graph_array = \App\Adm_plays_statistics::whereDate( 'play_date', '>=', Carbon::today()->subDay( $days )->toDateString() )
                ->groupBy('DATE(play_date)')
                ->selectRaw('sum(sum) as sum, DATE(play_date), DATE_FORMAT(DATE(play_date), \'%d %M\') as date_month')
                ->lists('sum','date_month')
                ->toArray();

            $sums = array_keys( $graph_array );
            $dates = array_values( $graph_array );

        } catch ( Exception $e ) {
            die("Ошибка в БД");
        }
        return view( 'statistics', array( 'statistics' => $statistics, 
            'users_total' => $users_total, 
            'users_today' => $users_today,
            'sums' => $sums,
            'dates' => $dates
            ) );
    }
}
