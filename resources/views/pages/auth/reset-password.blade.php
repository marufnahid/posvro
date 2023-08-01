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
                                        <h3 class="mb-4">Reset password</h3>

                                        <div class="form-outline mb-2">
                                            <label class="form-label d-block text-start"
                                                   for="password">Password</label>
                                            <input type="password" id="password" class="form-control form-control-lg"
                                                   name="password"/>
                                        </div>

                                        <div class="form-outline mb-2">
                                            <label class="form-label d-block text-start"
                                                   for="cpassword">Confirm Password</label>
                                            <input type="password" id="cpassword" name="cpassword"
                                                   class="form-control form-control-lg"/>
                                        </div>


                                        <div class="clearfix">
                                            <button class="btn btn-info btn-lg btn-block mb-3 mt-2 text-white"
                                                    type="button" onclick="resetPassword()">Reset Password
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
        async function resetPassword() {
            let password = document.getElementById('password').value;
            let cpassword = document.getElementById('cpassword').value;

            if (password.length === 0 || cpassword.length === 0) {
                errorToast('Password is required');
            } else if (password !== cpassword) {
                errorToast('Password and Confirm Password must be same.');
            } else {

                    let response = await axios.post('/user/reset-password', {
                        password: password
                    });

                    if (response.status === 200) {
                        successToast("Password reset successful.");
                        setTimeout(() => {
                            window.location.href = '/user-login';
                        }, 1000);
                    } else {
                        errorToast("Something went wrong.");
                    }
            }
        }
    </script>
@endsection
