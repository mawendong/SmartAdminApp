@extends('layouts.empty', ['paceTop' => true, 'bodyExtraClass' => 'bg-white'])
@section('title', '注册')
@section('content')
	<!-- begin register -->
	<div class="register register-with-news-feed">
		<!-- begin news-feed -->
		<div class="news-feed">
			<div class="news-image" style="background-image: url(/assets/img/login-bg/login-bg-15.jpg)"></div>
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
			<!-- begin register-header -->
			<h1 class="register-header">
				注册
				<small>创建您的帐户</small>
			</h1>
			<!-- end register-header -->
			<!-- begin register-content -->
			<div class="register-content">
				<form method="POST" action="{{ route('register') }}" class="margin-bottom-0">
					@csrf
					<label class="control-label">用户昵称 <span class="text-danger">*</span></label>
					<div class="row m-b-15">
						<div class="col-md-12">
							<input id="name" type="text" name="name" class="form-control" placeholder="用户昵称" value="{{ old('name') }}" autocomplete="name" required />
						</div>
						@if($errors->has('name'))
						<div class="col-md-12">
							<span class="text-danger">{{ $errors->first('name') }}</span>
						</div>
						@endif
					</div>
					<label class="control-label">电子邮箱 <span class="text-danger">*</span> </label>
					<div class="row m-b-15">
						<div class="col-md-12">
							<input id="email" type="email" name="email" class="form-control" placeholder="电子信箱" value="{{ old('email') }}" autocomplete="username" required />
						</div>
						@if($errors->has('email'))
						<div class="col-md-12">
							<span class="text-danger">{{ $errors->first('email') }}</span>
						</div>
						@endif
					</div>
					<label class="control-label">密码 <span class="text-danger">*</span></label>
					<div class="row m-b-15">
					<div class="col-md-12">
							<input id="password" type="password" name="password" class="form-control" placeholder="密码 [8-16位]" autocomplete="password" required />
						</div>
					</div>
					<label class="control-label">确认密码 <span class="text-danger">*</span></label>
					<div class="row m-b-15">
						<div class="col-md-12">
							<input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="确认密码 [8-16位]" autocomplete="password_confirmation" required />
						</div>
						@if($errors->has('password'))
						<div class="col-md-12">
							<span class="text-danger">{{ $errors->first('password') }}</span>
						</div>
						@endif
						@if($errors->has('password_confirmation'))
						<div class="col-md-12">
							<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
						</div>
						@endif
					</div>
					<div class="checkbox checkbox-css m-b-30">
						<div class="checkbox checkbox-css m-b-30">
							<input type="checkbox" id="agreement_checkbox" name="agreement_checkbox" value="">
							<label for="agreement_checkbox">
                            点击创建，即表示您同意我们的 <a href="javascript:;">条款</a> 并且您已阅读我们的<a href="javascript:;">数据政策</a>，包括我们的 <a href="javascript:;">Cookie</a> 使用。
							</label>
						</div>
					</div>
					<div class="register-buttons">
						<button type="submit" class="btn btn-primary btn-block btn-lg">{{ __('Register') }}</button>
					</div>
					<div class="m-t-30 m-b-30 p-b-30">
                        已经是会员？  <a href="{{ route('login') }}">{{ __('Log in') }}</a>
					</div>
					<hr />
					<p class="text-center mb-0">
					&copy; {{ config('app.name') }} All Right Reserved {{ date('Y') }}
					</p>
				</form>
			</div>
			<!-- end register-content -->
		</div>
		<!-- end right-content -->
	</div>
	<!-- end register -->
@endsection
