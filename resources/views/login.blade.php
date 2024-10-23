@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])
@section('title', '登录')
@section('content')
	<!-- begin login -->
	<div class="login login-with-news-feed">
		<!-- begin news-feed -->
		<div class="news-feed">
			<div class="news-image" style="background-image: url(/assets/img/login-bg/login-bg-11.jpg)"></div>
			<div class="news-caption">
				<h4 class="caption-title"><b>Smart</b>Admin App</h4>
				<p>
					一款全面集成的智能管理系统，融合了设备管理、精细数据管理、高效行为监控、项目周期管理、代码仓库管理以及灵活的权限控制功能于一体，为用户打造了一个无缝衔接、跨平台（Windows®, macOS®, Linux®, iPhone®, iPad®, Android™）的操作体验。
				</p>
			</div>
		</div>
		<!-- end news-feed -->
		<!-- begin right-content -->
		<div class="right-content">
			<!-- begin login-header -->
			<div class="login-header">
				<div class="brand">
					<span class="logo"></span> <b>Smart</b>Admin
					<small>登录管理系统</small>
				</div>
				<div class="icon">
					<i class="fa fa-sign-in-alt"></i>
				</div>
			</div>
			<!-- end login-header -->

			<!-- begin login-content -->
			<div class="login-content">
				@if ($errors->any())
					<div class="alert alert-danger">
						<strong>警告！</strong> 
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				<form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
					@csrf
					<div class="form-group m-b-15">
						<input id="email" type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required />
					</div>
					<div class="form-group m-b-15">
						<input id="password" type="password" name="password" class="form-control form-control-lg" placeholder="{{ __('Password') }}" required />
					</div>
					<div class="checkbox checkbox-css m-b-30">
						<input class="custom-control-input" type="checkbox" id="remember" name="remember" value="" />
						<label class="custom-control-label" for="remember">{{ __('Remember me') }}</label>
					</div>
					<div class="login-buttons">
						<button type="submit" class="btn btn-success btn-block btn-lg">{{ __('Log in') }}</button>
					</div>
					<div class="m-t-20 m-b-40 p-b-40 text-inverse">
						<p class="mb-0">
							没有账号？ <a href="{{ route('register') }}">{{ __('Click') }}{{ __('Register') }}</a>
						</p>
						@if (Route::has('password.request'))
						<p class="mb-0">
							{{ __('Forgot password') }}？ <a href="{{ route('password.request') }}">{{ __('Recover your password') }}</a>
						</p>
						@endif
					</div>
					<hr />
					<p class="text-center text-grey-darker mb-0">
						&copy; {{ config('app.name') }} All Right Reserved {{ date('Y') }}
					</p>
				</form>
			</div>
			<!-- end login-content -->
		</div>
		<!-- end right-container -->
	</div>
	<!-- end login -->
@endsection
