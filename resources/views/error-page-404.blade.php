@extends('layouts.empty', ['paceTop' => true])
@section('title', '404 错误页面')
@section('content')
	<!-- begin error -->
	<div class="error">
		<div class="error-code">404</div>
		<div class="error-content">
			<div class="error-message">找不到该页面</div>
			<div class="error-desc mb-3 mb-sm-4 mb-md-5">
				您要查找的页面不存在。<br />
			</div>
			<div>
				<a href="{{ route('index') }}" class="btn btn-success p-l-20 p-r-20">{{ __('Go Home') }}</a>
			</div>
		</div>
	</div>
	<!-- end error -->
@endsection