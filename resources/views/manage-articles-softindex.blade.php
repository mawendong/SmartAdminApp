@extends('layouts.default')
@section('title','文章列表')
@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('index') }}">主页</a></li>
        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">文章列表</a></li>
        <li class="breadcrumb-item active">回收站</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">回收站 <small></small></h1>
	<!-- end page-header -->
	<!-- begin panel -->
	<div class="panel panel-danger">
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
		@endif
		<div class="row row-space-10">
			@if(!empty($category))
				<div class="col-md-4">
					<div class="alert alert-primary fade show m-b-10">
						<span class="close" data-dismiss="alert">&times;</span>
						分类查询：<a href="#" class="alert-link">{{ $category }}</a>
					</div>
				</div>
			@endif
			@if(!empty($user))
				<div class="col-md-4">
					<div class="alert alert-info fade show m-b-10">
						<span class="close" data-dismiss="alert">&times;</span>
						用户查询：<a href="#" class="alert-link">{{ $user }}</a>
					</div>
				</div>
			@endif
			@if(!empty($keyword))
				<div class="col-md-4">
					<div class="alert alert-warning fade show m-b-10">
						<span class="close" data-dismiss="alert">&times;</span>
						关键词查询：<a href="#" class="alert-link">{{ $keyword }}</a>
					</div>
				</div>
			@endif
		</div>
		<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
				<thead>
					<tr>
						<th width="4%" class="text-center">ID</th>
						<th class="text-nowrap">标题</th>
						<th class="text-nowrap">分类</th>
						<th class="text-nowrap">作者</th>
						<th class="text-nowrap">阅读量</th>
						<th class="text-nowrap">点赞数</th>
						<th class="text-nowrap">状态</th>
						<th class="text-nowrap">发布日期</th>
						<th class="text-nowrap">编辑日期</th>
						<th class="text-nowrap">操作</th>
					</tr>
				</thead>
				<tbody>
				@if ($articles && !$articles->isEmpty()) 
					@foreach ($articles as $article)
					<tr class="gradeA">
						<td class="f-s-600 text-inverse text-center">{{ $article->id }}</td>
						<td><a href="{{ route('articles.show',$article->id) }}">{{ Str::limit($article->title, 60, '...') }}</a></td>
						<td><a href="{{ route('articles.index') }}?category={{ $article->types_id }}">{{ $article->types_title }} ({{ $article->types_id }})</a></td>
						<td><a href="{{ route('articles.index') }}?user={{ $article->users_id }}">{{ $article->author }} ({{ $article->users_id }})</a></td>
						<td><span class="badge badge-green">{{ $article->views }}</span></td>
						<td><span class="badge badge-danger ">{{ $article->likes }}</span></td>
						<td>
							@if ( $article->status=='1' )  
								<span class="text-success">已发布 ({{ $article->status }})</span>
							@else  
								<span class="text-warning">未发布 ({{ $article->status }})</span>
							@endif
						</td>
						<td>{{ $article->created_at }}</td>
						<td>{{ $article->updated_at }}</td>
						<td>
							<form action="{{ route('articles.forcedelete', $article->id) }}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-sm m-r-5"><i class="fa fa-eraser"></i> {{ __('Delete') }}</button>
							</form>
						</td>
					</tr>
					@endforeach
				@else
					<tr>
						<td class="f-s-600 text-inverse text-center" colspan="10">{{ __('No Content') }}</td>
					</tr>
				@endif
				</tbody>
			</table>
		</div>
		<div class="panel-body">
			<div>
			{!! $articles->links('vendor.pagination.bootstrap-5') !!}
			</div>
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
					info: false,
					searching: true,
					ordering: false,
					paging: false,
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