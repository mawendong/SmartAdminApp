<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('blog.head')
</head>
<body>
	@include('blog.header')
	
	<!-- begin #page-title -->
	<div id="page-title" class="page-title has-bg">
		<div class="bg-cover" data-paroller="true" data-paroller-factor="0.5" data-paroller-factor-xs="0.2" style="background: url(../assets/img/cover/cover-4.jpg) center 0px / cover no-repeat"></div>
		<div class="container">
			<h1>Color Admin Blog</h1>
			<p>www.lua86.com</p>
		</div>
	</div>
	<!-- end #page-title -->

	<!-- begin #content -->
	<div id="content" class="content">
		<!-- begin container -->
		<div class="container">
			<!-- begin row -->
			<div class="row row-space-30">
				@yield('content')
				@include('blog.sidebar-right')
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end #content -->
    @include('blog.footer')
</body>
</html>