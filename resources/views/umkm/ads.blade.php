@extends('templates.umkm')
@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ads</h1>
    <a href="#" type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal"><i
        class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
</div>

<div class="content-header">
    <div id="flash-data-success" data-flash-success="{{ Session('success') }}"></div>
    <div id="flash-data-error" data-flash-error="{{ session('error') }}"></div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Ad Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td><img src="{{asset('uploads/ads/'.$item->ad_image)}}" style="max-width: 10em; max-height: 3em;" alt=""> {{$item->product->product_name}}</td>
                        <td>{{$item->ad_title}}</td>
                        <td>{{$item->start_date}}</td>
                        <td>{{$item->end_date}}</td>
                        <td>
                            <a href="#editData{{$item->id}}" class="btn btn-secondary btn-sm" data-toggle="modal"><i class="fas fa-edit"></i> Edit</a>
                            <a href="#deleteData{{$item->id}}" class="btn btn-danger btn-sm" data-toggle="modal"><i class="fas fa-trash"></i> Delete</a>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Ads</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="/umkm/ads/{{$item->id}}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="product">Product</label>
                                            <select name="product_id" class="form-control" id="product">
                                            @foreach ($product as $pr)
                                                <option value="{{$pr->id}}" {{$pr->id == $item->product->id ? 'selected' : ''}}>{{$pr->product_name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact">Image</label>
                                            <input type="file" name="image" accept="image/*" class="form-control" id="contact" placeholder="Image">
                                        </div>
                                        <div class="form-group">
                                            <label for="adTitle">Ad Title</label>
                                            <input type="text" name="ad_title" value="{{$item->ad_title}}" class="form-control" id="adTitle" placeholder="Ad Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="adContent">Ad Content</label>
                                            <input type="text" name="ad_content" value="{{$item->ad_content}}" class="form-control" id="adContent" placeholder="Ad Content">
                                        </div>
                                        <div class="form-group">
                                            <label for="startDate">Start Date</label>
                                            <input type="date" name="start_date" value="{{$item->start_date}}" class="form-control" id="startDate" placeholder="Start Date">
                                        </div>
                                        <div class="form-group">
                                            <label for="endDate">End Date</label>
                                            <input type="date" name="end_date" value="{{$item->end_date}}" class="form-control" id="endDate" placeholder="End Date">
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product">Product</label>
                        <select name="product_id" class="form-control" id="product">
                        @foreach ($product as $item)
                            <option value="{{$item->id}}">{{$item->product_name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contact">Image</label>
                        <input type="file" name="image" accept="image/*" class="form-control" id="contact" placeholder="Image">
                    </div>
                    <div class="form-group">
                        <label for="adTitle">Ad Title</label>
                        <input type="text" name="ad_title" class="form-control" id="adTitle" placeholder="Ad Title">
                    </div>
                    <div class="form-group">
                        <label for="adContent">Ad Content</label>
                        <input type="text" name="ad_content" class="form-control" id="adContent" placeholder="Ad Content">
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" name="start_date" class="form-control" id="startDate" placeholder="Start Date">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" name="end_date" class="form-control" id="endDate" placeholder="End Date">
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