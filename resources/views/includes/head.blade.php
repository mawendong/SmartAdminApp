<meta charset="utf-8" />
<title>{{ config('app.name') }} | @yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="SmartAdmin" name="description" />
<meta content="MaWenDong" name="author" />
<!-- ================== BEGIN BASE CSS STYLE ================== -->
<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/open-sans@4.19.2/index.css">
<link rel="stylesheet" href="{{ asset('/assets/css/app.min.css') }}" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<!-- ================== END BASE CSS STYLE ================== -->
@stack('css')