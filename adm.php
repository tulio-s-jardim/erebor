<?php
require_once 'php/usuario.php';
require_once 'php/adm.php';

$usuario = new Usuario();
$admin = new Admin();
$u = $usuario->view();
$p = $usuario->viewAtivo();

if(isset($_POST['edit'])) {
	$usuario->setEmail($_POST['email']);
	$usuario->setSenha($_POST['senha']);
	$usuario->edit();
	echo "<meta http-equiv='refresh' content='0'>";
}

include_once 'header-adm.php';
?>
		<ul class="nav menu">
			<li class="active"><a href="adm.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="racas.php"><em class="fa fa-address-book">&nbsp;</em> Raças</a></li>
			<li><a href="habilidades.php"><em class="fa fa-diagnoses">&nbsp;</em> Habilidades</a></li>
			<li><a href="inimigos.php"><em class="fa fa-skull">&nbsp;</em> Inimigos</a></li>
			<li><a href="inimigos_em_cenarios.php"><em class="fa fa-map-marked-alt">&nbsp;</em> Cenários</a></li>
			<li><a href="login.html"><em class="fa fa-power-off">&nbsp;</em> Desconectar</a></li>
		</ul>
	</div><!--/.sidebar-->
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Home</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Home</h1>
			</div>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row">
				<div class="col-lg-4 text-center">
					<img src="img/dragao.png" width="330px" alt="">
				</div>
				<div class="col-lg-8 mt-3">
					<div class="row">
						<div class="col-md-12 sideCol">
							<h2><?php echo $u->nome; ?></h2>
							<h3><b>E-mail</b></h3>
							<p><?php echo $u->email; ?></p>
							<h1><b>Bem-vindo(a) à área administrativa!</b></h1>
							<br><br><br><br><br>
						</div>
					</div>
					<button type="button" class="btn btn-lg btn-primary" onclick="location.href = 'editarPerfil.php';">Editar Perfil</button>
					<p></p>
				</div>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>