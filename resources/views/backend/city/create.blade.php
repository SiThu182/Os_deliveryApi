@extends('backend.backend_template')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Create for City</h1>
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

            <a href="{{route('city.index')}}" class="btn btn-primary">Go Back</a>
        </i></div>
        <div class="row">
            <div class="col-8 offset-2" >
                <div class="card-body">
                    <form method="post" action="{{route('city.store')}}">
                        @csrf
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="city_name" id = "class_name" class="form-control @error('city_name') is-invalid @enderror" placeholder="Enter Category Name">
                                </div>
                                @error('class_name')
                                <div class="alert-danger">{{$message}}

                                </div>
                                @enderror
                               
                                <div class="form-group">
                                    <input type="submit" class=" btn btn-info float-right" name="save" 
                                    value="Save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                
            </div>
        @endsection