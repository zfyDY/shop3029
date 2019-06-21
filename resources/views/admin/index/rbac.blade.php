<!doctype html>
<html lang="en">
<style>
	#h1{
		/*margin: 200px auto;*/
		opacity: .5;
		text-shadow: 5px 5px 2px #0ff;
	}
	#nonode{margin: 20px 400px;}
</style>
<head>
@include('admin/public/header')
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- 导航栏 开始 -->
		
		<!-- 导航栏结束 -->
		@include('admin/public/navber')
		<!-- 后台 左侧边栏 开始 -->
		@include('admin/public/sidebar')
		<!-- 后台 左侧边栏 结束 -->


		<!-- 后台 首页 主体 开始 -->
		<div class="main">
			<h1 id="h1" class="text-info text-center">您没有权限访问.....</h1>
			<img src="/reception/img/timg.gif" alt="" id="nonode">
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
