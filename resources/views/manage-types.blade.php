@extends('layouts.default')
@section('title','分类列表')
@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('index') }}">主页</a></li>
        <li class="breadcrumb-item active">分类列表</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">分类列表 <small></small></h1>
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
			@endif
		    <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle table-hover">
				<thead>
					<tr>
						<th width="4%" class="text-center">ID</th>
						<th width="3%" data-orderable="false">图标</th>
						<th class="text-nowrap">名称</th>
						<th class="text-nowrap">分类</th>
						<th class="text-nowrap">排序</th>
						<th class="text-nowrap">描述</th>
						<th class="text-nowrap">操作</th>
					</tr>
				</thead>
				<tbody>
				@if ($types && !$types->isEmpty()) 
					@foreach ($types as $type)
					<tr class="gradeA">
						<td class="f-s-600 text-inverse text-center">{{ ++$i }}<!-- {{ $type->id }} --></td>
						<td class="with-img">
							<img src="{{ $type->icon ? asset('storage/' . $type->icon) : asset('/assets/img/user/user-0.jpg') }}" class="img-rounded height-30">
						</td>
						<td><a href="{{ route('types.index') }}?category={{ $type->id }}">{{ $type->title }}</a> ({{ $type->id }})</td>
						<td>
						@foreach ($searchTypes as $searchType)
							@if($type->parent_id == $searchType->id) <a href="{{ route('types.index') }}?category={{ $type->parent_id }}">{{ $searchType->title }}</a> ({{ $type->parent_id }}) @endif
						@endforeach
						</td>
						<td>{{ $type->sort }}</td>
						<td>{{ $type->description }}</td>
						<td>
							<form action="{{ route('types.destroy',$type->id) }}" method="post">
								<a class="btn btn-warning btn-sm m-r-5" href="{{ route('types.show',$type->id) }}">{{ __('View') }}</a>
								<a class="btn btn-primary btn-sm m-r-5" href="{{ route('types.edit',$type->id) }}">{{ __('Edit') }}</a>
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger btn-sm m-r-5">{{ __('Delete') }}</button>
							</form>
						</td>
					</tr>
					@endforeach
				@else
					<tr class="gradeA">
						<td class="f-s-600 text-inverse text-center" colspan="7">{{ __('No Content') }}</td>
					</tr>
				@endif
				</tbody>
			</table>
		</div>
		<div class="panel-body">
			<div>
				{!! $types->links('vendor.pagination.bootstrap-5') !!}
			</div>
		</div>
	</div>
	<!-- end panel -->
    <!-- begin panel -->
			<div class="panel panel-success" data-sortable-id="form-validation-1">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<h4 class="panel-title">添加</h4>
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
					<form class="form-horizontal" action="{{ route('types.store') }}" method="post" name="store-form" data-parsley-validate="true" enctype="multipart/form-data">
                        @csrf
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="title">名称: <code>*</code> </label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control" type="text" id="title" name="title" value="{{ old('title') }}" placeholder="名称（必填）" data-parsley-required="true" data-parsley-length="[2,100]" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="parent_id">分类: <code>*</code> </label>
							<div class="col-md-10 col-sm-10">
                                <select class="form-control" id="parent_id" name="parent_id" data-parsley-required="true" data-parsley-type="number">
									<option value="">分类（必填）</option>
									@foreach ($primaryTypes as $primaryType)  
										<option value="{{ $primaryType->id }}" @if($category == $primaryType->id) selected @endif>{{ $primaryType->title }}</option>  
										@if ($primaryType->children->isNotEmpty() && $primaryType->id != 1)  
											@foreach ($primaryType->children as $secondaryMenu)  
												<option value="{{ $secondaryMenu->id }}" @if($category == $secondaryMenu->id) selected @endif> - - {{ $secondaryMenu->title }}</option>  
												@if ($secondaryMenu->children->isNotEmpty())  
													@foreach ($secondaryMenu->children as $tertiaryMenu)  
														<option value="{{ $tertiaryMenu->id }}" @if($category == $tertiaryMenu->id) selected @endif> - - - - {{ $tertiaryMenu->title }}</option>  
													@endforeach  
												@endif  
											@endforeach  
										@endif  
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="sort">排序:  <code>*</code> </label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control" type="text" id="sort" name="sort" value="{{ old('sort') }}" data-parsley-required="true" data-parsley-type="number" placeholder="排序（必填，数字0-100之间）" data-parsley-range="[0,100]" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label">图标:</label>
							<div class="col-md-10 col-sm-10">
								<div class="custom-file">  
									<input type="file" class="custom-file-input" id="icon" name="icon" accept="image/*" data-parsley-required="false" data-parsley-trigger="change" data-parsley-type="file" data-parsley-type-message="文件必须是图像类型。" data-parsley-max-size="2048" data-parsley-max-size-message="文件大小必须小于 2MB。" onchange="previewImage(this)">  
									<label class="custom-file-label" for="icon">选择文件</label>  
								</div> 
								<div class="mt-2">  
									<img id="imagePreview" src="" alt="预览图像" style="max-width: 100%; max-height: 200px; border: 1px solid #ddd; display: none;">  
								</div> 
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="description">描述:</label>
							<div class="col-md-10 col-sm-10">
                                <textarea class="form-control" id="description" name="description" value="{{ old('description') }}" rows="4" placeholder="描述（限2-100）字" data-parsley-required="false" data-parsley-length="[2,100]"></textarea>
							</div>
						</div>
						<div class="form-group row m-b-0">
							<label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
							<div class="col-md-10 col-sm-10">
								<button type="submit" class="btn btn-success">{{ __('Add') }}</button>
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
	<script>
		function previewImage(input) {  
			const file = input.files[0];  
			if (file) {  
				const reader = new FileReader();  
				
				reader.onload = function(e) {  
					$('#imagePreview').attr('src', e.target.result);  
					$('#imagePreview').show();  
				}  
		
				reader.readAsDataURL(file);  
			} else {  
				$('#imagePreview').hide();  
			}  
		
			// 更新自定义文件输入标签  
			$(input).next('.custom-file-label').html(file ? file.name : '选择文件');  
		}  
		
		// 初始化：如果页面加载时有默认图片，显示预览  
		$(document).ready(function() {  
			const input = $('#icon')[0];  
			if (input.files.length > 0) {  
				previewImage(input);  
			}  
		
			// 更新文件输入标签当值变化时（通过 JavaScript 更改文件）  
			input.addEventListener('change', function() {  
				$(this).next('.custom-file-label').html(this.files[0] ? this.files[0].name : '选择文件');  
			});  
		});
	</script>
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
	<script type="text/javascript">
		$(document).ready(function() {  
			window.Parsley.addMessages('zh_cn', {  
				defaultMessage: "这是一个无效的值。",  
				type: {  
					email: "请输入一个有效的电子邮件地址。",  
					url: "请输入一个有效的URL。",  
					number: "请输入一个有效的数字。",  
					integer: "请输入一个有效的整数。",  
					digits: "请输入一个有效的数字，只能包含数字。",  
					alphanum: "请输入一个有效的字母数字值（字母或数字）。"  
				},  
				notblank: "此字段不能为空。",  
				required: "此字段是必填的。",  
				pattern: "此值不符合所需的格式。",  
				min: "此值必须大于或等于 %s。",  
				max: "此值必须小于或等于 %s。",  
				range: "此值必须在 %s 和 %s 之间。",  
				minlength: "此值的长度必须大于或等于 %s 个字符。",  
				maxlength: "此值的长度必须小于或等于 %s 个字符。",  
				length: "此值的长度必须在 %s 和 %s 个字符之间。",  
				mincheck: "你必须至少选择 %s 个选项。",  
				maxcheck: "你最多可以选择 %s 个选项。",  
				check: "你必须选择介于 %s 和 %s 个选项之间。",  
				equalto: "此值必须与 %s 相同。"  
			});  
			// 初始化 parsley  
			$('form').parsley({  
				// 你可以在这里配置其他 Parsley 选项  
				lang: 'zh_cn' // 设置当前表单使用的语言为中文
			});  
		});  
	</script>
@endpush