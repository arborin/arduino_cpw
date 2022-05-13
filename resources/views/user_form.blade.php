@extends('layouts.app')


@section('content')




<div class="row">
    <div class="col-xl-6">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="easion-card-title"> User Form </div>
            </div>
            <div class="card-body">
                <form action='{{ route('user.save') }}' method="post">
                    @csrf

                    <input type="hidden" name='id' value="{{ isset($user) ? $user['id'] : '' }}" class="form-control" id="id" placeholder="">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text"  name="name" value="{{ isset($user['name']) ? $user['name'] : '' }}" required class="form-control" id="name"  placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text"  name="username" value="{{ isset($user['username']) ? $user['username'] : '' }}" required class="form-control" id="name"  placeholder="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" required class="form-control">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">

                                <label for="exampleFormControlInput1">Role</label>

                                @php $role = isset($user) ? $user->role : '' @endphp

                                <select class="form-control" name="role" id="role" required>
                                    <option disabled selected>-</option>
                                    <option {{ ($role == "admin") ? 'selected' : ''}} value="admin">Admin</option>
                                    <option {{ ($role == "user") ? 'selected' : ''}} value="user">User</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                                    <input type="password" name="password" value="" class="form-control" id="password" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-user-alert">
                                Delete <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>

                            <button type="submit" class="btn btn-primary pull-right ml-3">Save</button>
                            <a href="" class="btn btn-secondary pull-right">Back</a>

                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>
</div>



{{-- send sms modal --}}


<div class="modal fade" id="delete-user-alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            გსურთ მომხმარებლის წაშლა?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">დახურვა</button>
            <form method="post" action={{ route('user.delete') }}>
                @csrf
                <input type="hidden" name='id' value="{{ isset($user) ? $user['id'] : '' }}" class="form-control" id="id" placeholder="">
                <button type="submit" class="btn btn-danger btn-sm" id="delete_user">
                    წაშლა <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </button>
            </form>

        </div>
      </div>
    </div>
</div>


@endsection
