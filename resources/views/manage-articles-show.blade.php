@extends('layouts.default')
@section('title','查看文章')
@push('css')
	<link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
@endpush
@section('content')
	<!-- begin breadcrumb -->
	<ol class="breadcrumb float-xl-right">
		<li class="breadcrumb-item"><a href="{{ route('index') }}">主页</a></li>
		<li class="breadcrumb-item"><a href="{{ route('articles.index') }}">列表文章</a></li>
        <li class="breadcrumb-item active">查看文章</li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">查看文章 <small></small></h1>
	<!-- end page-header -->
	<!-- begin panel -->
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h4 class="panel-title">查看</h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
			</div>
		</div>
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

						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="title">标题 : </label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control" type="text" id="title" name="title" value="{{ $article->title }}" placeholder="标题" data-parsley-required="true" />
							</div>
						</div>
                        <div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="slug">SEO标题 : </label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control parsley-validated" type="text" id="slug" name="slug" value="{{ $article->slug }}" placeholder="URL标题" data-parsley-required="true" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="types_id">分类 :</label>
							<div class="col-md-10 col-sm-10">
                                <select class="form-control" id="types_id" name="types_id" data-parsley-required="true">
									<option value="">分类（必填）</option>
									@foreach ($primaryTypes as $primaryType)  
										<option value="{{ $primaryType->id }}" @if($article->types_id == $primaryType->id) selected @endif> - {{ $primaryType->title }} ({{ $primaryType->id }}) </option>
										@if ( $primaryType->children->isNotEmpty() && $primaryType->id != 1 )  
											@foreach ($primaryType->children as $secondaryMenu)  
												<option value="{{ $secondaryMenu->id }}" @if($article->types_id == $primaryType->id) selected @endif> - {{ $primaryType->title }} -  - {{ $secondaryMenu->title }} ({{ $primaryType->id }}) </option>
											@endforeach   
										@endif  
									@endforeach  
								</select>
							</div>
						</div>
                        
                        <div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="keywords">关键词 :</label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control parsley-validated" type="text" id="keywords" name="keywords" value="{{ $article->keywords }}" placeholder="关键词" data-parsley-required="true" />
							</div>
						</div>
                        <div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="description">描述:</label>
							<div class="col-md-10 col-sm-10">
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="描述(10-200)字" data-parsley-required="true" data-parsley-length="[2,200]">{{ $article->description }}</textarea>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="cover">索引图 :</label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control parsley-validated" type="text" id="cover" name="cover" value="{{ $article->cover }}" placeholder="索引图" data-parsley-required="false" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="author">作者 :</label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control parsley-validated" type="text" id="author" name="author" value="{{ $article->author }}" placeholder="作者" data-parsley-required="false" />
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label" for="source">来源 :</label>
							<div class="col-md-10 col-sm-10">
								<input class="form-control parsley-validated" type="text" id="source" name="source" value="{{ $article->source }}" placeholder="来源" data-parsley-required="false" />
							</div>
						</div>
						
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-sm-2 col-form-label">状态 :</label>
                            <div class="col-md-10 col-sm-10">
								<div class="radio radio-css radio-inline">
                                    <input type="radio" name="status" id="status1" value="1" @if($article->status == 1) checked @endif data-parsley-required="true" />
									<label for="status1">立即发布</label>
								</div>
								<div class="radio radio-css radio-inline">
									<input type="radio" name="status" id="status0" value="0" @if($article->status == 0) checked @endif />
									<label for="status0">暂存草稿</label>
								</div>
							</div>
						</div>
                        <div class="form-group row m-b-15">
                            <div class="col-md-12 col-sm-12">
                                <textarea class="ckeditor" id="content" name="content" rows="20">{{ $article->content }}</textarea>
							</div>
						</div>
						<!-- 
						<div class="form-group row m-b-0">
							<label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
							<div class="col-md-10 col-sm-10">
								<button type="submit" class="btn btn-warning">确定</button>
							</div>
						</div>
						 -->
                        <div class="form-group row m-b-0">
							<label class="col-md-2 col-sm-2 col-form-label">&nbsp;</label>
							<div class="col-md-10 col-sm-10">
                                <a class="btn btn-warning" href="{{ route('articles.index') }}">返回列表</a>
							</div>
						</div>
		</div>
	</div>
	<!-- end panel -->
@endsection
@push('scripts')
<script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
<script src="/assets/plugins/highlight.js/highlight.min.js"></script>
<script src="/assets/plugins/ckeditor/ckeditor.js"></script>
<script src="/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/assets/js/demo/form-wysiwyg.demo.js"></script>
<script type="text/javascript">
    var handleRenderHighlight = function() { 
        $('.hljs-wrapper pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    };

    var Highlight = function () {
        "use strict";
        return {
            //main function
            init: function () {
                handleRenderHighlight();
            }
        };
    }();

    $(document).ready(function() {
        Highlight.init();
    });
</script>
@endpush