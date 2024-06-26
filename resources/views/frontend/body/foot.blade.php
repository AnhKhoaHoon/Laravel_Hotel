<!-- Jquery Min JS -->
<script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
<!-- Bootstrap Bundle Min JS -->
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!-- Magnific Popup Min JS -->
<script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Owl Carousel Min JS -->
<script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
<!-- Nice Select Min JS -->
<script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
<!-- Wow Min JS -->
<script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
<!-- Jquery Ui JS -->
<script src="{{ asset('frontend/assets/js/jquery-ui.js') }}"></script>
<!-- Meanmenu JS -->
<script src="{{ asset('frontend/assets/js/meanmenu.js') }}"></script>
<!-- Ajaxchimp Min JS -->
<script src="{{ asset('frontend/assets/js/jquery.ajaxchimp.min.js') }}"></script>
<!-- Form Validator Min JS -->
<script src="{{ asset('frontend/assets/js/form-validator.min.js') }}"></script>
<!-- Contact Form JS -->
<script src="{{ asset('frontend/assets/js/contact-form-script.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
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
