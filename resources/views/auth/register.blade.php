@extends('layouts.layoutForLoginRegistration')
@section('content')
    <body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <h1>Create Account</h1>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}"/>
                        <div>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Username"required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"/>
                        <div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
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
                        <div>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">
                                    Submit
                            </button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member ?
                                <a class="btn btn-link" onclick="location.href='{{ route('login') }}'" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-paw"></i> IPlanProject!</h1>
                                <p>©2016 All Rights Reserved. IPlanProject!</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    </body>
@endsection

