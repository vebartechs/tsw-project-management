<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - The Sparkling Wedding</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}} ">

    <link rel="stylesheet" href="{{asset('assets/vendors/iconly/bold.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    {{-- toster css & js--}}
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>

    {{-- custom CSs --}}
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">



    @yield('head-space')
</head>

<body>
    
    <div id="app">
        {{-- Nav bar --}}
        @include('layouts.navbar')

        {{-- END Navbar --}}


        {{-- Main Content --}}
        <div id="main">
            <header class="">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            

            <div class="body-content">
                {{-- Show error message --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
               
                {{-- Show info message --}}
                @if (session('info'))
                    <div class="alert alert-info">
                        {{ session('info') }}
                    </div>
                @endif
                {{-- Show warning message --}}
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                {{-- validation error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('body-space')
            </div>


            <footer>
                <div class="footer clearfix mb-0 mt-5 text-muted" >
                    <div class="float-start">
                        <p class="text-light mb-0"> {{'The Sparkling Wedding © '.date('Y').' | All Rights Reserved'}} </p>
                    </div>
                    <div class="float-end">
                        <p class="text-light mb-0">Crafted  <span class="text-danger"></span> by <a class="footer-link" href="https://vebartechs.com/">Vebartechs</a></p>
                    </div>
                </div>
            </footer>
        </div>
        {{-- Main Content End--}}
    </div>

     <script>
      
        @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "timeOut" : "9000",
            "extendedTimeOut" : "5000",
            "positionClass": "toast-top-center",
            "progressBar" : true
            
        }
                toastr.success("{{ session('success') }}");
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "timeOut" : "9000",
            "extendedTimeOut" : "5000",
            "positionClass": "toast-top-center",
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "timeOut" : "9000",
            "extendedTimeOut" : "5000",
            "positionClass": "toast-top-center",
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "timeOut" : "9000",
            "extendedTimeOut" : "5000",
            "positionClass": "toast-top-center",
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif

    </script>

    <script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    
    
    {{-- <script src="{{asset('assets/js/pages/dashboard.js')}}"></script> --}}
    
    <script src="{{asset('assets/js/main.js')}}"></script>
    

    
    @yield('foot-space')

    
</body>

</html>
