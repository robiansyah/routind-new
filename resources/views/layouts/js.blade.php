<!-- begin::Global Config(global config for global JS sciprts) -->
<noscript>
    <div class="center-noscript">
        <img class="img-responsive" alt="error-noscript" src="{{ url('assets/media/error/error1.jpg') }}" />
        <p>Sepertinya javascript Anda tidak aktif :( . Untuk mengakses halaman ini pastikan javascript Anda aktif.</p>
    </div>
</noscript>
<script>
    window.onscroll = function () {
        myFunction()
    };

    var header = document.getElementById("kt_header_mobile");
    var sticky = header.offsetTop;

    function myFunction() {
        if (window.pageYOffset > sticky) {
            header.classList.add("sticky");
            $(".menu-wrapper-djp").addClass("sticky-main");
            $(".user-djp").addClass("sticky-user");
        } else {
            header.classList.remove("sticky");
            $(".menu-wrapper-djp").removeClass("sticky-main");
            $(".user-djp").removeClass("sticky-user");
        }
    }
</script>
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#374afb",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#F04DBA",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#F04DBA",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>
<!-- end::Global Config -->
<!--begin:: Global Mandatory Vendors -->
<script src="{{ url('assets/vendors/general/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/popper.js@1.14.7/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
{{-- <script src="{{ url('assets/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script> --}}
<script src="{{ url('assets/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
<script src="https://unpkg.com/tooltip.js@1.3.3/dist/umd/tooltip.min.js" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>
<!--end:: Global Mandatory Vendors -->
<!--begin:: Global Optional Vendors -->
<script src="{{ url('assets/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/custom/js/vendors/sweetalert2.init.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
<!--end:: Global Optional Vendors -->
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ url('assets/js/djp/scripts.bundle.min.js') }}" type="text/javascript"></script>
<!--end::Global Theme Bundle -->
<!--begin::Page Scripts(used by this page) -->

