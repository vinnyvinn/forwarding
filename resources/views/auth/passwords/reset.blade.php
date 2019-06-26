<style>
    #walla{
        background-color: #29307E;
    }
</style>
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reset Password</div>

                    <div class="panel-body">
                        <form class="form-horizontal manage-users" method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                    <span class="pass_placeholder"></span>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                    <span id="pass_match"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btnClick">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(function () {
        var validated;
        $('#password').on('keyup', function () {

            $(this).each(function () {
                validated = true;
                if (this.value.length < 8)
                    validated = false;
                if (!/\d/.test(this.value))
                    validated = false;
                if (!/[a-z]/.test(this.value))
                    validated = false;
                if (!/[A-Z]/.test(this.value))
                    validated = false;
                if (/[^0-9a-zA-Z!@#$%^&*()]/.test(this.value))
                    validated = false;
                if (!validated) {
                    $('.pass_placeholder').css('color', 'red').text('Password must contain atleast 1 digit,1 lowercase character,1 uppercase character and must not be less than 8 characters.');

                } else {
                    $('.pass_placeholder').css('color', 'green').text('Password strength passed');
                }


            });
        });


        $('.manage-users').on('submit', function (e) {

            if ($('#password').val() !== $('#password-confirm').val()){
                $("#pass_match").css('color','red').text('Password fields do not match');
                return true;
            }
            else{
                $("#pass_match").text('');
            }
            e.preventDefault();

            $('.btnClick').attr('disabled', true).val('Please wait');
            if (validated) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        console.log(response);
                        window.location.href = '{{url('manage-users')}}';
                    }
                });
            }
            else{
                $('.pass_placeholder').css('color', 'red').text('Password must contain atleast 1 digit,1 lowercase character,1 uppercase character and must not be less than 8 characters.');
                $('.btnClick').attr('disabled', false).val('Save');
                return true;
            }

        })


    })

</script>
