<!doctype html>
<html lang="en">
<head>
@include('admin/public/header')
<style>
	th{text-align:center;line-height: 50px;}
	.form-body{margin: 25px 30px;}
	.form-group label{font-size: 22px;font-family: 幼圆;position: relative;top: 3px;}
	#hidden{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
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
			<h1 style="vertical-align: inherit;margin:15px;">轮播图列表</h1>

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->
			
			<!-- 搜索框开始 -->
				<div class="form-body" data-example-id="simple-form-inline">
					<form class="form-inline" action="/admin/banner" method="get"> 
						<div class="form-group"> 
							<label for="title">标题&nbsp;</label> 
							<input type="text" class="form-control" name="search_title" value="{{ $params['search_title'] or '' }}" id="title" placeholder="标题">&nbsp;&nbsp;&nbsp;&nbsp;
							<label for="desc">描述&nbsp;</label> 
							<input type="text" class="form-control" name="search_desc" value="{{ $params['search_desc'] or '' }}" id="desc" placeholder="描述"> &nbsp;&nbsp;&nbsp;&nbsp;
							<label for="url">URL&nbsp;</label> 
							<input type="text" class="form-control" name="search_url" value="{{ $params['search_url'] or '' }}" id="url" placeholder="链接"> &nbsp;&nbsp;&nbsp;&nbsp;
						</div> 
						<input type="submit" value="搜索" class="btn btn-info">
					</form> 
				</div>
			<!-- 搜索框结束 -->


			<!-- 显示 用户列表 开始 -->
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">显示轮播图详情</h3>
				</div>
				<table class="table table-bordered">
					<tr>
						<th>轮播图ID</th>
						<th>标题</th>
						<th>图片</th>
						<th>描述</th>
						<th>URL地址</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
					@foreach($banners as $k=>$v)
					<tr align="center">
						<th style="line-height:85px;">{{ $v->id }}</th>
						<td style="line-height:85px;">{{ $v->title }}</td>
						<td>
							<img src="/uploads/{{ $v->profile }}" class="img-thumbnail" style="width:130px;" alt="">
						</td>
						<td style="line-height:85px;">
							<p title="{{ $v->desc }}" style="width:300px" id="hidden">{{ $v->desc }}</p>
						</td>
						<td style="line-height:85px;">{{ $v->url }}</td>
						<td style="line-height:85px;">
						@if($v->status == 0)
					  	<a href="javascript:;" id="" class="btn btn-warning" onclick="changeStatus({{ $v->id }},0)">开启</a>
					  	@else
					  	<!-- <a href="/admin/banner/wakeUp/{{ $v->id }}" class="btn btn-primary">关闭</a> -->
					  	<a href="javascript:;" id="" class="btn btn-primary" onclick="changeStatus({{ $v->id }},1)">关闭</a>
					  	@endif
						</td>
						<td style="line-height:85px;width:200px;">
							<a href="/admin/banner/{{ $v->id }}/edit" class="btn btn-info">修改</a>
							<form action="/admin/banner/{{$v->id}}" method="post" style="display:inline-block;">
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
						$.get('/admin/banner/wakeUp',{id:id,status:status},function(res){
							if(res=='ok'){
								location.reload(true);
							}
						},'html');
					}
					

				</script>

				<!-- 显示分页开始 -->
				<div style="margin:10px;"> 
					{{ $banners->appends($params)->links() }}
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
