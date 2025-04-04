@extends('templates.template')
@section('content')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">UMKM</h1>
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
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->umkm_name}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{$item->contact}}</td>
                                        <td>{{$item->status}}</td>
                                        <td>
                                            @if ($item->status === 'pending')
                                            <a href="" data-status="{{$item->id}}" id="approve" class="btn btn-primary"><i class="fas fa-thumbs-up"></i> Approve</a>
                                            <a href="" data-status="{{$item->id}}" id="reject" class="btn btn-danger"><i class="fas fa-ban"></i> Reject</a>
                                            @endif
                                            @if ($item->status === 'reject')
                                            <a href="#deleteData{{$item->id}}" class="btn btn-danger" data-toggle="modal"><i class="fas fa-trash"></i> Delete</a>
                                            @endif
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
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Data UMKM</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact Number</label>
                                <input type="text" name="contact" class="form-control" id="contact" placeholder="Contact Number">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="user_id" id="role" class="form-control">
                                    @foreach ($user as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
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
              <script>
                document.getElementById('approve').addEventListener('click', function() {
                    let dataId = this.getAttribute('data-status');
                    $.ajax({
                        url: `/admin/umkm/${dataId}`,
                        type: 'PUT',
                        dataType: 'json',
                        cache: false,
                        data: {
                            'status' : 'approve',
                            '_token' : '{{csrf_token()}}'
                        }
                    })
                })
                document.getElementById('reject').addEventListener('click', function() {
                    let dataId = this.getAttribute('data-status');
                    $.ajax({
                        url: `/admin/umkm/${dataId}`,
                        type: 'PUT',
                        dataType: 'json',
                        cache: false,
                        data: {
                            'status' : 'reject',
                            '_token' : '{{csrf_token()}}'
                        }
                    })
                })
              </script>
@endsection