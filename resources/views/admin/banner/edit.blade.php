<!doctype html>
<html lang="en">

<head>
@include('admin/public/header')

<style>
	.panel-body	h4{color: #666;}
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
			<h1 style="vertical-align: inherit;margin:15px;">修改轮播图信息</h1>

			<!-- 显示验证错误 开始 -->
			@include('admin/public/error')
			<!-- 显示验证错误 结束 -->

			<!-- 读取验证 提示信息 开始 -->
			@include('admin/public/tips')
			<!-- 读取验证 提示信息 结束 -->


			<form action="/admin/banner/{{ $banner_date->id }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="panel">
					<div class="panel-body">
						<div>
							<h4><font style="vertical-align: inherit;">标题</font></h4>
							<input type="text" name="title" class="form-control" placeholder="请输入标题" value="{{ $banner_date->title }}">
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">描述</font></h4>
							<input type="text" name="desc" class="form-control" placeholder="请输入轮播图描述" value="{{ $banner_date->desc }}">
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">链接地址</font></h4>
							<input type="text" name="url" class="form-control" placeholder="请填写URL链接" value="{{ $banner_date->url }}">
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">原轮播图</font></h4>
							<img src="/uploads/{{ $banner_date->profile }}" class="img-thumbnail" style="width:250px;"  alt="">
						</div>
						<div>
							<h4><font style="vertical-align: inherit;">上传新图片</font></h4>
							<input type="file" name="profile" class="form-control">
							<input type="hidden" name="profile_path" value="{{$banner_date->profile}}">
						</div>
						<br>
						<div class="col-md-6">
							<button type="submit" class="btn btn-success" style="width:70px;float:left;margin:5px;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">修改</font></font></button>
							<a href="/admin/banner" class="btn btn-info" style="width:100px;float:left;margin:5px;padding:7.5px;">返回列表</a>
						</div>
					</div>
				</div>
			</form>
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
