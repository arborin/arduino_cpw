@extends('layouts.app')


@section('content')



<div class="row dash-row">
    <div class="col-xl-4">
        <div class="stats stats-success">
            <h3 class="stats-title"> Button Logs today: </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fas fas fa-power-off"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number" id='btn-today-log'>0</div>
                    <div class="stats-change">
                        <span class="stats-percentage mr-2">Total:</span>
                        <span class="stats-percentage" id='btn-total-log'>0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="stats stats-info">
            {{-- <h3 class="stats-title"> {{ today()->format('Y-m-d') }} </h3> --}}
            <h3 class="stats-title"> Presure Logs today: </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fas fas fa-tachometer-alt"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number" id='pressure-today-log'>0</div>
                    <div class="stats-change">
                        <span class="stats-percentage mr-2">Total:</span>
                        <span class="stats-percentage" id='pressure-total-log'>0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="stats stats-warning">
            {{-- <h3 class="stats-title"> {{ today()->format('Y-m-d') }} </h3> --}}
            <h3 class="stats-title"> Total Logs: </h3>
            <div class="stats-content">
                <div class="stats-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stats-data">
                    <div class="stats-number" id='total-logs'>0</div>
                    <div class="stats-change">
                        <span class="stats-percentage mr-2">From:</span>
                        <span class="stats-percentage" id='logs-from'>0000-00-00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-6">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fas fa-toggle-on"></i>
                </div>
                <div class="easion-card-title">Button log</div>
            </div>
            <div class="card-body ">
                <table class="table table-in-card">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Arduino Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date Time</th>
                        </tr>
                    </thead>
                    <tbody id='btn-log-tbl'>
                        <tr>
                            <th scope="row">0</th>
                            <td>No Result</td>
                            <td>No Result</td>
                            <td>No Result</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Presure log</div>
            </div>
            <div class="card-body ">
                <table class="table table-hover table-in-card">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Arduino Name</th>
                            <th scope="col">Presure</th>
                            <th scope="col">Date Time</th>
                        </tr>
                    </thead>
                    <tbody id='presure-log-tbl'>
                        <tr>
                            <th scope="row">0</th>
                            <td>No Result</td>
                            <td>No Result</td>
                            <td>No Result</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection


@section('javascript')

<script>

    jQuery(document).ready(function($){


        function formatDate(get_date){

            if(get_date){
                var date_list = get_date.split('T');

                var date = date_list[0];
                var time = date_list[1].split('.')[0];
                return date + " " + time;
            }
        }

        function getData(){
            var ajaxurl = "{{ route('dashboard.live') }}";
            var type    = 'GET';

            $.ajax({
                type: type,
                url: ajaxurl,
                dataType: 'json',
                success: function (data) {
                    console.log(data);

                    $('#btn-today-log').text(data['button_stat']['today']);
                    $('#btn-total-log').text(data['button_stat']['sum']);

                    $('#pressure-today-log').text(data['presure_stat']['today']);
                    $('#pressure-total-log').text(data['presure_stat']['sum']);

                    $('#total-logs').text(data['total']['sum']);
                    $('#logs-from').text(data['total']['from']);

                    // BUTTON LOG

                    var button_log = data['button_log'];
                    var button_tbl = '';

                    // id: 19, arduino_name: "node_1", presure_value: "245",

                    for(var i = 0; i < button_log.length; i++){
                        button_tbl += '<tr>';

                        button_tbl += '<td>' + button_log[i]['id'] + '</td>';
                        button_tbl += '<td>' + button_log[i]['comment'] + '</td>';
                        button_tbl += '<td>' + button_log[i]['button_status'] + '</td>';
                        button_tbl += '<td>' + button_log[i]['created_at'] + '</td>';

                        button_tbl += '</tr>';
                        
                    }
                    $('#btn-log-tbl').html(button_tbl);

                    var presure_log = data['presure_log'];
                    var presure_tbl = '';

                    for(var i = 0; i < presure_log.length; i++){
                        presure_tbl += '<tr>';

                        presure_tbl += '<td>' + presure_log[i]['id'] + '</td>';
                        presure_tbl += '<td>' + presure_log[i]['comment'] + '</td>';
                        presure_tbl += '<td>' + presure_log[i]['presure_value'] + '</td>';
                        presure_tbl += '<td>' + presure_log[i]['created_at'] + '</td>';

                        presure_tbl += '</tr>';

                    }

                    $('#presure-log-tbl').html(presure_tbl);




                    // var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
                    // if (state == "add") {
                    //     jQuery('#todo-list').append(todo);
                    // } else {
                    //     jQuery("#todo" + todo_id).replaceWith(todo);
                    // }
                    // jQuery('#myForm').trigger("reset");
                    // jQuery('#formModal').modal('hide')
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        // RUN FUNCTION ON LOAD
        getData();

        // RUN FUNCTION EVERY 10 sec
        setInterval(getData, 1000);
    });

</script>
@endsection
