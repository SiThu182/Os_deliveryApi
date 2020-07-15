@extends('backend.backend_template')
@section('content')
	  <h1 class="text-center mt-4">Read Feedback</h1>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>

        {{-- <a href="{{route('township.create')}}" class="btn btn-primary">Add New</a> --}}
      </i></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Delete</th>
              </tr>
            </thead>

             <tbody>
              @foreach($feedbacks as $key=> $feedback)
              <tr>
                <td>{{ ++$key}}</td>
                <td>{{$feedback->user_detail->user->name}}</td>
                  <td>

                    <form class="d-inline" method="post"  action = 
                    "{{route('feedback.destroy',$feedback->id)}}" onsubmit = "return confirm('Are You Sure Want To Delete?')">
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