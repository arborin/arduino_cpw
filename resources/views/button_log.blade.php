@extends('layouts.app')


@section('content')


        <form action="{{ route("button_daily.data") }}" method="get" >
            <div class="row mb-3">
                <div class="col-md-6 input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">
                            <a href="{{ route('arduino.list') }}"><i class="fas fa-angle-double-left"></i></a>
                        </label>
                    </div>
                    <div class="input-group-prepend">
                        <input type="hidden" name="arduino_name" id="arduino_name" value="{{ $arduino_key_name }}" />
                        <input type="text" name="show_date" required class="form-control date" value={{ today() }} id="show_date" placeholder="select date">
                        <button type="button" class="btn btn-info input-group-append mr-3" id='update_graph'>Show</button>
                    </div>
                </div>

                <div class="col-md-6">
                    <button type="button" class="btn btn-success pull-right"  data-toggle="modal" data-target="#excel_export_modal">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
                    </button>
                </div>

            </div>
        </form>


        <div class="col-lg-12">
            <div class="chart-container mb-5">
                <canvas id="myChart" width="400" height="50"></canvas>
            </div>

            <hr class='mt-3'>
        </div>


        <form action="" method="get" >
            <div class="row mt-5">
                <div class="col-md-3 input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">
                            <a href="{{ route('arduino.list') }}"><i class="fas fa-angle-double-left"></i></a>
                        </label>
                    </div>
                    <div class="input-group-prepend">
                        <label class="input-group-text bg-warning" for="inputGroupSelect01" >{{ $arduino_name }}</label>
                    </div>
                    <select name='button_pin' class="custom-select" id="selected_arduino_btn">
                        <option value=''>-- ALL --</option>
                        <option value="btn_2" {{ ($btn == 'btn_2') ? 'selected' : '' }}>Button (PIN 2)</option>
                        <option value="btn_3" {{ ($btn == 'btn_3') ? 'selected' : '' }}>Button (PIN 3)</option>
                        <option value="btn_5" {{ ($btn == 'btn_5') ? 'selected' : '' }}>Button (PIN 5)</option>
                        <option value="btn_6" {{ ($btn == 'btn_6') ? 'selected' : '' }}>Button (PIN 6)</option>
                        <option value="btn_7" {{ ($btn == 'btn_7') ? 'selected' : '' }}>Button (PIN 7)</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <input type="text" name="date_from" class="form-control date" id="" placeholder="Date (from)">
                </div>
                <div class="col-md-2">
                    <input type="text" name="date_to" class="form-control date" id="" placeholder="Date (to)">
                </div>

                <div class="col-md-2 ">
                    <button type="submit" class="btn btn-primary input-group-append mr-3">Select</button>
                </div>

            </div>

        </form>



        {{-- <div class="row mb-5">
            <div class="col-lg-12">
                <div class="chart-container">
                    <canvas id="myChart" width="400" height="50"></canvas>
                </div>
            </div>
        </div> --}}



<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Log</div>
                <span class="easion-card-menu">
                        @php $total = ($button_logs) ? $button_logs->total() : 0; @endphp
                    <strong>Total: {{ $total }}</strong></span>
            </div>
            <div class="card-body ">




                <table class="table table-hover table-in-card table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Arduino Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Button(pin)</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($button_logs as $log)
                            <tr>
                                <th scope="row" class="align-middle">{{ $log->id }}</th>
                                <td class="align-middle">{{ $arduino_name }}</td>
                                <td class="align-middle">{{ $log->button_status }}</td>
                                <td class="align-middle">{{ $log->button_pin }}</td>
                                <td class="align-middle">{{ $log->created_at }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="pull-right">
            @if($button_logs)
                {!! $button_logs->links('pagination::bootstrap-4') !!}
            @endif
        </div>
    </div>
</div>












{{-- excel export modal --}}

<div class="modal fade" id="excel_export_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h6 class="" id="exampleModalLabel"><i class="fas fa-info-circle"></i> Export data log</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form method="post" action="{{ route('export_button.log') }}" id="export_period">
                @csrf
                <input type="hidden" name="arduino_name" id="arduino_name" value="{{ $arduino_key_name }}" />
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="button_pin">Button Pin Number</label>
                                    <select class="form-control" name='button_pin' aria-label="Default select example">
                                        <option value=''>-- ALL --</option>
                                        <option value="btn_2">Button (PIN 2)</option>
                                        <option value="btn_3">Button (PIN 3)</option>
                                        <option value="btn_5">Button (PIN 5)</option>
                                        <option value="btn_6">Button (PIN 6)</option>
                                        <option value="btn_7">Button (PIN 7)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="date_from" class="form-control date" id="datepicker" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="date_to" class="form-control date" id="datepicker" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                    <button type="submit" form='export_period' class="btn btn-success btn-sm" id="export_button_log">
                        Export <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>




@endsection



@section('javascript')

<script>

    $('#export_button_log').click(function(){
        $('#excel_export_modal').modal('hide');
    })

    var config = {
        type: 'line',

        data: {
            // labels: ['00:00:00','01:00:00', '02:00:00','03:00:00', '04:00:00', '05:00:00', '06:00:00','07:00:00','08:00:00','09:00:00','10:00:00','11:00:00',
            // '12:00:00','13:00:00','14:00:00','15:00:00','16:00:00','17:00:00','18:00:00','23:59:59'],
            datasets: [{
                fill: true,
                stepped: true,
                label: "My First dataset",

                // data: [1, 0, 1, 0, 1, 0, 1,0,1,0,1,0],
                data: [
                    // { x: "2022-05-10 10:08:27", y: 1 },
                    // { x: "2022-05-10 10:09:27", y: 0 },
                    // { x: "2022-05-10 19:06:27", y: 1 },
                    // { x: "2022-05-10 23:08:27", y: 0 },
                    // { x: "2022-05-10 23:18:27", y: 1 },
                    // { x: "2022-05-10 23:55:27", y: 0 }

                ]
            }],

        },
            options: {
                plugins: {
                    legend: {
                    display: false,
                    },
                },
                backgroundColor: '#ff8069',
                scales: {
                x: {
                        type: 'time',
                        time: {
                            unit: 'hour',
                            tooltipFormat: 'dd/MM/yyyy hh:mm:ss',

                        },

                    },
                y: {
                    title: {
                        display: true,
                        text: 'Value'
                    },
                    min: 0,
                    max: 2,
                    ticks: {
                        // forces step size to be 50 units
                        stepSize: 1
                    }
                }

            }
    }
};

var ctx = document.getElementById("myChart").getContext("2d");
var chart = new Chart(ctx, config);



    var arduino_name    = $("#arduino_name").val();
    var arduino_btn     = $("#selected_arduino_btn").val()
    let yourDate        = new Date()
    let show_date       = yourDate.toISOString().split('T')[0]

    if (arduino_btn != ''){
        getButtonData(arduino_name, show_date, arduino_btn);
    }

    $("#update_graph").click(function(){
        var arduino_name    = $("#arduino_name").val();
        var show_date       = $("#show_date").val();
        var arduino_btn     = $("#selected_arduino_btn").val()



        getButtonData(arduino_name, show_date, arduino_btn);

    });

    function getButtonData(arduino_name, show_date, arduino_btn){
        var ajaxurl     = "/button-data?arduino_name=" + arduino_name + "&show_date=" + show_date + "&btn="+arduino_btn;
        var type        = 'GET';

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            success: function (data) {

                result = Array();

                data.forEach(element => {
                    var d = {};
                    d['x'] = element['created_at'];
                    d['y'] = element['status_value'];
                    result.push(d);
                });

                console.log(result);



                config.data.datasets[0].data = result;
                chart.update();
            },
            error: function (data) {
                console.log(data);
            }
        });
    }


</script>

@endsection
