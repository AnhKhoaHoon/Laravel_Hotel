@extends('admin.admin_dashboard')
@section('title','All Team')
@section('admin')

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Team</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Team</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('add.team')}}" class="btn btn-primary">Add Team</a>

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
                                <th>Position</th>
                                <th>Facebook</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataTeam as $key => $team )
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td><img src="{{asset($team->image)}}" width="150px" height="150px" alt=""></td>
                                <td>{{$team->name}}</td>
                                <td>{{$team->position}}</td>
                                <td>{{$team->link_fb}}</td>
                                <td>
                                    <a href="{{route('edit.team',$team->id)}}" class="btn btn-warning px-3 radius-30"> Edit</a>

                                    <a href="{{route('delete.team',$team->id)}}" id="delete" class="btn btn-danger px-3 radius-30"> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>


<!--end page wrapper -->
@endsection
