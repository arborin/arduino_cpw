<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresureController extends Controller
{
    public function showPresureLog($arduino_name, Request $request){
        $date_from          = $request->date_from ?? '';
        $date_to            = $request->date_to ?? '';

        $search             = [];

        if( $arduino_name   !=''  ) $search[] = ['arduino_name',   '=',    $arduino_name ];
        if( $date_from      != '' ) $search[] = ['created_at',     '>=',   $date_from ];
        if( $date_to        != '' ) $search[] = ['created_at',     '<=',   $date_to . ' 23:59:59'];


        if ($arduino_name != ''){
            $presure_logs = DB::table('presure_logs')->orderBy('id', 'desc')->where($search)->paginate(30);
        }else{
            $presure_logs = [];
        }

        return view('presure_log', [
            'arduino_name'  => $arduino_name,
            'presure_logs'   => $presure_logs
        ]);
    }
}
