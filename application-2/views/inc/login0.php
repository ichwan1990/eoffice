<!DOCTYPE html>
<html lang="en">
<head>
	<link href="<?=base_url()?>assets/dev/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="<?=base_url()?>assets/dev/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/dev/bootstrap.min.js"></script>
	<style>
	body#LoginForm{ background-color:#f0ad4e; padding:10px;}
	.form-heading { color:#fff; font-size:23px;}
	.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
	.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
	.login-form .form-control {
	background: #f7f7f7 none repeat scroll 0 0;
	border: 1px solid #d4d4d4;
	border-radius: 4px;
	font-size: 14px;
	height: 50px;
	line-height: 50px;
	}
	.main-div {
	background: #ffffff none repeat scroll 0 0;
	border-radius: 2px;
	margin: 10px auto 30px;
	max-width: 38%;
	padding: 50px 70px 70px 71px;
	}

	.login-form .form-group {
	margin-bottom:10px;
	}
	.login-form{ text-align:center;}
	.forgot a {
	color: #777777;
	font-size: 14px;
	text-decoration: underline;
	}
	.login-form  .btn.btn-primary {
	background: #f0ad4e none repeat scroll 0 0;
	border-color: #f0ad4e;
	color: #ffffff;
	font-size: 14px;
	width: 100%;
	height: 50px;
	line-height: 50px;
	padding: 0;
	}
	.forgot {
	text-align: left; margin-bottom:30px;
	}
	.botto-text {
	color: #ffffff;
	font-size: 14px;
	margin: auto;
	}
	.login-form .btn.btn-primary.reset {
	background: #ff9900 none repeat scroll 0 0;
	}
	.back { text-align: left; margin-top:10px;}
	.back a {color: #444444; font-size: 13px;text-decoration: none;}
	.text {color:#e80b18; font-size:12px; }
	</style>
	<title>Login Surat</title>
</head>
<body id="LoginForm">
	<div class="container">
		<div class="login-form" style="margin-top:100px;">
			<div class="main-div">
				<div class="panel">
					<h2>Login Form</h2>
					<p>Please enter your username and password</p>
				</div>
				<form action="" method="post" autocomplete="off">
					<div style="margin-bottom:20px;">
						<span class="text"><b><?=$this->session->flashdata('alert')?></b></span>
					</div>
					<div class="form-group">
						<div align="left">
							<span class="text"><b><?=form_error('username')?></b></span>
						</div>
						<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
					</div>
					<div class="form-group">
						<div align="left">
							<span class="text"><b><?=form_error('password')?></b></span>
						</div>
						<input type="password" class="form-control" name="password" placeholder="Password" required>
					</div>
					<button type="submit" name="login" class="btn btn-primary">Login</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>