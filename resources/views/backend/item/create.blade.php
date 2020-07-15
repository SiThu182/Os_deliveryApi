@extends('backend.backend_template')
@section('content')
     <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Item</div>

                <div class="card-body">
                    <form method="POST" action="{{route('item.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Category</label>

                            <div class="col-md-6">
                                <select class="custom-select" name="category">
                                  <option disabled>Please Choose One</option>
                                  @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Shop</label>

                            <div class="col-md-6">
                                <select class="custom-select" name="shop">
                                  <option disabled>Please Choose One</option>
                                  @foreach($shops as $shop)
                                    <option value="{{$shop->id}}">{{$shop->shop_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="item_name" class="col-md-4 col-form-label text-md-right"> Item Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="item_name"   required autocomplete="name" autofocus>

                               
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="menu_photo" class="col-md-4 col-form-label text-md-right"> Photo </label>

                            <div class="col-md-6">
                                <input id="item_photo" type="file" class="form-control  " name="item_photo" required autocomplete="menu_photo" autofocus>
 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="menu_price" class="col-md-4 col-form-label text-md-right">item Price </label>

                            <div class="col-md-6">
                                <input id="item_price" type="text" class="form-control  " name="item_price"   required autocomplete="item_price" autofocus>

                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right"> Any Descritption </label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control " name="description"   autocomplete="description" autofocus></textarea>

                                 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right"> Destination </label>

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
                                   Add Item
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection