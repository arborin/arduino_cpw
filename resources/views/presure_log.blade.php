@extends('layouts.app')


@section('content')
        <form action="" method="get" >
            <div class="row mb-5">

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

        </form>





<div class="row">
    <div class="col-lg-12">
        <div class="mb-5">
            <canvas id="bar-chart" height="70"></canvas>
        </div>



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
                                <td class="align-middle">{{ $log->arduino_name }}</td>
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


@endsection

@php
    $last_log = $presure_logs->toArray();
    $last_log = array_slice($last_log, -20);

    $data = [];



    // dd($last_log['data']);

    foreach ($last_log['data'] as $log_row) {
        $data[ $log_row->created_at ] = $log_row->presure_value;
    }

    // dd($data);

@endphp

@section('javascript')
<script>
    // Bar chart

    var label_data = @json($data);
    get_labels = Object.keys(label_data);
    get_values = Object.values(label_data);
    console.log(get_labels);
    console.log(get_values);

    new Chart(document.getElementById("bar-chart"), {
        type: 'bar',
        data: {
        // labels: ["date 1", "date 1", "date 1", "date 1", "date 1"],
        labels: get_labels,
        datasets: [
            {
            label: "Last records",
            // backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
            backgroundColor: "#3e95cd",
            // data: [2478,5267,734,784,433]
            data: get_values
            }
        ]
        },
        options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Predicted world population (millions) in 2050'
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

</script>
@endsection


