	<!-- begin #header -->
	<div id="header" class="header navbar navbar-default navbar-expand-lg navbar-fixed-top">
		<!-- begin container -->
		<div class="container">
			<!-- begin navbar-brand -->
			<a href="/" class="navbar-brand">
				<span class="brand-logo"></span>
				<span class="brand-text">SmartAdmin</span>
			</a>
			<!-- end navbar-brand -->
			<!-- begin navbar-toggle -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- end navbar-toggle -->
			<!-- begin navbar-collapse -->
			<div class="collapse navbar-collapse" id="header-navbar">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="{{ route('index') }}" data-toggle="dropdown">首页</a>
					</li>
					<li><a href="/hot">推荐博文</a></li>
					<li class="dropdown">
						<a href="#" data-toggle="dropdown">博文分类<b class="caret"></b></a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="/post">Laravel</a>
							<a class="dropdown-item" href="/post">Vue</a>
							<a class="dropdown-item" href="/post">PHP</a>
							<a class="dropdown-item" href="/post">E</a>
							<a class="dropdown-item" href="/post">LUA</a>
						</div>
					</li>
					<li><a href="{{ route('about') }}">关于博主</a></li>
					<li><a href="{{ route('contact') }}">联系博主</a></li>
				</ul>
			</div>
			<!-- end navbar-collapse -->
		</div>
		<!-- end container -->
	</div>
	<!-- end #header -->