<style>
	#image{
		width: 85px;
		position: absolute;
		top: 0px;
		right: 127px;
		margin: 2px;
	}
	#one{
		width: 113px;
		position: relative;
		right: 0px;
		/*background-color: #000;*/
	}
	.navbar-default .navbar-nav>li>a{
		color: #e24747;
	}
</style>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="brand">
		<a href="/admin"><img src="/reception/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
	</div>
	<div class="container-fluid">
		<div class="navbar-btn">
			<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
		</div>
		<div id="navbar-menu">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					
					<ul class="dropdown-menu notifications">
						<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
						<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
						<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly report is available</a></li>
						<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly meeting in 1 hour</a></li>
						<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your request has been approved</a></li>
						<li><a href="#" class="more">See all notifications</a></li>
					</ul>
				</li>
				<img src="/uploads/{{ session('admin_users')->profile }}" class="img-thumbnail" alt="Avatar" id="image">
				<li class="dropdown" id="one">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span>{{ session('admin_users')->uname }}</span><i class="icon-submenu lnr lnr-chevron-down"></i></a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="lnr lnr-user"></i> <span></span>我的个人信息</a></li>
						<li><a href="#"><i class="lnr lnr-cog"></i> <span>修改密码</span></a></li>
						<li><a href="/admin/loginout"><i class="lnr lnr-exit"></i> <span>退出登录</span></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>