@extends('backend.backend_template')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create for Fee</h1>
    <div class="card mb-3">
      <div class="card-header">
        @if ($message = Session:: get('success'))
        <div class="alert alert-success alert-block col-md-7 offset-2">
            <button type="button" class="close" data-dismiss ="alert">X</button>
            <strong>{{$message}}</strong>
        </div>
        @endif


        <i class="fas fa-table"></i>
        Insert Fee <i class="float-right">

            <a href="{{route('fee.index')}}" class="btn btn-primary">Go Back</a>
        </i></div>
        <div class="row">
            <div class="col-8 offset-2" >
                <div class="card-body">
                    <form method="post" action="{{route('fee.store')}}">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>

                                    <div class="col-md-6">
                                        <select class="custom-select" name="from_township_id">
                                          <option disabled>Please Choose One</option>
                                          @foreach($townships as $township)
                                            <option value="{{$township->id}}">{{$township->township_name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>

                                    <div class="col-md-6">
                                        <select class="custom-select" name="to_township_id">
                                          <option disabled>Please Choose One</option>
                                          @foreach($townships as $township)
                                            <option value="{{$township->id}}">{{$township->township_name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Fee') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" name="cost" id = "class_name" class="form-control @error('township_name') is-invalid @enderror" placeholder="Enter Township Name">
                                    </div>
                                </div>
                                @error('class_name')
                                <div class="alert-danger">{{$message}}

                                </div>
                                @enderror
                               
                                <div class="form-group">
                                    <input type="submit" class=" btn btn-info float-right" name="save" 
                                    value="Save">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                
            </div>
        @endsection