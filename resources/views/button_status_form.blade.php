@extends('layouts.app')


@section('content')


<div class="row">
    <div class="col-xl-6">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="easion-card-title"> Add Button Status </div>
            </div>
            <div class="card-body">
                <form action='{{ route('buttonAction.save') }}' method="post">
                    @csrf

                    <input type="hidden" name='id' value="{{ isset($button['id']) ? $button['id'] : '' }}" class="form-control" id="id" placeholder="">

                    {{-- @php dd($button) @endphp --}}

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="button_pin">Button Pin Number</label>
                                <select class="form-control" name='button_pin' aria-label="Default select example">
                                    <option>-- select pin --</option>
                                    <option value="btn_2" {{ ($button->button_pin == 'btn_2') ? 'selected' : '' }}>Button (PIN 2)</option>
                                    <option value="btn_3" {{ ($button->button_pin == 'btn_3') ? 'selected' : '' }}>Button (PIN 3)</option>
                                    <option value="btn_5" {{ ($button->button_pin == 'btn_5') ? 'selected' : '' }}>Button (PIN 5)</option>
                                    <option value="btn_6" {{ ($button->button_pin == 'btn_6') ? 'selected' : '' }}>Button (PIN 6)</option>
                                    <option value="btn_7" {{ ($button->button_pin == 'btn_7') ? 'selected' : '' }}>Button (PIN 7)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arduino_name">Button State</label>
                                <select class="form-control" name='button_val' aria-label="Default select example">
                                    <option>-- select state --</option>
                                    <option value="1" {{ ($button->button_val == '1') ? 'selected' : '' }}>ON</option>
                                    <option value="0" {{ ($button->button_val == '0') ? 'selected' : '' }}>OFF</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="action_name">Action Name</label>
                                <div class="input-group">
                                    <input type="text" name="action_name" value="{{ isset($button->action_name) ? $button->action_name : '' }}" id="action_name" required class="form-control" placeholder=""/>
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

                            <a href="{{ route('button.list') }}" class="btn btn-secondary pull-right">Back</a>
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
            <form method="post" action="{{ route('button.delete') }}">
                @csrf
                <input type="hidden" name='id' value="{{ isset($button) ? $button['id'] : '' }}" class="form-control" id="id" placeholder="">
                <button type="submit" class="btn btn-danger btn-sm" id="delete_registration">
                    Delete <i class="fas fa-trash-alt" aria-hidden="true"></i>
                </button>
            </form>
        </div>
      </div>
    </div>
</div>





@endsection
