@extends('layouts.app')


@section('content')


<form action="{{ route("button_daily.data") }}" method="get" >
    <div class="row mb-3">
        <div class="col-md-3 input-group">
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

        <div class="col-md-9">
            <button type="button" class="btn btn-success pull-right"  data-toggle="modal" data-target="#excel_export_modal">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
            </button>
        </div>

    </div>
</form>

<div class="row">
    <div class="col-lg-12">
        <div class="mb-5">
            <canvas id="bar-chart" height="70"></canvas>
        </div>

        <hr>
    </div>
</div>


<form action="" method="get" >
    <div class="row mt-3 mb-3">
        <div class="col-md-9">
            <div class="row">
                <div class="input-group-prepend ml-3">
                    <label class="input-group-text" for="inputGroupSelect01">
                        <a href="{{ route('arduino.list') }}"><i class="fas fa-angle-double-left"></i></a>
                    </label>
                </div>
                <div class="input-group-prepend">
                    <label class="input-group-text bg-warning" for="inputGroupSelect01" >{{ $arduino_name }}</label>
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
        </div>

    </div>
</form>



<div class="row">
    <div class="col-lg-12">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Log</div>
                <span class="easion-card-menu"><strong>Total: {{ $presure_logs->total() }}</strong></span>
            </div>
            <div class="card-body ">

                <table class="table table-hover table-in-card table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Arduino Name</th>
                            <th scope="col">Presure Value</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presure_logs as $log)
                            <tr>
                                <th scope="row" class="align-middle">{{ $log->id }}</th>
                                <td class="align-middle">{{ $arduino_name }}</td>
                                <td class="align-middle">{{ $log->presure_value}}</td>
                                <td class="align-middle">{{ $log->created_at }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="pull-right">
            @if($presure_logs)
                {!! $presure_logs->links('pagination::bootstrap-4') !!}
            @endif
        </div>
    </div>
</div>


{{-- excel export modal --}}

<div class="modal fade" id="excel_export_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h6 class="" id="exampleModalLabel"><i class="fas fa-info-circle"></i> Select period</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form method="post" action="{{ route('export_presure.log') }}" id="export_period">
                @csrf
                <input type="hidden" name="arduino_name" id="arduino_name" value="{{ $arduino_key_name }}" />
                <div class="modal-body">
                        <div class="row">
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

                    <button type="submit" form='export_period' class="btn btn-success btn-sm" id="export_presure_log">
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

    $('#export_presure_log').click(function(){
        $('#excel_export_modal').modal('hide');
    })
    // Bar chart



    var barChart = new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
        // labels: ["date 1", "date 1", "date 1", "date 1", "date 1"],
            labels: [],
            datasets: [
                {
                    label: "Last records",
                    // backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    backgroundColor: "#3e95cd",
                    // data: [2478,5267,734,784,433]
                    data: []
                }
            ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Predicted world population (millions) in 2050'
            },
            plugins: {
                legend: {
                display: false,
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Value'
                    },
                    min: 0,
                    max: 1200,
                    ticks: {
                        // forces step size to be 50 units
                        stepSize: 50
                    }
                }
                }
        }
    });


    var arduino_name = $("#arduino_name").val();
    let yourDate = new Date()
    let show_date = yourDate.toISOString().split('T')[0]

    getPresureData(arduino_name, show_date);



    $("#update_graph").click(function(){
        var arduino_name = $("#arduino_name").val();
        var show_date    = $("#show_date").val();

        getPresureData(arduino_name, show_date);

    });

    function getPresureData(arduino_name, show_date){
        var ajaxurl     = "/presure-data?arduino_name=" + arduino_name + "&show_date=" + show_date;
        var type        = 'GET';


        // alert(ajaxurl);

        $.ajax({
            type: type,
            url: ajaxurl,
            dataType: 'json',
            success: function (data) {

                let labels = [];
                let values = [];

                console.log(data);
                data.forEach(record => {
                    labels.push(record['created_at']);
                    values.push(record['presure_value']);
                });



                // console.log(config.data.datasets[0].data);

                barChart.data.labels = labels;
                barChart.data.datasets[0].data = values;
                barChart.update();
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

</script>
@endsection


