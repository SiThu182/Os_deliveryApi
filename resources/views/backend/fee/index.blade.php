@extends('backend.backend_template')
@section('content')
	  <h1 class="text-center mt-4">Manage Fee</h1>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Fee List <i class="float-right">

        <a href="{{route('fee.create')}}" class="btn btn-primary">Add New</a>
      </i></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>From</th>
                <th>To</th>
                <th>Fee</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>

             <tbody>
              @foreach($fees as $key=> $fee)
              <tr>
                <td>{{ ++$key}}</td>
                <td>{{$fee->from_township->township_name}}</td>
                <td>{{$fee->to_township->township_name}}</td>
                <td>{{$fee->cost}}</td>
               {{-- <td> <a href=
                  "{{route('fee.edit',$fee->id)}}" class="btn btn-outline-info d-inline">Edit</a></td>--}}
                  <td>

                    <form class="d-inline" method="post"  action = 
                    "{{route('fee.destroy',$fee->id)}}" onsubmit = "return confirm('Are You Sure Want To Delete?')">
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