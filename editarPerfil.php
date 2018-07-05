<?php
require_once 'php/usuario.php';
require_once 'session_u.php';

$u = $usuario->view();
$p = $usuario->viewAtivo();
$prs = $usuario->viewPersonagens();

include_once 'header.php';
?>
		<?php if(empty($p->id)) { 
    		header('Location: personagens.php');
    	} ?>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="personagens.php"><em class="fa fa-address-book">&nbsp;</em> Personagens</a></li>
			<li><a href="atributos.php"><em class="fa fa-diagnoses">&nbsp;</em> Atributos</a></li>
			<li><a href="cenarios.php"><em class="fa fa-map-marked-alt">&nbsp;</em> Cenários</a></li>
			<li><a href="estatisticas.php"><em class="fa fa-chart-bar">&nbsp;</em> Estatísticas</a></li>
			<li><a href="login.php"><em class="fa fa-power-off">&nbsp;</em> Desconectar</a></li>
		</ul>
	</div><!--/.sidebar-->
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li>Home</li>
				<li class="active">Editar Perfil</li>
			</ol>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row">
				<div class="col-md-12 sideCol">
					<h2>Editar Perfil</h2>
					<form name="edit" method="post" action="index.php" enctype="multipart/form-data">
						<div class="col-md-6">
							<h3><b>Nome</b></h3>
							<p><?php echo $u->nome; ?></p>
							<h3><b>E-mail</b></h3>
							<input type="email" name="email" style="width:100%" value="<?php echo $u->email; ?>" maxlength="45">
							<h3><b>Senha</b></h3>
							<input type="password" name="senha" style="width:100%"  maxlength="18">
						</div>
						<div class="col-md-6">
							
						<h3><b>Avatar</b></h3>
						<img src="<?php echo $u->end_avatar ?>" class="img-circle" style="height: 300px;width: 300px;" id="avatar">
						<br>
						<label for="upload-photo" class="btn" id="clickable-gray">Escolha uma foto
							<input type="file" name="upload-photo" id="upload-photo" onchange="onFileSelected(event);">
						</label>
						</div>
						<div class="col-md-12 text-center">
							<button type="submit" name="edit" class="btn btn-lg btn-primary">Salvar</button>
						</div>
					</form>
					<p></p>
				</div>
			</div><!--/.row-->
		</div>
		<script type="text/javascript">
		// Função para carregar o exemplo da imagem
		function onFileSelected(event) {
			var selectedFile = event.target.files[0];
			var reader = new FileReader();
			var imgtag = document.getElementById("avatar");
			imgtag.title = selectedFile.name;
			reader.onload = function(event) {
				imgtag.src = event.target.result;
			};
			reader.readAsDataURL(selectedFile);
		}
		</script>
<?php
include_once 'footer.php';
?>