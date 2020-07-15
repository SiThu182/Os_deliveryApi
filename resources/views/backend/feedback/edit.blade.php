@extends('backend.backend_template')
@section('content')
<h1 class="text-center mt-4">Edit Township</h1>
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Township<i class="float-right">

		</i></div>
		<div class="row">
			<div class="col-8 offset-2">
				<div class="card-body ">
					<form method="post" 
					action="{{route('township.update',$township->id)}}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
					<div class="card mb-4">
						 <div class="card-body">
                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                    <div class="col-md-6">
                                        <select class="custom-select" name="city_id">
                                          <option disabled>Please Choose One</option>
                                          @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Township') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" name="township_name" id = "class_name" class="form-control @error('township_name') is-invalid @enderror" placeholder="Enter Township Name" value="{{$township->township_name}}">
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