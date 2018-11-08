@extends('layouts.admin')
@section('content')

<div class="content-wrapper">
<section class="content-header">
  <h1>
    全部分类
    
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
    <!-- <li><a href="#">Tables</a></li> -->
    <li class="active">全部分类</li>
  </ol>
</section>
<section class="content">
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
          	<th><input type="checkbox"></th>
          	<th>排序</th>
            <th>ID</th>
            <th>分类名称</th>
            <th>标题</th>
            <th>查看次数</th>
            <th>操作</th>
          </tr>

          @foreach($data as $v)
          <tr>
          	<td><input type="checkbox"></td>
            <td><input style="width:25px;text-align:center" type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_order}}"></td>
            <td>{{$v->cate_id}}</td>
            <td>{{$v->_cate_name}}</td>
            <td>{{$v->cate_title}}</td>
            <td>2</td>
            <td><span class="label label-success">编辑</span> <span class="label label-warning">删除</span></td>
          </tr>
          @endforeach
          
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix">
        <ul class="pagination pagination-sm no-margin pull-right">
          <li><a href="#">&laquo;</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">&raquo;</a></li>
        </ul>
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
</section>
</div>

@endsection
@section('script')
<!-- Slimscroll -->
<script src="{{asset('static/admin')}}/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script>
	function changeOrder(obj,cate_id){
		var cate_order = $(obj).val();
		console.log(cate_order);
		console.log(cate_id);
		$.post("{{url('cate/changeorder')}}",{'_token':'{{csrf_token()}}','cate_order':cate_order,'cate_id':cate_id},function(data){
			if (data.status==0) {
				alert(data.msg)
			}else{
				alert(data.msg)
			}
		})
	}
</script>
@endsection