<?php

namespace App\Http\Controllers;

use App\Models\ButtonLogs;
use App\Models\Arduinos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ButtonLogController extends Controller
{
    public function showButtonLog($arduino_name, Request $request){

        $button_pin         = $request->button_pin ?? '';
        $date_from          = $request->date_from ?? '';
        $date_to            = $request->date_to ?? '';

        $search                     = [];


        if( $button_pin      != '' ) $search[] = ['button_pin',     '=',    $button_pin ];
        if( $arduino_name    !=''  ) $search[] = ['arduino_name',   '=',    $arduino_name ];
        if( $date_from       != '' ) $search[] = ['created_at',     '>=',   $date_from ];
        if( $date_to         != '' ) $search[] = ['created_at',     '<=',   $date_to . ' 23:59:59'];



        // if ($button_pin != ''){
            $button_logs = DB::table('button_logs')->orderBy('id', 'desc')->where($search)->paginate(30);
        // }else{
        //     $button_logs = [];
        // }

        $arduino = Arduinos::where('arduino_name', $arduino_name)->first();
        // dd($arduino->comment);
        return view('button_log', [
            'arduino_name'  => $arduino->comment,
            'btn'           => $button_pin,
            'button_logs'   => $button_logs
        ]);
    }
}
