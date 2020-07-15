@extends('backend.backend_template')
@section('content')
	  <h1 class="text-center mt-4">Manage Item</h1>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      Menus List <i class="float-right">

        <a href="{{route('menu.create')}}" class="btn btn-primary">Add New</a>
      </i></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Price</th> 
                <th>Shop</th>
                <th>Description</th>
                <th>Detail</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>

            <tbody>
              @foreach($items as $key=> $item)
              <tr>
                <td>{{ ++$key}}</td>
                <td>{{$item->item_name}}</td>
                <td><img src="{{asset($item->item_photo)}}" class="img-fluid"
                  width="100" height="80"></td>
                <td>{{$item->item_price}}</td>
                <td>{{$item->shop->shop_name}}</td>
                <td>{{$item->description}}</td>
                <td> <a href=
                  "{{route('item.show',$item->id)}}" class="btn btn-outline-info d-inline">Show</a>
                  </td>                
                <td> <a href=
                  "{{route('item.edit',$item->id)}}" class="btn btn-outline-info d-inline">Edit</a></td>
                  <td>
                    <form class="d-inline" method="post"  action = 
                    "{{route('item.destroy',$item->id)}}" onsubmit = "return confirm('Are You Sure Want To Delete?')">
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