@extends('layouts.admin')
@section('content')

<div class="content-wrapper">

<div class="box box-info">
<!-- <div class="box-header with-border"> -->
	<section class="content-header">
		<h1>修改密码<small>Control panel</small></h1>
		<ol class="breadcrumb">
			<li><a href="/"><i class="fa fa-dashboard"></i> 首页</a></li>
			<li class="active">修改密码</li>
		</ol>
		@if(count($errors)>0)
		<div style="background:#FDF7E1;margin-left:10px;padding:10px;font-size:16px;">
			@if(is_object($errors))
				@foreach($errors->all() as $error)
					<p style="margin:0;padding:0"><i class="glyphicon glyphicon-remove-circle"></i> {{$error}}</p>
				@endforeach
			@else
				<p style="margin:0;padding:0"><i class="glyphicon glyphicon-remove-circle"></i> {{$errors}}</p>
			@endif
		</div>
		@endif
	</section>
	<!-- </div> -->
	<!-- /.box-header -->
	<!-- form start -->
	<form class="form-horizontal" action="" method="post">
		{{csrf_field()}}
		<div class="box-body">
    		<div class="form-group">
      			<label for="inputEmail3" class="col-sm-2 control-label"><i style="color:red">*</i> 原密码</label>

      			<div class="col-sm-10">
        			<input type="password" name="password_o" class="form-control"><span><i style="color:red">*</i> 请输入原始密码</span>
      			</div>
    		</div>
    		<div class="form-group">
      			<label for="inputPassword3" class="col-sm-2 control-label"><i style="color:red">*</i> 新密码</label>

      			<div class="col-sm-10">
        			<input type="password" name="password" class="form-control"><span><i style="color:red">*</i> 新密码6-20位</span>
      			</div>
    		</div>
    		<div class="form-group">
      			<label for="inputPassword3" class="col-sm-2 control-label"><i style="color:red">*</i> 确认密码</label>

      			<div class="col-sm-10">
        			<input type="password" name="password_confirmation" class="form-control"><span><i style="color:red">*</i> 再次输入密码</span>
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

@endsection