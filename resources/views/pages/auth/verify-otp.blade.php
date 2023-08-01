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
                                        <h3 class="mb-4">Verify OTP code.</h3>

                                        <div class="form-outline mb-2">
                                            <label class="form-label d-block text-start"
                                                   for="code">OTP</label>
                                            <input type="text" id="code" class="form-control form-control-lg"
                                                   name="code"/>
                                        </div>
                                        <div class="clearfix">
                                            <button class="btn btn-info btn-lg btn-block mb-3 mt-2 text-white"
                                                    type="button" onclick="verifyOTP()">Verify
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
        async function verifyOTP() {
            let code = document.getElementById('code').value;
            if (code.length === 0) {
                errorToast('Code is required');
            } else {

                try {
                    let response = await axios.post('/user/verify-otp-mail', {
                        email: sessionStorage.getItem('email'),
                        code: code
                    });

                    if (response.status === 200) {
                        successToast("OTP verification successful.");
                        setTimeout(() => {
                            window.location.href = '/user-reset-password';
                        }, 1000);
                    } else {
                        errorToast("Something went wrong.");
                    }
                } catch (e) {
                    if (e.response.status === 401) {
                        errorToast("OTP not found.");
                    } else {
                        errorToast("Something went wrong.");
                    }

                }
            }
        }
    </script>
@endsection
