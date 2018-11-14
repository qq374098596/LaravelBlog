@extends('layouts.admin')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="content-wrapper">
	<section class="content-header">
		<h1>新增文章</h1>
		<ol class="breadcrumb">
  			<li><a href="/"><i class="fa fa-dashboard"></i> 首页</a></li>
  			<!-- <li><a href="#">Tables</a></li> -->
  			<li><a href="{{URL('category')}}"> 全部文章</a></li>
  			<li class="active">新增文章</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h5 class="box-title">快捷操作</h5>
						@if(count($errors)>0)
							<div style="background:#FDF7E1;margin-left:10px;padding:10px;font-size:14px;">
								@if(is_object($errors))
									@foreach($errors->all() as $error)
										<p style="margin:0;padding:0"><i class="glyphicon 	glyphicon-remove-circle"></i> 				{{$error}}</p>
									@endforeach
								@else
									<p style="margin:0;padding:0"><i class="glyphicon glyphicon-remove-circle">	</i> 				{1errors}</p>
								@endif
							</div>
						@endif
						<form class="form-horizontal" action="{{url('article')}}" method="post">
						{{csrf_field()}}
							<div class="box-body">
    							<div class="form-group">
      								<label for="inputEmail3" class="col-sm-2 control-label"> 分类</label>
      								<div class="col-sm-10">
        								<!-- <input type="text" name="" class="form-control"> -->
        								<select class="form-control" style="width:45%" name="cate_id" id="">
        									@foreach($data as $d)
        									<option value="{{$d->cate_id}}">{{$d->_cate_name}}</option>
        									@endforeach
        								</select>
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"><i style="color:red">*</i> 文章标题</label>
      								<div class="col-sm-10">
        								<input type="text" name="art_title" class="form-control">
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"> 编辑</label>
      								<div class="col-sm-10">
        								<input style="width:20%" type="text" name="art_editor" class="form-control">
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"> 缩略图</label>
      								<div class="col-sm-10">
        								<input style="width:50%;float:left" type="text" name="art_thumb" class="form-control" readonly="readonly" value="">
        								<button type="button" style="float:left;margin-left:20px" class="btn btn-info pull" id="art_thumb">上传图片
        									<input style="position: absolute;font-size: 20px;right: 0;top: 0;opacity: 0;" type="file" multiple="multiple" id="inputfile" name="" class="photo">
        								</button>
      								</div>
    							</div>
    							<div class="form-group">
    								<label class="col-sm-2 control-label"> 预览图</label>
    								<div>
    									<img id="art_thumb_img" style="width:30%;border:1px solid #eee;margin-left:12px" src="{{asset('static/admin')}}/images/time.png" alt="">
    								</div>   								
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"> 关键词</label>
      								<div class="col-sm-10">
        								<input type="text" name="art_tag" class="form-control">
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"> 描述</label>
      								<div class="col-sm-10">
        								<textarea class="form-control" name="art_description" id="" rows="3"></textarea>
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"><i style="color:red">*</i> 文章内容</label>
      								<div class="col-sm-10">
      									<script type="text/javascript" charset="utf-8" src="{{asset('static/org')}}/ueditor/ueditor.config.js"></script>
    									<script type="text/javascript" charset="utf-8" src="{{asset('static/org')}}/ueditor/ueditor.all.min.js"> </script>
    									<script type="text/javascript" charset="utf-8" src="{{asset('static/org')}}/ueditor/lang/zh-cn/zh-cn.js"></script>
    									<script id="editor" name="art_content" type="text/plain" style="width:100%;height:500px;"></script>
    									<script type="text/javascript">
    										var ue = UE.getEditor('editor');
    									</script>
      								</div>
    							</div>
    							
    							
  							</div>
  							<!-- /.box-body -->
  							<div class="box-footer">
    							<button type="submit" class="btn btn-default">返回</button>
    							<button type="submit" class="btn btn-info pull-right">提交</button>
  							</div>
  							<!-- /.box-footer -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@section('script')

<script>
	$.ajaxSetup({
    	headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
    });
</script>

<script>
	$(function(){
		$('#inputfile').change(function(){
			var formData = new FormData();
			var Filedata  = $('#inputfile')[0].files[0];
			console.log(Filedata);
			formData.append('Filename', Filedata.name);
			formData.append('timestamp', '{{time()}}');
			formData.append('_token','{{csrf_token()}}');
			formData.append('Filedata', Filedata);
			//console.log(formData);
			//解决方案
			var request = new XMLHttpRequest();
            request.open("POST", "{{url('upload')}}");
            request.send(formData);
            request.onload = function (oEvent) {
            	//console.log(request);
            	$('input[name=art_thumb]').val(request.responseText);
            	$('#art_thumb_img').attr('src',request.responseText)
            	//alert(request.responseText);
            }
            /**
             * 使用FormData传输通过laravel的dd 函数打印$_FILES 为空，打印$_REQUEST 为乱码
             */
			// $.ajax({
			// 	url:"{{url('upload')}}",
			// 	data:formData,
			// 	type:"post",
			// 	dataType:'json',
			// 	processData:false,
			// 	//contentData:false,
			// 	success:function(data){
			// 		console.log(data);
			// 	}
			// })
		})
	})
</script>

@endsection