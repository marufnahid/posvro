@extends('layouts.auth')

@section('style')
    body {
    background-color: #f2f2f2;
    }

    .btn {
    background: linear-gradient(45deg, cornflowerblue, violet);
    }
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card shadow-2-strong">
                                <div class="card-body p-5 text-center">
                                    <form action="/user/login" method="post">
                                        <h3 class="mb-4">Login</h3>

                                        <div class="form-outline mb-2">
                                            <label class="form-label d-block text-start"
                                                   for="email">Email</label>
                                            <input type="email" id="email" class="form-control form-control-lg"
                                                   name="email"/>
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label d-block text-start"
                                                   for="password">Password</label>
                                            <input type="password" id="password" name="password"
                                                   class="form-control form-control-lg"/>
                                        </div>

                                        <div class="form-outline mb-2 clearfix">
                                            <div class="float-end">
                                                <a href="{{ route('user.get.otp-code.view') }}">Forgotten password?</a>
                                            </div>
                                        </div>
                                        <div class="clearfix">
                                            <button class="btn btn-info btn-lg btn-block mb-3 mt-2 text-white"
                                                    type="button" onclick="loginUser()">Login
                                            </button>

                                            <p class="text-muted ">Don't have an account?<a
                                                    href="{{ route('user.registration.view') }}"
                                                    class="mx-2 text-decoration-none">Register</a>
                                            </p>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('script')
    <script>
        async function loginUser() {
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;

            if (email.length === 0) {
                errorToast('Email is required');
            } else if (password.length === 0) {
                errorToast('Password is required');
            } else {

                try {
                    let response = await axios.post('/user/login', {
                        email: email,
                        password: password
                    });

                    if (response.status === 200) {
                        successToast("Login Successful.");
                        setTimeout(() => {
                            window.location.href = '/user/dashboard';
                        }, 1000);
                    } else {
                        errorToast("Something went wrong.");
                    }
                } catch (e) {
                    if (e.response.status === 401) {
                        errorToast("User not found.");
                    } else {
                        errorToast("Something went wrong.");
                    }

                }
            }
        }
    </script>
@endsection
