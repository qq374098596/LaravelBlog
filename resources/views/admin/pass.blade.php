@extends('layouts.admin')
@section('content')

<div class="content-wrapper">

<div class="box box-info">
            <div class="box-header with-border">
              <section class="content-header">
    		  <h1>
    		    修改密码
    		    <small>Control panel</small>
    		  </h1>
    		  <ol class="breadcrumb">
    		    <li><a href="/"><i class="fa fa-dashboard"></i> 首页</a></li>
    		    <li class="active">修改密码</li>
    		  </ol>
    		</section>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">原密码</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">新密码</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control">
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