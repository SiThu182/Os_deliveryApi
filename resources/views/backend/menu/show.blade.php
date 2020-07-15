@extends('backend.backend_template')
@section('content')
	  <h1 class="text-center mt-4">Manage Users</h1>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Users List <i class="float-right">

        <a href="{{route('user_detail.create')}}" class="btn btn-primary">Add New</a>
      </i></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <img src="{{asset($user->photo)}}" class="img-fluid">
          </div>
          <div class="col-md-6">
            <p>{{$user->user->name}}</p>
            <p>{{$user->address}}</p>
            <p>{{$user->phone_no}}</p>
            <p>{{$user->nrc_no}}</p>
            <p>{{$user->date_of_birth}}</p>
          </div>
        </div>
      </div>
  </div>


@endsection