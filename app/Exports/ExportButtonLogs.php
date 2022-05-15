<?php

namespace App\Exports;

use App\Models\ButtonLogs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportButtonLogs implements FromCollection, WithHeadings
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

        return ButtonLogs::join('arduinos', 'arduinos.arduino_name', '=', 'button_logs.arduino_name')
                                                    ->orderBy('button_logs.id', 'desc')
                                                    ->whereDate('button_logs.created_at', '>=', $this->date_from)
                                                    ->whereDate('button_logs.created_at', '<=', $this->date_to)
                                                    ->where('button_logs.arduino_name', '=', $this->arduino_name)
                                                    ->get([
                                                            'button_logs.id',
                                                            'arduinos.comment',
                                                            'button_logs.button_status',
                                                            'button_logs.created_at'
                                                        ]);
    }

    public function headings(): array
    {
        return ["id", "device", "status", "datetime"];
    }
}
