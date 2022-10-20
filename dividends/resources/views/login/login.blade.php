@extends('layout.main_layout')

@section('page_info')
    <?php

    $pageInfo = [
        'name' => 'login'
    ];
    ?>
@endsection

@section('title')
    Авторизация
@endsection

<!---------- HEAD ---------->
@section('head')

    <style>
        .container{
            background-color: #00000000;
        }

        .text-copyright{
            color: #fff8;
        }
    </style>


    <!-- Волны -->
    <script src="{{ URL::to('dividends/resources/js/VantaJS/three.min.js') }}"></script>
    <script src="{{ URL::to('dividends/resources/js/VantaJS/vanta.waves.min.js') }}"></script>

@endsection
<!-------------------------->

@section('body')

    <!-- Волны -->
    <div id="waves-background"></div>

    <br><br>

    <div class="container">
        <div class="row justify-content-sm-center h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 ">

                <br><br><br><br><br><br>

                <div class="card shadow-lg ">
                    <div class="card-body p-5">
                        <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                        <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="/dividends/login">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">
                                <div class="invalid-feedback">
                                    Email is invalid
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>
                                    <a href="forgot.html" class="float-end">
                                        Forgot Password?
                                    </a>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" required="">
                                <div class="invalid-feedback">
                                    Password is required
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-dark btn-block">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Don't have an account? <a href="/dividends/registration" class="text-dark">Create One</a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 text-copyright">
                    Copyright © 2017-2021 — FinDesck
                </div>
            </div>
        </div>
    </div>


    <!-- Волны -->
    <script>
        VANTA.WAVES({
            el: "#waves-background",
            mouseControls: true,
            touchControls: true,
            gyroControls: true,
            minHeight: window.innerHeight,
            minWidth: 200.00,
            scale: 1.00,
            scaleMobile: 1.00,
            color: 0x0,
            shininess: 43.00,
            waveHeight: 29.50,
            waveSpeed: 0.35,
            zoom: 0.65
        })
    </script>

@endsection
