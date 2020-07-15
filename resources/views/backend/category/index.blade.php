@extends('backend.backend_template')
@section('content')
	  <h1 class="text-center mt-4">Manage Category</h1>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Category List <i class="float-right">

        <a href="{{route('category.create')}}" class="btn btn-primary">Add New</a>
      </i></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>

             <tbody>
              @foreach($categories as $key=> $category)
              <tr>
                <td>{{ ++$key}}</td>
                <td>{{$category->category_name}}</td>
                <td> <a href=
                  "{{route('category.edit',$category->id)}}" class="btn btn-outline-info d-inline">Edit</a></td>
                  <td>

                    <form class="d-inline" method="post"  action = 
                    "{{route('category.destroy',$category->id)}}" onsubmit = "return confirm('Are You Sure Want To Delete?')">
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