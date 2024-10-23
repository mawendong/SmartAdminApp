@extends('layouts.default')
@section('title','查看分类')
@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('index') }}">主页</a></li>
		<li class="breadcrumb-item"><a href="{{ route('types.index') }}">分类列表</a></li>
		<li class="breadcrumb-item active">查看分类</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">查看分类 <small></small></h1>
	<!-- end page-header -->
    <!-- begin panel -->
			<div class="panel panel-warning" data-sortable-id="form-validation-1">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<h4 class="panel-title">查看 ({{ $type->id }})</h4>
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
						<strong>警告</strong> 您的输入存在问题。<br><br>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="title">名称:  <code>*</code> </label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control" type="text" id="title" name="title" value="{{ $type->title }}" placeholder="名称（必填）" data-parsley-required="true" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="parent_id">分类:  <code>*</code> </label>
							<div class="col-md-10 col-sm-10">
                                <select class="form-control" id="parent_id" name="parent_id" data-parsley-required="true" data-parsley-type="number">
									<option value="">所属分类（必填）</option>
									@foreach ($primaryTypes as $primaryType)  
										<option value="{{ $primaryType->id }}" @if($type->parent_id == $primaryType->id) selected @endif>{{ $primaryType->title }}</option>
										@if ( $primaryType->children->isNotEmpty() && $primaryType->id != 1 )  
											@foreach ($primaryType->children as $secondaryMenu)  
												<option value="{{ $secondaryMenu->id }}" @if($type->parent_id == $secondaryMenu->id) selected @endif> - {{ $primaryType->title }} - {{ $secondaryMenu->title }}</option>
											@endforeach   
										@endif  
									@endforeach 
								</select>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="sort">排序:  <code>*</code> </label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control" type="text" id="sort" name="sort" value="{{ $type->sort }}" data-parsley-required="true" data-parsley-type="number" placeholder="排序（必填，数字0-100之间）" data-parsley-range="[0,100]" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label">图标:</label>
							<div class="col-md-10 col-sm-10">
								<img src="{{ $type->icon ? asset('storage/' . $type->icon) : asset('/assets/img/user/user-0.jpg') }}" class="img-rounded height-80">
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="description">描述:</label>
							<div class="col-md-10 col-sm-10">
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="描述（限4-100）字" data-parsley-required="false" data-parsley-length="[4,100]">{{ $type->description }}</textarea>
							</div>
						</div>
                        <div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="description">创建时间:</label>
							<div class="col-md-10 col-sm-10">
                                <input class="form-control" type="text" id="created_at" name="created_at" value="{{ $type->created_at }}" placeholder="创建时间" data-parsley-required="false" />
							</div>
						</div>
                        <div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="description">更新时间:</label>
							<div class="col-md-10 col-sm-10">
                                <input class="form-control" type="text" id="updated_at" name="updated_at" value="{{ $type->updated_at }}" placeholder="更新时间" data-parsley-required="false" />
							</div>
						</div>
						<!-- <div class="form-group row m-b-0">
							<label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
							<div class="col-md-10 col-sm-10">
								<button type="submit" class="btn btn-warning">确定</button>
							</div>
						</div>
						 -->
						<div class="form-group row m-b-0">
							<label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
							<div class="col-md-10 col-sm-10">
                                <a class="btn btn-warning" href="{{ route('types.index') }}">返回列表</a>
							</div>
						</div>

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
	<script src="/assets/js/demo/render.highlight.js"></script>
	<!--
	<script type="text/javascript">
		var handleDataTableDefault = function() {
			"use strict";
			
			if ($('#data-table-default').length !== 0) {
				$('#data-table-default').DataTable({
					responsive: true
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
	-->
@endpush