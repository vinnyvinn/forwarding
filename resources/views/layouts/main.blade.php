<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    {{--<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">--}}
    <title>FREIGHTWELL</title>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/colors/blue.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/wizard/steps.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body class="fix-header card-no-border logo-center">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<div id="main-wrapper">
    @include('partials.header')
    @include('partials.nav-bar')
    <div class="page-wrapper">

        @yield('content')

        <footer class="footer"> © {{ Date('Y') }} ESL</footer>
    </div>
</div>
<style type="text/css">
    .sidebar-nav ul li ul {
    padding: 15px;
    top: 45px;
}
@media (min-width: 992px)
{
    .modal-lg {
    max-width: 950px;
}
}
</style>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('assets/plugins/skycons/skycons.js') }}"></script>
<script src="{{ asset('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('assets/plugins/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/wizard/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/plugins/wizard/steps.js') }}"></script>
<script src="{{ asset('assets/plugins/wizard/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/printThis.js') }}" type="text/JavaScript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function () {
    $('.datatable').DataTable();
  $('#dtforall').DataTable();
   $('#dtforall2').DataTable();
   $('#dtforall3').DataTable();
  $('.dataTables_length').addClass('bs-select');
});
</script>
@include('sweetalert::alert')
<script>

    $(document).ready(function(){
        var date_input=$('.datepicker'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
        $('.select2').select2();

    })

    $(".select2").select2();
    $('.selectpicker').selectpicker();
    function submitForm(form, formUrl, redirectUrl = 'current'){
        var formId = form.id;
        var vessel = $('#'+formId);

        var data = vessel.serializeArray().reduce(function(obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        axios.post('{{ url('/') }}' + formUrl, data)
            .then(function (response) {
                var details = response.data.success;

                console.log(details);
                if (redirectUrl === 'current'){
                    window.location.reload();
                }
                else {
                    window.location.href = details.redirect;
                }

            })
            .catch(function (response) {
                console.log(response.data);
            });

    }

    function cssLoader() {
        $(function () {
            $(".preloader").fadeIn();
        });
    }

    function stopLoader() {
        $(function () {
            $(".preloader").fadeIn();
        });
    }

    function deleteItem(id, deleteUrl) {
        axios.post('{{ url('/') }}' + deleteUrl, {
            'item_id' : id,
            '_token' : '{{ csrf_token() }}'
        })
            .then(function (response) {
                window.location.reload();
            })
            .catch(function (response) {
                console.log(response);
            });
    }


    $(document).ready(function() {
        $("#print").click(function() {
            $('.printableArea').printThis({
                importCSS: true,            // import page CSS
                importStyle: true,
//                footer: "test",
                loadCSS: "{{ asset('css/print.css') }}",
//                base: "https://jasonday.github.io/printThis/"
            });
        });
    });


</script>

@yield('scripts')
</body>

</html>
