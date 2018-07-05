<?php
require_once 'php/usuario.php';
require_once 'session_u.php';

$u = $usuario->view();
$p = $usuario->viewAtivo();

include_once 'header.php';
?>
		<?php if(empty($p->id)) { 
    		header('Location: personagens.php');
    	} ?>
		<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="personagens.php"><em class="fa fa-address-book">&nbsp;</em> Personagens</a></li>
			<li><a href="atributos.php"><em class="fa fa-diagnoses">&nbsp;</em> Atributos</a></li>
			<li class="active"><a href="cenarios.php"><em class="fa fa-map-marked-alt">&nbsp;</em> Cenários</a></li>
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
				<li class="active">Cenários</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Cenários</h1>
			</div>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row sideCol">
				<div class="col-md-12">
					<h2><b>Cenários</b></h2>
				</div>
				<?php
				$c = $usuario->cenarios();
				for($i=0;$i<sizeof($c);$i++) { ?>
				<div class="col-md-6">
					<form name="cenario" method="post" action="cenario.php" enctype="multipart/form-data">
					<input type="hidden" name="c_id" value="<?php echo $c[$i]->id ?>">
					<input type="hidden" name="inimigo" value="<?php echo $usuario->inimigoEncontrado($c[$i]->id) ?>">
					<button name="cenario" type="submit" class="panel panel-<?php echo $c[$i]->dificuldade < 26 ? 'teal' : ($c[$i]->dificuldade < 51 ? 'blue' : ($c[$i]->dificuldade < 76 ? 'orange' : 'red')) ?> panel-heading" style="width: 100%">
						<?php echo $c[$i]->nome ?>
					</button>
					</form>
				</div>
				<?php } ?>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>