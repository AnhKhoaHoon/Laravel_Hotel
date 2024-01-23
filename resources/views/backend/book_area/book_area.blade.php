@extends('admin.admin_dashboard')
@section('title', 'Update Book Area')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Book Area</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Book Area</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="card">
                <form action="{{route('book.area.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="card-body p-4">
                    <h5 class="mb-4">Update </h5>
                    <input type="hidden" name="id" value="{{$dataBookArea->id}}">
                    <div class="row mb-3">
                        <label for="input42" class="col-sm-3 col-form-label"> Short Title</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input name="short_title" type="text" class="form-control" id="input42" placeholder="Enter Short Title" value="{{$dataBookArea->short_title}}">
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-user'></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input43" class="col-sm-3 col-form-label"> Main Title</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input name="main_title" type="text" class="form-control" id="input43" placeholder="Enter Main Title" value="{{$dataBookArea->main_title}}">
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-pin'></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input45" class="col-sm-3 col-form-label">Short Description</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input name="short_desc" type="text" class="form-control" id="input45" placeholder="Enter Short Description" value="{{$dataBookArea->short_desc}}">
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-link'></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input45" class="col-sm-3 col-form-label">Link Url</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input name="link_url" type="text" class="form-control" id="input45" placeholder="Enter Link" value="{{$dataBookArea->link_url}}">
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-link'></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="input45" class="col-sm-3 col-form-label">Update Image</label>
                        <div class="col-sm-9">
                            <div class="position-relative input-icon">
                                <input type="file" name="image" class="form-control" id="image" >
                                <span class="position-absolute top-50 translate-middle-y"><i class='bx bx-link'></i></span>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Image</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <img id="showImage"
                                src="{{asset($dataBookArea->image)}}"
                                width="80" height="80" class="rounded-circle shadow" alt="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="input48">
                                <label class="form-check-label" for="input48">Check me out</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                <button type="reset" class="btn btn-light px-4">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end row-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
