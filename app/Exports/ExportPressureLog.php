<?php

namespace App\Exports;

use App\Models\PresureLogs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPressureLog implements FromCollection, WithHeadings
{
    function __construct($arduino_name, $date_from, $data_to) {
        $this->arduino_name     = $arduino_name;
        $this->date_from        = date($date_from);
        $this->date_to          = date($data_to);
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return ButtonLogs::all();

        // dd([$this->arduino_name, $this->date_from, $this->date_to]);


        return PresureLogs::join('arduinos', 'arduinos.arduino_name', '=', 'presure_logs.arduino_name')
                                                    ->orderBy('presure_logs.id', 'desc')
                                                    ->whereDate('presure_logs.created_at', '>=', $this->date_from)
                                                    ->whereDate('presure_logs.created_at', '<=', $this->date_to)
                                                    ->where('presure_logs.arduino_name', '=', $this->arduino_name)
                                                    ->get([
                                                            'presure_logs.id',
                                                            'arduinos.comment',
                                                            'presure_logs.presure_value',
                                                            'presure_logs.created_at'
                                                        ]);
    }

    public function headings(): array
    {
        return ["id", "device", "value", "datetime"];
    }
}
