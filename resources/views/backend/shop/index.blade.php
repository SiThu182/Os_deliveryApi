@extends('backend.backend_template')
@section('content')
	  <h1 class="text-center mt-4">Manage Users</h1>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Users List <i class="float-right">

        <a href="{{route('shop.create')}}" class="btn btn-primary">Add New</a>
      </i></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Shop Name</th>
                <th>Shop Photo</th>
                <th>Shop Address</th>
                <th>Township</th> 
                <th>Phone No</th>
                <th>Detail</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>

            <tbody>
              @foreach($shops as $key=> $user)
              <tr>
                <td>{{ ++$key}}</td>
                <td>{{$user->shop_name}}</td>
                <td><img src="{{$user->shop_photo}}" class="img-fluid"
                  width="100" height="80"></td>
                <td>{{$user->shop_address}}</td>
                <th>{{$user->township->township_name}}</th>
                <td>{{$user->phone_no}}</td>
                <td> <a href=
                  "{{route('user_detail.show',$user->id)}}" class="btn btn-outline-info d-inline">Show</a>
                  </td>                
                <td> <a href=
                  "{{route('shop.edit',$user->id)}}" class="btn btn-outline-info d-inline">Edit</a></td>
                  <td>
                    <form class="d-inline" method="post"  action = 
                    "{{route('user_detail.destroy',$user->id)}}" onsubmit = "return confirm('Are You Sure Want To Delete?')">
                    @csrf
                    @method('DELETE')
                    <input type="submit" name="btnsubmit" value="Delete" class="btn btn-outline-danger">
                  </form></td>
                </tr>
                @endforeach



              </tbody>
            </table>
          </div>
        </div>

  </div>


@endsection