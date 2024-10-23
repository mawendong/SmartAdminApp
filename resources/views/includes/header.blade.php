@php
	$headerClass = (!empty($headerInverse)) ? 'navbar-inverse ' : 'navbar-default ';
	$headerMenu = (!empty($headerMenu)) ? $headerMenu : '';
	$headerMegaMenu = (!empty($headerMegaMenu)) ? $headerMegaMenu : ''; 
	$headerTopMenu = (!empty($headerTopMenu)) ? $headerTopMenu : '';
@endphp
<!-- begin #header -->
<div id="header" class="header {{ $headerClass }}">
	<!-- begin navbar-header -->
	<div class="navbar-header">
		<a href="#" class="navbar-brand"><span class="navbar-logo"></span> <b>Smart</b>Admin</a>
	</div>
	<!-- end navbar-header -->
	@includeWhen($headerMegaMenu, 'includes.header-mega-menu')
	<!-- begin header-nav -->
	<ul class="navbar-nav navbar-right">
		<li class="navbar-form">
			<form action="" method="POST" id="search" name="search">
				@csrf
				<div class="form-group">
					<input type="text" class="form-control" id="keyword" name="keyword" placeholder="输入关键字" />
					<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
				</div>
			</form>
		</li>
		<li class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('/assets/img/user/user-0.jpg') }}" alt="{{ Auth::user()->name }}">
				<span class="d-none d-md-inline">{{ Auth::user()->name }}</span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="{{ route('user.profile.edit') }}" class="dropdown-item">编辑资料</a>
				<a href="{{ route('user.avatar.edit') }}" class="dropdown-item">更改头像</a>
				<a href="{{ route('user.profile.edit') }}" class="dropdown-item">修改密码</a>
				<div class="dropdown-divider"></div>
				<form method="post" action="{{ route('logout') }}">  
					@csrf
					<a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" class="dropdown-item">退出</a>
				</form>
			</div>
		</li>
	</ul>
	<!-- end header navigation right -->
</div>
<!-- end #header -->
