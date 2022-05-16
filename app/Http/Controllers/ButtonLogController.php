<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Arduinos;
use App\Models\ButtonLogs;
use Illuminate\Http\Request;
use App\Exports\ExportButtonLogs;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
            'arduino_name'      => $arduino->comment,
            'btn'               => $button_pin,
            'button_logs'       => $button_logs,
            'arduino_key_name'  =>$arduino_name
        ]);
    }



    public function buttonDailyData(Request $request){
        $search                         = [];
        $button_logs                    = [];

        if($request->show_date <= Carbon::today()){


            if( $request->arduino_name    !=''  ) $search[] = ['arduino_name',   '=',    $request->arduino_name ];
            if( $request->show_date       != '' ) $search[] = ['created_at',     '>=',   $request->show_date ];
            if( $request->show_date       != '' ) $search[] = ['created_at',     '<=',   $request->show_date . ' 23:59:59'];
            if( $request->btn             != '' ) $search[] = ['button_pin',     '=',   $request->btn];

            // dd($search);
            $button_logs = DB::table('button_logs')->orderBy('id', 'desc')->where($search)->get(['created_at', 'status_value']);

            // find last one value
            if ($button_logs->isEmpty()){
                $search = [];
                if( $request->arduino_name    !=''  ) $search[] = ['arduino_name',   '=',    $request->arduino_name ];
                if( $request->show_date       != '' ) $search[] = ['created_at',     '<=',   $request->show_date ];
                if( $request->btn             != '' ) $search[] = ['button_pin',     '=',   $request->btn];
                $button_logs = DB::table('button_logs')->orderBy('id', 'desc')->where($search)->get(['created_at', 'status_value'])->take(10);
            }
        }

        return response()->json($button_logs);
    }

    public function exportButtonLogs(Request $request){
        $date_from      = $request->date_from;
        $date_to        = $request->date_to;
        $arduino_name   = $request->arduino_name;
        $button_pin     = $request->button_pin;


        $now            = date('Y_m_d_His');
        $filename       = "btn_log_".$now.".xlsx";

        return Excel::download(new ExportButtonLogs($arduino_name, $date_from, $date_to, $button_pin),  $filename);
    }
}
