<?php
require_once 'php/usuario.php';

$usuario = new Usuario();
$u = $usuario->view();
$p = $usuario->viewAtivo();
$prs = $usuario->viewPersonagens();

if(isset($_POST['login'])) {
	$usuario->loginDiario();
	echo "<meta http-equiv='refresh' content='0'>";
}


if(isset($_POST['edit'])) {
	$usuario->setEmail($_POST['email']);
	$usuario->setSenha($_POST['senha']);

	// Se alguma foto foi inserida
	if (!empty($_FILES["upload-photo"]["name"])) {
		$target_dir = "img/";
		$target_file = $target_dir . basename($_FILES["upload-photo"]["name"]);
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$uploadOk = 0;
		$target_file = $target_dir . $_POST['email'] . "." . $imageFileType;
		// Se arquivo já existe
		$oldFile = $u->end_avatar;
		if ($u->end_avatar != "img/default.jpg") {
			chmod($u->end_avatar, 0755);
			unlink($u->end_avatar);
		}
		$sendFile = move_uploaded_file($_FILES["upload-photo"]["tmp_name"], $target_file);
		// Se deu algum erro após upload
		if(!$sendFile)
	    	$uploadOk = 4;
		else
			$usuario->setEnd_avatar($target_file);
	} else {
		$usuario->setEnd_avatar($u->end_avatar);
	}
	$usuario->edit();
	echo "<meta http-equiv='refresh' content='0'>";
}

include_once 'header.php';
?>
		<?php if(empty($p->id)) { ?>
		<script type="text/javascript">
			function refresh() {
				location.href = "personagens.php";
			}
			window.onload = refresh;
		</script>
		<?php } ?>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="personagens.php"><em class="fa fa-address-book">&nbsp;</em> Personagens</a></li>
			<li><a href="atributos.php"><em class="fa fa-diagnoses">&nbsp;</em> Habilidades/Atributos</a></li>
			<li><a href="cenarios.php"><em class="fa fa-map-marked-alt">&nbsp;</em> Cenários</a></li>
			<li><a href="estatisticas.php"><em class="fa fa-chart-bar">&nbsp;</em> Estatísticas</a></li>
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
							<h3><b>Personagens</b></h3>
							<?php 
							for($i=0;$i<sizeof($prs);$i++) { ?>
							<div class="mt-2">
								<div class="row progress-labels">
									<div class="col-sm-6"><h4><?php echo $prs[$i]->nome; ?> <?php if($prs[$i]->ativo==1) echo "<span class='tag'>ATIVO</span>";?><?php if($prs[$i]->ativo==-1) echo "<span class='tag2'>MORTO</span>";?></h4></div>
									<div class="col-sm-6" style="text-align: right;"><h4>Nível <?php echo $prs[$i]->nivel; ?></h4></div>
								</div>
								<div class="row progress-labels">
									<div class="col-sm-6"><?php echo $prs[$i]->raca; ?></div>
									<div class="col-sm-6" style="text-align: right;"><?php echo $prs[$i]->experiencia; ?>%</div>
								</div>
								<div class="progress">
									<div data-percentage="0%" style="width: <?php echo $prs[$i]->experiencia; ?>%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
					<form name="login" method="post" action="index.php" enctype="multipart/form-data">
						<?php if($u->login_diario == 0) echo "<p>Recompensa diária recebido por hoje.</p>"; ?>
						<button name="login" type="submit" class="btn btn-lg btn-success" <?php if($u->login_diario == 0) echo "disabled" ?> >Recompensa Diária</button>
						<button type="button" class="btn btn-lg btn-primary" onclick="location.href = 'editarPerfil.php';">Editar Perfil</button>
					</form>
					<p></p>
				</div>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>