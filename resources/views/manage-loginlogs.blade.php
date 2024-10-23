@extends('layouts.default')
@section('title','登录日志')
@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('index') }}">主页</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.profile.edit') }}">个人资料</a></li>
        <li class="breadcrumb-item active">登录日志</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">登录日志 <small></small></h1>
	<!-- end page-header -->
	<!-- begin panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">列表</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
		</div>
		<div class="panel-body">
		@if ($message = Session::get('success'))
		<div class="alert alert-green fade show">
			<span class="close" data-dismiss="alert">×</span>
			<i class="fa fa-exclamation-circle fa-2x pull-left m-r-10"></i>
			<p class="m-b-0">{{ $message }}</p>
		</div>
        @else
            <div class="alert alert-warning fade show">
                <span class="close" data-dismiss="alert">×</span>
                <i class="fa fa-exclamation-circle fa-2x pull-left m-r-10"></i>
                <p class="m-b-0">只显示近<b>7天</b>内的登录日志。</p>
            </div>
        @endif
		<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
				<thead>
					<tr>
						<th width="4%" class="text-center">序号</th>
						<th class="text-nowrap">用户</th>
						<th class="text-nowrap">IP地址</th>
						<th class="text-nowrap">设备</th>
						<th class="text-nowrap">登录时间</th>
						<!-- <th class="text-nowrap">操作</th> -->
					</tr>
				</thead>
				<tbody>
				@if ($loginlogs && !$loginlogs->isEmpty()) 
					@php $i = 1; @endphp
					@foreach ($loginlogs as $loginlog)
					<tr class="gradeA">
						<td class="f-s-600 text-inverse text-center">{{ $i++ }}</td>
						<td>{{ $loginlog->user_name }}</td>
						<td>{{ $loginlog->ip_address }}</td>
						<td>{{ $loginlog->user_agent }}</td>
						<td>{{ $loginlog->updated_at }}</td>
						<!-- <td>
							<form action="{{ route('user.loginlog.destroy',$loginlog->id) }}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-sm m-r-5">{{ __('Delete') }}</button>
							</form>
						</td> -->
					</tr>
					@endforeach
				@else
					<tr>
						<td class="f-s-600 text-inverse text-center" colspan="5">{{ __('No Content') }}</td>
					</tr>
				@endif
				</tbody>
			</table>
		</div>
	</div>
	<!-- end panel -->
@endsection
@push('scripts')
	<script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
	<script type="text/javascript">
		var handleDataTableDefault = function() {
			"use strict";
			if ($('#data-table-default').length !== 0) {
				$('#data-table-default').DataTable({
					info: true,
					searching: true,
					ordering: false,
					paging: true,
				});
			}
		};
		var TableManageDefault = function () {
			"use strict";
			return {
				//main function
				init: function () {
					handleDataTableDefault();
				}
			};
		}();

		$(document).ready(function() {
			TableManageDefault.init();
		});
	</script>
@endpush