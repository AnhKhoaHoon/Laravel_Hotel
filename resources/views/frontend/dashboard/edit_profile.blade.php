@extends('frontend.main_master')
@section('main')
  <!-- Inner Banner -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <div class="inner-banner inner-bg6">
      <div class="container">
          <div class="inner-title">
              <ul>
                  <li>
                      <a href="{{route('Index')}}">Home</a>
                  </li>
                  <li><i class='bx bx-chevron-right'></i></li>
                  <li>User Dashboard </li>
              </ul>
              <h3>User Dashboard</h3>
          </div>
      </div>
  </div>
  <!-- Inner Banner End -->

  <!-- Service Details Area -->
  <div class="service-details-area pt-100 pb-70">
      <div class="container">
          <div class="row">
              <div class="col-lg-3">
           @include('frontend.dashboard.user_menu')
              </div>

              <div class="col-lg-9">
                <div class="service-article">
                  <section class="checkout-area pb-70">
                    <div class="container">
                      <form action="{{route('user.profile.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-lg-12 col-md-12">
                            <div class="billing-details">
                              <h3 class="title">User Profile</h3>

                              <div class="row">
                                <div class="col-lg-12 col-md-12">
                                  <div class="form-group">
                                    <label
                                      > Name
                                      <span class="required">*</span></label
                                    >
                                    <input placeholder="Please enter your name " name="name" type="text" class="form-control" value={{$profileData->name}} />
                                  </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                  <div class="form-group">
                                    <label
                                      >Email
                                      <span class="required">*</span></label
                                    >
                                    <input placeholder="Please enter your email "  name="email" type="email" class="form-control"  value={{$profileData->email}}  />
                                  </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                      <label
                                        >Address <span class="required">*</span></label
                                      >
                                      <textarea placeholder="Please enter your address "  name="address" type="text" class="form-control"  >
                                        {{$profileData->address}}
                                      </textarea>
                                    </div>
                                  </div>

                                <div class="col-lg-12 col-md-12">
                                  <div class="form-group">
                                    <label
                                      >Phone <span class="required">*</span></label
                                    >
                                    <input placeholder="Please enter your phone "  name="phone" type="text" class="form-control" value={{$profileData->phone}}  />
                                  </div>
                                </div>

                                <div class="col-lg-12 col-md-6">
                                  <div class="form-group">
                                    <label
                                      >User Profile
                                      <span class="required">*</span></label
                                    >
                                    <input name="photo" id="images" type="file" class="form-control" />
                                  </div>
                                </div>

                                <div class="col-lg-12 col-md-6">
                                    <div class="form-group">
                                        <img id="showImage"
                                        src="{{ !empty($profileData->photo) ? url('upload/user_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                        width="80" height="80" class="rounded-circle shadow" alt="">
                                    </div>
                                  </div>


                                <button  type="submit" class="btn btn-danger">
                                  Save Changes
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </section>
                </div>
              </div>
          </div>
      </div>
  </div>
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
  <!-- Service Details Area End -->
  @endsection
