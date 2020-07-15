@extends('backend.backend_template')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create for Feedback</h1>
    <div class="card mb-3">
      <div class="card-header">
        @if ($message = Session:: get('success'))
        <div class="alert alert-success alert-block col-md-7 offset-2">
            <button type="button" class="close" data-dismiss ="alert">X</button>
            <strong>{{$message}}</strong>
        </div>
        @endif


        <i class="fas fa-table"></i>
        Insert Class <i class="float-right">

            <a href="{{route('feedback.index')}}" class="btn btn-primary">Go Back</a>
        </i></div>
        <div class="row">
            <div class="col-8 offset-2" >
                <div class="card-body">
                    <form method="post" action="{{route('feedback.store')}}">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                    <div class="col-md-6">
                                        <select class="custom-select" name="user_detail_id">
                                          <option disabled>Please Choose One</option>
                                          @foreach($user_details as $user_detail)
                                            <option value="{{$user_detail->id}}">{{$user_detail->user->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Report') }}</label>
                                    <div class="col-md-6">
                                        <textarea name="context" class="form-control"></textarea>
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