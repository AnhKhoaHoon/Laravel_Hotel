<!-- Bootstrap JS -->
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/chartjs/js/chart.js') }}"></script>
<script src="{{ asset('backend/assets/js/index.js') }}"></script>
<!--app JS-->
<script src="{{ asset('backend/assets/js/app.js') }}"></script>
<script>
    new PerfectScrollbar(".app-container")
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{asset('backend/assets/js/code.js')}}"></script>
<script src="{{asset('backend/assets/js/validate.min.js')}}"></script>
{{-- Toastr CSS --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
@if(Session::has('message'))
var type = "{{ Session::get('alert-type','info') }}"
switch(type){
case 'info':
toastr.info(" {{ Session::get('message') }} ");
break;

case 'success':
toastr.success(" {{ Session::get('message') }} ");
break;

case 'warning':
toastr.warning(" {{ Session::get('message') }} ");
break;

case 'error':
toastr.error(" {{ Session::get('message') }} ");
break;
}
@endif
</script>
