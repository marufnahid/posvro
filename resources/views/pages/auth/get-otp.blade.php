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
                                        <h3 class="mb-4">Get OTP code.</h3>

                                        <div class="form-outline mb-2">
                                            <label class="form-label d-block text-start"
                                                   for="email">Email</label>
                                            <input type="email" id="email" class="form-control form-control-lg"
                                                   name="email"/>
                                        </div>
                                        <div class="clearfix">
                                            <button class="btn btn-info btn-lg btn-block mb-3 mt-2 text-white"
                                                    type="button" onclick="getOTPCode()">Get Code
                                            </button>
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
        async function getOTPCode() {
            let email = document.getElementById('email').value;

            if (email.length === 0) {
                errorToast('Email is required');
            } else {

                try {
                    let response = await axios.post('/user/send-otp', {
                        email: email,
                    });

                    if (response.status === 200) {
                        successToast("OTP sent to your email successfully.");
                        sessionStorage.setItem('email', email);
                        setTimeout(() => {
                            window.location.href = '/user-verify-otp';
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
