<?php

namespace App\Http\Controllers;

use App\Models\Arduinos;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\ExportPressureLog;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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

        $arduino = Arduinos::where('arduino_name', $arduino_name)->first();

        return view('presure_log', [
            'arduino_name'      => $arduino->comment,
            'presure_logs'      => $presure_logs,
            'arduino_key_name'  => $arduino_name
        ]);
    }

    public function exportPresureLogs(Request $request){
        $date_from      = $request->date_from;
        $date_to        = $request->date_to;
        $arduino_name   = $request->arduino_name;


        $now            = date('Y_m_d_His');
        $filename       = "presure_log_".$now.".xlsx";

        return Excel::download(new ExportPressureLog($arduino_name, $date_from, $date_to),  $filename);
    }


    public function presureDailyData(Request $request){
        $search                         = [];
        $button_logs                    = [];

        if($request->show_date <= Carbon::today()){


            if( $request->arduino_name    !=''  ) $search[] = ['arduino_name',   '=',    $request->arduino_name ];
            if( $request->show_date       != '' ) $search[] = ['created_at',     '>=',   $request->show_date ];
            if( $request->show_date       != '' ) $search[] = ['created_at',     '<=',   $request->show_date . ' 23:59:59'];

            // dd($search);
            $presure_logs                 = DB::table('presure_logs')->orderBy('id', 'asc')->where($search)->get(['created_at', 'presure_value']);

            // find last one value
            if ($presure_logs->isEmpty()){
                $search = [];
                if( $request->arduino_name    !=''  ) $search[] = ['arduino_name',   '=',    $request->arduino_name ];
                if( $request->show_date       != '' ) $search[] = ['created_at',     '<=',   $request->show_date ];
                $presure_logs             = DB::table('presure_logs')->orderBy('id', 'asc')->where($search)->get(['created_at', 'presure_value'])->take(10);
            }
        }

        return response()->json($presure_logs);
    }
}
