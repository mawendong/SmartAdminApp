@extends('layouts.default')
@section('title','信息资料')
@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('index') }}">主页</a></li>
        <li class="breadcrumb-item active">{{ __('Profile') }}</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">{{ __('Profile') }} <small></small></h1>
	<!-- end page-header -->
	<!-- begin panel -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4 class="panel-title">{{ __('Profile Information') }}</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
		</div>
		<div class="panel-body">
            @if (session('status') === 'profile-updated')
                <div class="alert alert-green fade show">
                    <span class="close" data-dismiss="alert">×</span>
                    <i class="fa fa-check fa-2x pull-left m-r-10"></i>
                    <p class="m-b-0">{{ __('Saved.') }}</p>
                </div>
            @endif
            <form class="form-horizontal" action="{{ route('user.profile.update') }}" method="post" data-parsley-validate="true" name="update-form">
                <!-- @csrf -->
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label" for="name">账号名称: </label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="text" id="name" name="name" value='{{ Auth::user()->name }}' readonly />
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label" for="email">电子邮箱: </label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="text" id="email" name="email" value='{{ Auth::user()->email }}' readonly />
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label" for="created_at">注册创建时间: </label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="text" id="created_at" name="created_at" value='{{ Auth::user()->created_at }}' readonly />
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label" for="updated_at">最后登录时间: </label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="text" id="updated_at" name="updated_at" value='{{ Auth::user()->updated_at }}' readonly />
                    </div>
                </div>
                <!-- <div class="form-group row m-b-0">
                    <label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-md-10 col-sm-10">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    </div>
                </div> -->
            </form>
		</div>
	</div>
	<!-- end panel -->
     <!-- begin panel -->
    <div class="panel panel-warning" data-sortable-id="form-validation-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">{{ __('Update Password') }}</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>警告！</strong> 您的输入存在问题。<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('status') === 'password-updated')
                <div class="alert alert-green fade show">
                    <span class="close" data-dismiss="alert">×</span>
                    <i class="fa fa-check fa-2x pull-left m-r-10"></i>
                    <p class="m-b-0">{{ __('Saved.') }}</p>
                </div>
            @else
                <div class="alert alert-warning fade show">
                    <span class="close" data-dismiss="alert">×</span>
                    <i class="fa fa-exclamation-circle fa-2x pull-left m-r-10"></i>
                    <p class="m-b-0">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                </div>
            @endif
            <form class="form-horizontal" action="{{ route('password.update') }}" method="post" data-parsley-validate="true" name="update-form">
                @csrf
                @method('put')
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label" for="update_password_current_password">当前密码: <code>*</code> </label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="password" id="update_password_current_password" name="current_password" placeholder="当前密码（必填）" autocomplete="current-password" data-parsley-required="true" data-parsley-length="[8,30]" data-toggle="password" data-placement="after" />
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label" for="password">新的密码: <code>*</code> </label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="password" id="password" name="password" placeholder="新的密码（必填）" autocomplete="password" data-parsley-required="true" data-parsley-length="[8,30]" data-toggle="password" data-placement="after" />
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label" for="password_confirmation">确认密码: <code>*</code> </label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="确认密码（必填）" autocomplete="password" data-parsley-required="true" data-parsley-length="[8,30]" data-toggle="password" data-placement="after" />
                    </div>
                </div>
                <div class="form-group row m-b-0">
                    <label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-md-10 col-sm-10">
                        <button type="submit" class="btn btn-warning">{{ __('Save') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end panel-body -->
        <!-- begin hljs-wrapper -->
        <div class="hljs-wrapper">
            <pre></pre>
        </div>
        <!-- end hljs-wrapper -->
    </div>
	<!-- end panel -->
    <!-- begin panel -->
    <div class="panel panel-danger" data-sortable-id="form-validation-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">删除账户</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <!-- end panel-heading -->
        <!-- begin panel-body -->
        <div class="panel-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>警告！</strong> 您的输入存在问题。<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="form-horizontal" action="{{ route('user.profile.destroy') }}" method="post" data-parsley-validate="true" name="destroy-form">
                @csrf
                @method('delete')
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label">重要提示: </label>
                    <div class="col-md-10 col-sm-10">
                        一旦您的账户被删除，其所有资源和数据将被永久删除。<br>
                        在删除您的账户之前，请下载您希望保留的任何数据或信息。 
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label" for="password">当前密码: <code>*</code> </label>
                    <div class="col-md-10 col-sm-10">
                        <input class="form-control" type="password" id="password" name="password" placeholder="当前密码（必填）" autocomplete="password" data-parsley-required="true" data-parsley-length="[8,30]" data-toggle="password" data-placement="after" />
                    </div>
                </div>
                <div class="form-group row m-b-0">
                    <label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-md-10 col-sm-10">
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- end panel-body -->
        <!-- begin hljs-wrapper -->
        <div class="hljs-wrapper">
            <pre></pre>
        </div>
        <!-- end hljs-wrapper -->
    </div>
	<!-- end panel -->
@endsection
@push('scripts')
	<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
	<script src="/assets/plugins/highlight.js/highlight.min.js"></script>
	<script src="/assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
@endpush