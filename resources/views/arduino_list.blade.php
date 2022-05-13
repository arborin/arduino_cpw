@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 mb-3">
        <form action="{{ route('arduino.list') }}" method="get">
            @if (Auth::user()->role == "admin")
                <a href="{{ route('arduino.form') }}" class="btn btn-warning float-start">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                </a>
            @endif

            {{-- <button type="button" class="btn btn-success pull-right"  data-toggle="modal" data-target="#excel_export_modal">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
            </button> --}}

            <button type="submit" class="btn btn-outline-primary pull-right">
                <i class="fa fa-search" aria-hidden="true"></i> Search
            </button>

            <input type="text" name="arduino_name" style="width:200px" class="form-control pull-right mr-4" id="arduino-name" placeholder="arduino name">
        </form>
    </div>
</div>




<div class="row">
    <div class="col-lg-12">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">Arduino List</div>
            </div>
            <div class="card-body ">

                <table class="table table-hover table-in-card table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Arduino Name</th>
                            <th scope="col">Arduino IP</th>
                            <th scope="col">Comment</th>
                            <th scope="col">View</th>
                            @if (Auth::user()->role == "admin")
                                <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arduinos as $arduino)
                            <tr>
                                <th scope="row" class="align-middle">{{ $arduino->id }}</th>
                                <td class="align-middle">{{ $arduino->arduino_name }}</td>
                                <td class="align-middle">{{ $arduino->arduino_ip }}</td>
                                <td class="align-middle">{{ $arduino->comment }}</td>

                                <td class="align-left" width='20%'>
                                    <a class="btn btn-outline-primary mb-1 btn-sm waves-effect" href="/button-log/{{ $arduino->arduino_name }}"><i class="fa fas fa-clock" aria-hidden="true"></i> Button Log</a>
                                    <a class="btn btn-info mb-1 btn-sm waves-effect" href="/presure-log/{{ $arduino->arduino_name }}"><i class="fa fas fa-chart-bar" aria-hidden="true"></i> Presure Log</a>
                                </td>
                                @if (Auth::user()->role == "admin")
                                    <td class="align-left" width='10%'>
                                        <a class="btn btn-secondary mb-1 btn-sm waves-effect" href="arduino-form/{{ $arduino->id }}"><i class="fa fas fa-edit" aria-hidden="true"></i> Edit</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="pull-right">
            {!! $arduinos->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>


@endsection
