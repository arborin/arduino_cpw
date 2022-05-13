@extends('layouts.app')


@section('content')


<div class="row">
    <div class="col-xl-6">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="easion-card-title"> Add Arduino </div>
            </div>
            <div class="card-body">
                <form action='{{ route('arduino.save') }}' method="post">
                    @csrf

                    <input type="hidden" name='id' value="{{ isset($arduino['id']) ? $arduino['id'] : '' }}" class="form-control" id="id" placeholder="">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arduino_name">Arduino Name</label>
                                <input type="text"  name="arduino_name" value="{{ isset($arduino['arduino_name']) ? $arduino['arduino_name'] : '' }}" required class="form-control" id="arduino_name"  placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arduino_ip">Arduino IP</label>
                                <input type="text"  name="arduino_ip" value="{{ isset($arduino['arduino_ip']) ? $arduino['arduino_ip'] : '' }}" required class="form-control" id="arduino_ip"  placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <div class="input-group">
                                    <input type="text" name="comment" value="{{ isset($arduino) ? $arduino->comment : '' }}" id="company_name" required class="form-control" placeholder=""/>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete-arduino-alert">
                                Delete <i class="fas fa-trash-alt" aria-hidden="true"></i>
                            </button>

                            <button type="submit" class="btn btn-primary pull-right ml-3">Save</button>

                            <a href="{{ route('arduino.list') }}" class="btn btn-secondary pull-right">Back</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </div>
</div>





<div class="modal fade" id="delete-arduino-alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-info-circle"></i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Are you sure?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <form method="post" action="{{ route('arduino.delete') }}">
                @csrf
                <input type="hidden" name='id' value="{{ isset($arduino) ? $arduino['id'] : '' }}" class="form-control" id="id" placeholder="">
                <button type="submit" class="btn btn-danger btn-sm" id="delete_arduino">
                    Delete <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </button>
            </form>
        </div>
      </div>
    </div>
</div>





@endsection
