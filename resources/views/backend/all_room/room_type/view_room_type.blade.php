@extends('admin.admin_dashboard')
@section('title','Room Type')
@section('admin')

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Room Type</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Room Type</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('add.room.type')}}" class="btn btn-primary">Add Room Type</a>

                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example"  class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roomType as $key => $roomType )
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td></td>
                                <td>{{$roomType->name}}</td>
                                <td>
                                    <a href="{{route('edit.room.type',$roomType->id)}}" class="btn btn-warning px-3 radius-30"> Edit</a>

                                    <a href="{{route('room.type.delete',$roomType->id)}}" id="delete" class="btn btn-danger px-3 radius-30"> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>


<!--end page wrapper -->
@endsection