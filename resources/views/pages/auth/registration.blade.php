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
                        <div class="col-12 col-md-8">
                            <div class="card shadow-2-strong">
                                <div class="card-body p-5 text-center">
                                    <form action="/user/login" method="post">
                                        <h3 class="mb-4">Register</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-outline mb-2">
                                                    <label class="form-label d-block text-start"
                                                           for="firstName">First Name</label>
                                                    <input type="text" id="firstName"
                                                           class="form-control form-control-lg"
                                                           name="firstName"/>
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-outline mb-2">
                                                    <label class="form-label d-block text-start"
                                                           for="lastName">Last Name</label>
                                                    <input type="text" id="lastName"
                                                           class="form-control form-control-lg"
                                                           name="lastName"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-outline mb-2">
                                                    <label class="form-label d-block text-start"
                                                           for="phone">Phone</label>
                                                    <input type="text" id="phone"
                                                           class="form-control form-control-lg"
                                                           name="phone"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-outline mb-2">
                                                    <label class="form-label d-block text-start"
                                                           for="email">Email</label>
                                                    <input type="email" id="email"
                                                           class="form-control form-control-lg"
                                                           name="email"/>
                                                </div>

                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-outline mb-2">
                                                    <label class="form-label d-block text-start"
                                                           for="password">Password</label>
                                                    <input type="password" id="password" name="password"
                                                           class="form-control form-control-lg"/>
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-outline mb-2">
                                                    <label class="form-label d-block text-start"
                                                           for="cpassword">Confirm Password</label>
                                                    <input type="password" id="cpassword" name="cpassword"
                                                           class="form-control form-control-lg"/>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-info btn-lg btn-block mb-3 mt-2 text-white"
                                                type="button" onclick="registerUser()">Register
                                        </button>

                                        <p class="text-muted ">Don't have an account?<a
                                                href="{{ route('user.login.view') }}"
                                                class="mx-2 text-decoration-none">Login</a>
                                        </p>
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

        async function registerUser() {
            let firstName = document.getElementById('firstName').value;
            let lastName = document.getElementById('lastName').value;
            let phone = document.getElementById('phone').value;
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let cpassword = document.getElementById('cpassword').value;

            if (firstName.length === 0) {
                errorToast('First Name is required');
            } else if (lastName.length === 0) {
                errorToast('Last Name is required');
            } else if (phone.length === 0) {
                errorToast('Phone is required');
            } else if (email.length === 0) {
                errorToast('Email is required');
            } else if (password.length === 0) {
                errorToast('Password is required');
            } else if (cpassword.length === 0) {
                errorToast('Confirm Password is required');
            } else if (password !== cpassword) {
                errorToast(password + ' ' + cpassword);
                errorToast('Password and Confirm Password must be same');
            } else {

                try {
                    const response = await axios.post('/user/registration', {
                        firstName: firstName,
                        lastName: lastName,
                        phone: phone,
                        email: email,
                        password: password,
                    });

                    if (response.status === 200) {
                        successToast("User registration successful.");
                        setTimeout(function () {
                            window.location.href = '/user-login';
                        }, 1000);
                    } else if (response.status === 401) {
                        errorToast("User already exists.");
                    } else {
                        errorToast("An error occurred while registering user. Please try again later.");
                    }
                } catch (error) {

                    if(error.response.status === 401){
                        errorToast("Duplicate user found.");
                    } else {
                        errorToast('An error occurred during the request.');
                    }
                }
            }
        }
    </script>
@endsection

