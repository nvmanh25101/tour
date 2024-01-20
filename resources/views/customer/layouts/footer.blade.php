<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                2023 © TP
            </div>
            {{--            <div class="col-md-6">--}}
            {{--                <div class="text-md-right footer-links d-none d-md-block">--}}
            {{--                    <a href="javascript: void(0);">About</a>--}}
            {{--                    <a href="javascript: void(0);">Support</a>--}}
            {{--                    <a href="javascript: void(0);">Contact Us</a>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- bundle -->
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"--}}
{{--            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"--}}
{{--            crossorigin="anonymous"></script>--}}
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
@stack('js')
</body>

</html>
