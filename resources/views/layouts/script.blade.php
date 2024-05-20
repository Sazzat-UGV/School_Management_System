<!-- Bootstrap JS -->
<script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{ asset('assets') }}/js/jquery.min.js"></script>
<script src="{{ asset('assets') }}/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{ asset('assets') }}/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{ asset('assets') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{ asset('assets') }}/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="{{ asset('assets') }}/js/widgets.js"></script>
<!--app JS-->
<script src="{{ asset('assets') }}/js/app.js"></script>

<!-- sweetalert2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr-->
{{-- <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script> --}}
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

<!-- Logout confirmation-->
<script>
    $(document).ready(function() {
        $('#logout').on('click', function(event) {
            event.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, logout!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });
    });
</script>

@stack('script')
