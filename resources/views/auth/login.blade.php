@extends('layouts.layoutForLoginRegistration')
@section('content')
    <body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form  method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>Login Form</h1>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"/>
                        <div>
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}"/>
                        <div>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                        <div>
                            {{--class="btn btn-default submit"--}}
                            <button type="submit" class="btn btn-default submit">
                                Login
                            </button>

                            <a class="btn btn-link" class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">

                            <p class="change_link">New to site?
                                <a  class="btn btn-link" href="{{ route('register') }}" class="to_register"> Create Account </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    </body>
@endsection
