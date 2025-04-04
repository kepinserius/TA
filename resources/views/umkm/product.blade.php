@extends('templates.umkm')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4" style="height: 8px;">
        <h5 class="h4 mb-0 text-gray-800">Products</h5>
        <a href="#" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal"><i
            class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
    </div>
    <div class="content-header">
        <div id="flash-data-success" data-flash-success="{{ Session('success') }}"></div>
        <div id="flash-data-error" data-flash-error="{{ session('error') }}"></div>
    </div>
    <div class="card shadow p-0" style="padding-bottom: 0;">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td><img src="{{asset('uploads/products/'.$item->image)}}" style="max-height: 5em; max-width: 5em;" alt=""> {{$item->product_name}}</td>
                                    <td>{{$item->category}}</td>
                                    <td>{{$item->stock}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->status ? 'Aktif' : 'Non-Aktif'}}</td>
                                    <td>
                                        <a href="#editData{{$item->id}}" class="btn btn-secondary" data-toggle="modal"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="#deleteData{{$item->id}}" class="btn btn-danger" data-toggle="modal"><i class="fas fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                                <div id="deleteData{{ $item->id }}" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="/admin/umkm/{{ $item->id }}" method="GET">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Delete User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>yakin ingin menghapus data?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="editData{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <form action="/umkm/product/{{$item->id}}" method="post" enctype="multipart/form-data">
                                            @method('put')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" value="{{$item->product_name}}" class="form-control" id="name" placeholder="Nama Produk" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="category">Category</label>
                                                    <select name="category" id="category" class="form-control" required>
                                                        @foreach ($category as $ctg)
                                                            <option value="{{$ctg->name}}" {{ $ctg->name == $item->category ? 'selected' : ''}}>{{$ctg->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$item->description}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="stock">Stok</label>
                                                    <input type="text" name="stock" value="{{$item->stock}}" class="form-control" id="stock" placeholder="Price" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Price</label>
                                                    <input type="text" name="price" value="{{$item->price}}" class="form-control" id="address" placeholder="Price" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="discount">Dicsount</label>
                                                    <div class="input-group">
                                                        <input type="text" name="discount" value="{{$item->discount}}" class="form-control" id="discount" placeholder="Discount">
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" name="image" accept="image/*" class="form-control" id="image" placeholder="Image">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" class="custom-select" id="status">
                                                        <option value="1" {{$item->status ? 'selected' : ''}}>Aktif</option>
                                                        <option value="0" {{!$item->status ? 'selected' : ''}}>Non-Aktif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                            
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Nama Produk" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control" required>
                            @foreach ($category as $item)
                                <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Price</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" name="price" onkeypress="return isNumber(event)" class="form-control" id="address" placeholder="Price" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stok</label>
                        <input type="text" name="stock" onkeypress="return isNumber(event)" class="form-control" id="stock" placeholder="Stok" required>
                    </div>
                    <div class="form-group">
                        <label for="discount">Dicsount</label>
                        <div class="input-group">
                            <input type="text" name="discount" onkeypress="return isNumber(event)" class="form-control" id="discount" placeholder="Discount">
                            <div class="input-group-append">
                                <div class="input-group-text">%</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact">Image</label>
                        <input type="file" name="image" accept="image/*" class="form-control" id="contact" placeholder="Image" required>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
            </div>
        </div>
    </div>
@endsection