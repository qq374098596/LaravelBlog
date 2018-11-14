@extends('layouts.admin')
@section('content')

<div class="content-wrapper">
	<section class="content-header">
		<h1>新增分类</h1>
		<ol class="breadcrumb">
  			<li><a href="/"><i class="fa fa-dashboard"></i> 首页</a></li>
  			<!-- <li><a href="#">Tables</a></li> -->
  			<li><a href="{{URL('category')}}"> 全部分类</a></li>
  			<li class="active">新增分类</li>
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
						<form class="form-horizontal" action="{{url('category')}}" method="post">
						{{csrf_field()}}
							<div class="box-body">
    							<div class="form-group">
      								<label for="inputEmail3" class="col-sm-2 control-label"><i style="color:red">*</i> 父级分类</label>
      								<div class="col-sm-10">
        								<!-- <input type="text" name="" class="form-control"> -->
        								<select class="form-control" style="width:45%" name="cate_pid" id="">
        									<option value="0"> == 顶级分类 == </option>
        									@foreach($data as $d)
        									<option value="{{$d->cate_id}}">{{$d->cate_name}}</option>
        									@endforeach
        								</select>
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"><i style="color:red">*</i> 分类名称</label>
      								<div class="col-sm-10">
        								<input type="text" name="cate_name" class="form-control"><span><i style="color:red">*</i> 分类名称必须填写</span>
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"> 分类标题</label>
      								<div class="col-sm-10">
        								<input type="text" name="cate_title" class="form-control">
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"> 关键词</label>
      								<div class="col-sm-10">
        								<textarea class="form-control" name="cate_keywords" id="" rows="3"></textarea>
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"> 描述</label>
      								<div class="col-sm-10">
        								<textarea class="form-control" name="cate_description" id="" rows="3"></textarea>
      								</div>
    							</div>
    							<div class="form-group">
      								<label class="col-sm-2 control-label"><i style="color:red">*</i> 排序</label>
      								<div class="col-sm-10">
        								<input type="text" name="cate_order" class="form-control">
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