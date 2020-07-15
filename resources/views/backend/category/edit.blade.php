@extends('backend.backend_template')
@section('content')
<h1 class="text-center mt-4">Edit Subject</h1>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Subject<i class="float-right">

		</i></div>
		<div class="row">
			<div class="col-6 offset-3">
				<div class="card-body ">
					<form method="post" 
					action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="card mb-4">
						<div class="card-body">
							<div class="form-group">
								<label>Class</label>
								<input type="text" name="category_name" class="form-control" value = "{{$category->category_name}}">
							</div>
							<div class="form-group">
								<input type="submit" class=" btn btn-outline-primary float-right" name="save" 
								value="Update">
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>


		@endsection