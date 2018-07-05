<?php
require_once 'php/usuario.php';
$usuario = new usuario();
session_start();

if (isset($_SESSION)) {
	session_unset();
	session_destroy();
}

if (isset($_POST['login'])) {
	$uid = $usuario->existeU($_POST['email'], sha1($_POST['senha']));
	if (!is_null($uid)) {
        session_start();
        $_SESSION["uid"] = $uid;
        header("Location: index.php");
	} else {
		echo "<script>alert('Conta/senha inválida!')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dragão de Erebor - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body class="loginb">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Entrar</div>
				<div class="panel-body">
					<form name="login" method="post" action="login.php" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Senha" name="senha" type="password" value="">
							</div>
							<button type="submit" name="login" class="btn btn-primary">Entrar</button>
							<a href="signin.php" class="btn btn-primary">Criar conta</a>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
