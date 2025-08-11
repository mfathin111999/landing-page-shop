<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>

    <body class="bg-main">
        <div class="container main-wrapper d-flex align-items-start align-items-md-center justify-content-center small">
            <div class="row align-items-center rounded-5 shadow-sm border border-light-subtle py-4 px-2 px-sm-4 mt-5 mt-md-0">
                <div class="col-12 col-md-4 d-flex justify-content-center flex-wrap mb-4 mb-md-0">
                    <img class="img-fluid" src="{{ asset('/img/logo-carkensaku-transparent.png') }}" alt="login-logo">
                </div>
                <div class="mb-2 col-12 col-md-8 pt-md-4">
                    <form action="{{ route('authenticate') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input class="form-control" id="floatingInput" name="email" type="text" placeholder="name@example.com">
                            <label for="floatingInput">{{ __('trans.username') }}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="floatingPassword" name="password" type="password" placeholder="Password">
                            <label for="floatingPassword">{{ __('trans.password') }}</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" id="flexSwitchCheckDefault" name="remember" type="checkbox" role="switch">
                            <label class="form-check-label fw-bold" for="flexSwitchCheckDefault">{{ __('trans.remember_me') }}</label>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="d-grid d-md-flex justify-content-md-between align-items-center flex-wrap mt-5">
                            <a class="text-decoration-none text-primary d-none d-md-inline-block fw-bold" href="">
                                {{ __('trans.forgot_password') }}
                            </a>
                            <button class="btn btn-light fw-bold" type="submit">{{ __('trans.login') }}</button>
                        </div>
                    </form>
                </div>

                <div class="text-center d-md-none">
                    <a class="text-decoration-none text-primary fw-bold" href="">
                        {{ __('trans.forgot_password') }}
                    </a>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    </body>

</html>
