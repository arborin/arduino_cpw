@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-lg-12 mb-3">

        <a href={{ route("user.form") }} class="btn btn-warning float-start">
            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
        </a>
        {{-- <button type="button" class="btn btn-success pull-right"  data-toggle="modal" data-target="#excel_export_modal">
            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
        </button> --}}

    </div>
</div>

<form action="{{ route('user.list') }}" method="get">
    {{-- @csrf --}}
    <div class="row mb-3">
        <div class="col-md-2">
            <input type="text" name="name" class="form-control" id="name" placeholder="username">
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary">
                <i class="fa fa-search" aria-hidden="true"></i> Search
            </button>
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
                <div class="easion-card-title">User List</div>
            </div>
            <div class="card-body ">
                <table class="table table-hover table-in-card table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Add Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($users as $user)

                            @if ($user->role == 'admin')
                                @php $color="table-primary"; @endphp
                            @else
                                @php $color = ''; @endphp
                            @endif

                            <tr class="{{ $color }}">
                                <th scope="row" class="align-middle">{{ $user->id }}</th>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->username }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->role }}</td>
                                <td class="align-middle">{{ $user->created_at }}</td>
                                <td class="align-middle">
                                    <a class="btn btn-secondary mb-1 btn-sm" href="{{ route('user.form', ['id' => $user->id] ) }}"><i class="fa fas fa-edit" aria-hidden="true"></i> View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        {{-- <div class="pull-right">
            {!! $registrations->links('pagination::bootstrap-4') !!}
        </div> --}}
    </div>
</div>



{{-- excel export modal --}}

{{-- <div class="modal fade" id="excel_export_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h6 class="" id="exampleModalLabel"><i class="fas fa-info-circle"></i> გთხოვთ მონიშნეთ პერიოდი</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form method="post" action="{{ route('registration.export') }}" id="export_period">
                @csrf
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
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">დახურვა</button>

                    <button type="submit" form='export_period' class="btn btn-success btn-sm" id="export_registration">
                        ექსპორტი <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

--}}

@endsection
