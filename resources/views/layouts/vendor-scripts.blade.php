<!-- JAVASCRIPT -->
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/metismenujs/metismenujs.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/eva-icons/eva.min.js') }}"></script>
@if (request()->is('home'))
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
    <!-- App js -->
@endif
<!-- gridjs js -->
<script src="{{ URL::asset('build/libs/gridjs/gridjs.umd.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.6/datatables.min.js"></script>
<!-- alertifyjs js -->
<script src="{{ URL::asset('build/libs/alertifyjs/build/alertify.min.js') }}"></script>
@stack('scripts')
