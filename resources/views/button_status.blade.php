@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 mb-3">
        <form action="{{ route('button.list') }}" method="get">
            <a href="{{ route('button.form') }}" class="btn btn-warning float-start">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
            </a>

            {{-- <button type="button" class="btn btn-success pull-right"  data-toggle="modal" data-target="#excel_export_modal">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
            </button> --}}

            <button type="submit" class="btn btn-outline-primary pull-right">
                <i class="fa fa-search" aria-hidden="true"></i> Search
            </button>

            <input type="text" name="button_name" style="width:200px" class="form-control pull-right mr-4" id="button-name" placeholder="Button">
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
                <div class="easion-card-title">Button List</div>
            </div>
            <div class="card-body ">

                <table class="table table-hover table-in-card table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Button Pin</th>
                            <th scope="col">Button Val</th>
                            <th scope="col">Action Name</th>
                            <th scope="col">Show</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buttons as $button)
                            <tr>
                                <th scope="row" class="align-middle">{{ $button->id }}</th>
                                <td class="align-middle">{{ $button->button_pin }}</td>
                                <td class="align-middle">
                                        {{-- {{ $button->button_val }} --}}
                                        @if($button->button_val == '1')
                                            <span class='badge badge-pill badge-success'>ON</span>
                                        @elseif($button->button_val == '0')
                                            <span class='badge badge-pill badge-secondary'>OFF</span>
                                        @endif
                                </td>
                                <td class="align-middle">{{ $button->action_name }}</td>
                                <td class="align-left" width='10%'>
                                    <a class="btn btn-secondary mb-1 btn-sm waves-effect" href="button-form/{{ $button->id }}">
                                        <i class="fa fas fa-edit" aria-hidden="true"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="pull-right">
            {{-- {!! $arduinos->links('pagination::bootstrap-4') !!} --}}
        </div>
    </div>
</div>


@endsection
