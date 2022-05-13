<?php

namespace App\Http\Controllers;

use Str;
use App\Models\Arduinos;
use App\Models\ButtonLogs;
use App\Models\PresureLogs;
use Illuminate\Http\Request;
use App\Models\ButtonStatuses;
use Illuminate\Support\Facades\Auth;

class ArduinoController extends Controller
{
    public function index(Request $request){

        $arduino_name           = $request->arduino_name;

        $arduinos               = Arduinos::orderBy('id', 'desc')
                                            ->where('arduino_name', 'like', '%'.$arduino_name.'%')
                                            ->paginate(15);

        return view('arduino_list',[
            'arduinos' => $arduinos
        ]);
    }

    public function viewArduino( $id = null ){
        $arduino                = new Arduinos();

        if($id != ''){
            $arduino            = $arduino::find($id);
        }

        return view('arduino_form', [
            'arduino' => (object)$arduino
        ]);
    }

    public function saveArduino(Request $request){

        $id                     = $request->id;
        $arduino_name           = $request->arduino_name;
        $arduino_ip             = $request->arduino_ip;
        $comment                = $request->comment;

        $arduino                = new Arduinos();

        $arduino_name           = Str::replace( ' ', '_', $arduino_name );

        if($id != ''){
            $row                = $arduino::find($id);;
            $row->arduino_name  = $arduino_name;
            $row->arduino_ip    = $arduino_ip;
            $row->comment       = $comment;
            $row->save();
        }else{
            $arduino::create([
                'arduino_name'  => $arduino_name,
                'arduino_ip'    => $arduino_ip,
                'comment'       => $comment
            ]);
        }

        return redirect(route('arduino.list'))->with('message','Success!');
    }

    public function deleteArduino(Request $request){

        if( Auth()->user()->role == 'admin'){
            Arduinos::destroy($request->id);
            return redirect(route('arduino.list'))->with('message', 'Success!');
        }else{
            return redirect(route('arduino.list'))->with('message', 'Error!');
        }
    }


    public function getButtonRequest(Request $request){
        $arduino_name           = $request->name;
        $btn                    = $request->btn;
        $btn_value              = $request->state;

        $btn_status             = ButtonStatuses::where('button_pin', $btn)->where('button_val', $btn_value)->first();

        $action                 = (!is_null($btn_status)) ? $btn_status->action_name : "NOT CONFIGURED";

        ButtonLogs::create([
                            'arduino_name'      => $arduino_name,
                            'button_status'     => $action,
                            'status_value'      => $btn_value,
                            'button_pin'        => $btn
                        ]);

        return '#OK';
    }

    public function getPresureValue(Request $request){

        $arduino_name           = $request->name;
        $value                  = $request->value;



        PresureLogs::create([
                            'arduino_name'      => $arduino_name,
                            'presure_value'     => $value
                        ]);

        return '#OK';
    }




}
