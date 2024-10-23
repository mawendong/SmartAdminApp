@extends('layouts.default')
@section('title','更改头像')
@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.css">  
@endpush
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('index') }}">主页</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.profile.edit') }}">账号信息</a></li>
        <li class="breadcrumb-item active">更改头像</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">更改头像 <small></small></h1>
	<!-- end page-header -->
    <!-- begin panel -->
    <div class="panel panel-info" data-sortable-id="form-validation-1">
        <!-- begin panel-heading -->
        <div class="panel-heading">
            <h4 class="panel-title">更改头像</h4>
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
            @if ($message = Session::get('success'))
                <div class="alert alert-green fade show">
                    <span class="close" data-dismiss="alert">×</span>
                    <i class="fa fa-check fa-2x pull-left m-r-10"></i>
                    <p class="m-b-0">{{ $message }}</p>
                </div>
            @elseif ($message = Session::get('error'))
                <div class="alert alert-warning fade show">
                    <span class="close" data-dismiss="alert">×</span>
                    <i class="fa fa-times fa-2x pull-left m-r-10"></i>
                    <p class="m-b-0">{{ $message }}</p>
                </div>
            @else
                <div class="alert alert-warning fade show">
                    <span class="close" data-dismiss="alert">×</span>
                    <i class="fa fa-exclamation-circle fa-2x pull-left m-r-10"></i>
                    <p class="m-b-0">支持jpg、png、gif格式，图片大小2M以内，建议不小于250X250像素</p>
                </div>
            @endif
            <form class="form-horizontal" action="{{ route('user.avatar.update') }}" method="post" name="update-form" data-parsley-validate="true" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label">当前头像:  </label>
                    <div class="col-md-10 col-sm-10">
                        <img class="img-rounded height-250" src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('/assets/img/user/user-0.jpg') }}" alt="{{ Auth::user()->name }}">
                    </div>
                </div>
                <!-- <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label">上传头像:  </label>
                    <div class="col-md-10 col-sm-10">
                        <input type="file" class="form-control-file" id="image" name="image" data-parsley-required="true" data-parsley-trigger="change" data-parsley-type="file" data-parsley-type-message="文件必须是图像类型。" data-parsley-max-size="5120" data-parsley-max-size-message="文件大小必须小于 5MB。" accept="image/*"> 
                    </div>
                </div> -->
                <div class="form-group row m-b-15">
                    <label class="col-md-2 col-sm-2 col-form-label">上传头像:</label>
                    <div class="col-md-10 col-sm-10">
                        <div class="custom-file">  
                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" data-parsley-required="false" data-parsley-trigger="change" data-parsley-type="file" data-parsley-type-message="文件必须是图像类型。" data-parsley-max-size="2048" data-parsley-max-size-message="文件大小必须小于 2MB。" onchange="previewImage(this)">  
                            <label class="custom-file-label" for="image">选择文件</label>  
                        </div> 
                        <div class="mt-2">  
                            <img id="imagePreview" src="" alt="预览图像" style="max-width: 100%; max-height: 200px; border: 1px solid #ddd; display: none;">  
                        </div> 
                    </div>
                </div>
                <div class="form-group row m-b-0">
                    <label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
                    <div class="col-md-10 col-sm-10">
                        <button type="submit" class="btn btn-info">{{ __('Save') }}</button>
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
@endpush