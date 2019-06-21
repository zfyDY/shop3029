<!doctype html>
<html lang="en">
<head>
@include('admin/public/header')
<style>
	th{text-align:center;line-height: 50px;}
	.form-body{margin: 25px 30px;}
	.form-group label{font-size: 22px;font-family: 幼圆;position: relative;top: 3px;}
	#hidden{overflow:hidden;
    	text-overflow:ellipsis;
    	white-space:nowrap;}
</style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- 导航栏 开始 -->
		@include('admin/public/navber')
		<!-- 导航栏 结束 -->
		
		<!-- 后台 左侧边栏 开始 -->
		@include('admin/public/sidebar')
		<!-- 后台 左侧边栏 结束 -->


		<!-- 后台 首页 主体 开始 -->
		<div class="main">
			<h1 style="vertical-align: inherit;margin:15px;">广告列表</h1>

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->
			
			<!-- 搜索框开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
					<form class="form-inline" action="/admin/adve" method="get"> 
						<div class="form-group"> 
							<label for="title">标题&nbsp;</label> 
							<input type="text" class="form-control" name="search_title" value="{{ $params['search_title'] or '' }}" id="title" placeholder="广告标题">&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="url">地址&nbsp;</label> 
							<input type="text" class="form-control" name="search_url" value="{{ $params['search_url'] or '' }}" id="url" placeholder="广告地址"> &nbsp;&nbsp;&nbsp;&nbsp;
						</div> 
						<input type="submit" value="搜索" class="btn btn-info">
						<!-- <input type="reset"  value="重置" class="btn btn-primary"> -->
					</form> 
				</div>
			<!-- 搜索框结束 -->


			<!-- 显示 用户列表 开始 -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">显示广告详情</h3>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>链接ID</th>
						<th>标题</th>
						<th>地址</th>
						<th>广告图</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
					@foreach($adves as $k=>$v)
					<tr align="center">
						<th style="line-height:58px;">{{ $v->id }}</th>
						<td style="line-height:58px;">
							<p title="{{ $v->title }}" style="width:250px" id="hidden">{{ $v->title }}</p>
						</td>
						<td style="line-height:58px;">
							<p title="{{ $v->url }}" style="width:300px" id="hidden">{{ $v->url }}</p>
						</td>
						<td>
							<img src="/uploads/{{$v->profile}}" class="img-thumbnail" style="width:120px;" alt="">
						</td>
						<td style="line-height:58px;">
						@if($v->status == 0)
					  	<a href="javascript:;" id="" class="btn btn-warning" onclick="changeStatus({{ $v->id }},0)">开启</a>
					  	@else
					  	<a href="javascript:;" id="" class="btn btn-primary" onclick="changeStatus({{ $v->id }},1)">关闭</a>
					  	@endif
						</td>
						<td style="line-height:58px;width:185px;">
							<a href="/admin/adve/{{ $v->id }}/edit" class="btn btn-info">修改</a>
							<form action="/admin/adve/{{$v->id}}" method="post" style="display:inline-block;">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<input type="submit" value="删除" class="btn btn-danger">
							</form>
						</td>
					</tr>
					@endforeach
				</table>

				<script>
					function changeStatus(id,status)
					{
						$.get('/admin/adve/wakeUp',{id:id,status:status},function(res){
							if(res=='ok'){
								location.reload(true);
							}
						},'html');
					}
				</script>

				<!-- 显示分页开始 -->
				<div style="margin:10px;"> 
					{{ $adves->appends($params)->links() }}
				</div>
				<!-- 显示分页结束 -->
			</div>
			<!-- 显示 用户列表 开始 -->
		</div>
		<!-- 后台 首页 主体 结束 -->

		<div class="clearfix"></div>
		
		<!-- 页脚 开始 -->
		@include('admin/public/footer')
		<!-- 页脚 结束 -->

	</div>
	<!-- END WRAPPER -->
	
	<!-- JavaScript 开始 -->
	@include('admin/public/script')
	<!-- JavaScript 结束 -->

</body>

</html>
