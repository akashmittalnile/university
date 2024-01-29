<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{!! asset('admin/images/logo.png') !!}">
    <title>University PMO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('admin/css/common.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/css/sidebar.css') }}" />
    <script src="https://code.jquery.com/jquery-1.12.0.min.js" type="text/javascript"></script>
    @stack('css')
    <style>
        .swal2-confirm {
            background: #3FAB40 !important;
        }
    </style>
</head>

<body>
    <div class="grid-container">

        @include('layouts.admin.sidebar')
        @yield('content')

    </div>

    <!-- --------preloader----------- -->
    <div id="preloader">
        <div class="loader-bg">
            <div class="loader-p">
                
            </div>
        </div>
    </div>
     <!-- --------preloader----------- -->

    <!-- Scripts -->

    <script type="text/javascript">
        let baseUrl = "{{ url('/') }}";
    </script>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>

    <!-- --------------------carousel links------------------------ -->


    <!-- Custom JS -->
    <script src="{{ asset('admin/js/script.js') }}"></script>
    <script src="{{ asset('admin/js/common.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    @if ($success = Session::get('success'))
        <script>
            // toastr.success("{{ $success }}")
            Swal.fire('Success', "{{ $success }}", 'success')
        </script>
        @php
            Session::forget('success');
        @endphp
    @endif

    @if ($error = Session::get('error'))
        <script>
            Swal.fire('Error', "{{ $error }}", 'error')
        </script>
        @php
            Session::forget('error');
        @endphp
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire('Error', "{{ $error }}", 'error')
            </script>
        @endforeach
    @endif
    @stack('js')
</body>

</html>
