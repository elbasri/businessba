@extends('frontend.layout.app')


@section('content')
    {{---
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

                <div class="panel-heading"><h3>Login</h3></div>
             <hr/>
            <br/>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{trans()}}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

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
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>

        </div>
    </div>
</div>
    -----}}
    <div class="main-wrapper">

        <!-- start hero-header -->
        <div class="breadcrumb-wrapper">

            <div class="container">

                <ol class="breadcrumb-list">
                    <li><a href="{{url('/')}}">{{trans('orbscope.home')}}</a></li>
                    <li><span>{{trans('orbscope.login')}}</span></li>
                </ol>

            </div>

        </div>
        <!-- end hero-header -->

        <div class="error-page-wrapper">

            <div class="container">

                <div class="row">



                    <!-- login container -->

                    <div class="login-container">
                        <!-- Combined Form Content -->
                        <div class="login-container-content">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active link-one"><a href="#login-block" data-toggle="tab"><i class="fa fa-sign-in"></i>{{trans('orbscope.login')}}</a></li>
                                <li class="link-two"><a href="#register-block" data-toggle="tab"><i class="fa fa-pencil"></i>{{trans('orbscope.register')}}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active fade in" id="login-block">
                                    <!-- Login Block Form -->
                                    <div class="login-block-form">
                                        <!-- Heading -->
                                        <!-- Border -->

                                        <!-- Form -->
                                        <form class="form" role="form" method="POST" action="{{ url('/login') }}">
                                            <!-- Form Group -->
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <!-- Label -->
                                                <label class="control-label">{{trans('orbscope.email')}}</label>
                                                <!-- Input -->
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                               <strong>{{ $errors->first('email') }}</strong>
                                                 </span>
                                                @endif
                                            </div>



                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label class="control-label">{{trans('orbscope.password')}}</label>
                                                <div >
                                                    <input id="password" type="password" class="form-control" name="password">

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                           <strong>{{ $errors->first('password') }}</strong>
                                                       </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="checkbox">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- Button -->
                                                <button type="submit" class="btn btn-primary">{{trans('orbscope.login')}}</button>&nbsp;
                                            </div>
                                            <div class="form-group">
                                                <a href="account-forgot-password-page.html" class="black">{{trans('orbscope.forget_password')}} </a href="account-forgot-password-page.html">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="register-block">
                                    <div class="register-block-form">
                                        <!-- Heading -->
                                        <h4>{{trans('orbscope.create_account')}}</h4>
                                        <!-- Border -->
                                        <div class="bor bg-orange"></div>
                                        <!-- Form -->
                                        <form class="form" role="form" method="POST" action="{{ url('/register') }}">

                                        <!-- Form Group -->
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name" class="col-md-4 control-label">{{trans('orbscope.name')}}</label>

                                                <div class="">
                                                    <input id="name" required type="text" class="form-control" name="name" value="{{ old('name') }}">

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email">{{trans('orbscope.email')}}</label>

                                                <div class="">
                                                    <input id="email" required type="email" class="form-control" name="email" value="{{ old('email') }}">

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password" class="">{{trans('orbscope.password')}}</label>

                                                <div class="">
                                                    <input id="password" required type="password" class="form-control" name="password">

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                <label for="password-confirm" class="">{{trans('orbscope.confirm')}} {{trans('orbscope.password')}}</label>

                                                <div class="">
                                                    <input id="password-confirm" required type="password" class="form-control" name="password_confirmation">

                                                    @if ($errors->has('password_confirmation'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                <label for="name" class="">{{trans('orbscope.mobile')}}</label>
                                                <div class="">
                                                    <input id="name" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" required >

                                                    @if ($errors->has('phone_number'))
                                                        <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                  </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <!-- Buton -->
                                                <button type="submit" class="btn btn-primary"> {{trans('orbscope.register')}}</button>&nbsp;
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="contact-block">
                                    <!-- Contact Block Form -->
                                    <div class="contact-block-form">
                                        <!-- Border -->
                                        <!-- Form -->
                                        <form class="form" role="form">
                                            <!-- Form Group -->
                                            <div class="form-group">
                                                <label class="control-label">{{trans('orbscope.name')}}</label>
                                                <input type="text" class="form-control" placeholder="{{trans('orbscope.name')}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">{{trans('orbscope.email')}}</label>
                                                <input type="text" class="form-control" placeholder="{{trans('orbscope.email')}}">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">{{trans('orbscope.subject')}}</label>
                                                <input type="text" class="form-control" placeholder="{{trans('orbscope.subject')}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="comments" class="control-label">{{trans('orbscope.comment')}}</label>
                                                <textarea class="form-control" id="comments" rows="5" placeholder="{{trans('orbscope.rwite_comment')}}"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <!-- Buton -->
                                                <button type="submit" class="btn btn-primary">{{trans('orbscope.send')}}</button>&nbsp;
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>

        </div>

        <!-- start footer -->

        <!-- end footer -->

    </div>

@endsection
