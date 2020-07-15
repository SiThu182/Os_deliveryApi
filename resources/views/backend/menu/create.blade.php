@extends('backend.backend_template')
@section('content')
     <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select class="custom-select" name="category_id">
                                  <option disabled>Please Choose One</option>
                                  @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>

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
                            <label for="menu_name" class="col-md-4 col-form-label text-md-right">{{ __('Menu Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('menu_name') is-invalid @enderror" name="menu_name" value="{{ old('menu_name') }}" required autocomplete="name" autofocus>

                                @error('menu_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="menu_photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            <div class="col-md-6">
                                <input id="menu_photo" type="file" class="form-control @error('menu_photo') is-invalid @enderror" name="menu_photo" value="{{ old('menu_photo') }}" required autocomplete="menu_photo" autofocus>

                                @error('menu_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="menu_price" class="col-md-4 col-form-label text-md-right">{{ __('Menu Price') }}</label>

                            <div class="col-md-6">
                                <input id="menu_price" type="text" class="form-control @error('menu_price') is-invalid @enderror" name="menu_price" value="{{ old('menu_price') }}" required autocomplete="menu_price" autofocus>

                                @error('menu_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Any Descritption') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"  autocomplete="description" autofocus></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Destination') }}</label>

                            <div class="col-md-6">
                               <div class="row">
                                    @foreach($townships as $township)
                                    <div class="col-md-6">   
                                        <input type="checkbox" name="destination[]" value="{{$township->id}}">
                                         <label for="role">{{$township->township_name}}</label>
                                    </div>
                                    @endforeach
                               </div>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Menu') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection