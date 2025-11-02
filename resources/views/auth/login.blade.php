<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
</head>

<body>
    <div id="auth">

        <div class="row" style="height:100vh">
            <div class="col-lg-6 col-12">
                <div id="auth-left">
                    <div class="auth-logo mb-1">
                        {{-- <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" ></a> --}}
                    </div>
                    <h2 class="auth-title text-danger">Log in.</h2>
                    <p class="auth-subtitle mb-4"></p>

                    <form action="{{ route('login.submit') }}" method="POST" >
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-4 mt-5">
                            <input type="email" class="form-control form-control-xl" name="email" value="{{old('email')}}"
                                placeholder="Email" required autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="password"
                                placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                     
                        <button class="btn btn-danger btn-block btn-lg  mt-5">Log in</button>
                    </form>
                    <div class="text-center text-black-50 mt-2" style="font-size: 15px">
                       {{'The Sparkling Wedding © '.date('Y').' | All Rights Reserved'}}
                    </div>
                    @if (session()->has('message'))
                        <div class="alert alert-danger mt-1">
                            {{ session()->get('message') }}
                        </div>
                    @endif


                   
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>
