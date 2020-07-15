@extends('backend.backend_template')
@section('content')
     <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Shop Create</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('shop.update',$shop->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group row">
                            <label for="shop_name" class="col-md-4 col-form-label text-md-right">{{ __('Shop Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name"  required autocomplete="name" autofocus value="{{$shop->shop_name}}">

                                @error('shop_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label for="shop_address" class="col-md-4 col-form-label text-md-right">{{ __('Shop Address') }}</label>

                            <div class="col-md-6">
                                <input id="shop_address" type="text" class="form-control @error('shop_address') is-invalid @enderror" name="shop_address" value="{{  $shop->shop_address  }}" autocomplete="shop_address" autofocus>

                                @error('shop_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Township') }}</label>

                            <div class="col-md-6">
                                <select class="custom-select" name="township">
                                  <option  disabled>Please Choose One</option>
                                  @foreach($townships as $township)
                                    <option value="{{$township->id}}"
                                        @if($shop->township_id == $township->id)
                                        {{'seslected'}}
                                        @endif
                                        >{{$township->township_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{  $shop->phone_no  }}" required autocomplete="phone_no" autofocus>

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shop_photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            <div class="col-md-3">
                                <input id="shop_photo" type="file" class="form-control @error('shop_photo') is-invalid @enderror" name="shop_photo" value="{{ old('shop_photo') }}" required autocomplete="shop_photo" autofocus>

                                @error('shop_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <img src="{{$shop->shop_photo}}" width="200" height="300">
                                <input type="hidden" name="old_photo">
                            </div>
                        </div>
                      
                      
                     
 

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection