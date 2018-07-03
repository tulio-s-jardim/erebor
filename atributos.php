<?php
require_once 'php/usuario.php';

$usuario = new Usuario();
$u = $usuario->view();
$p = $usuario->viewAtivo();

if(isset($_POST['adc']) && $p->pontos_de_atributo > 0) {
	$usuario->atribui($_POST['atr']);
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
			<li><a href="index.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="personagens.php"><em class="fa fa-address-book">&nbsp;</em> Personagens</a></li>
			<li class="active"><a href="atributos.php"><em class="fa fa-diagnoses">&nbsp;</em> Habilidades/Atributos</a></li>
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
				<li class="active">Atributos e Habilidades</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Atributos e Habilidades</h1>
			</div>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row sideCol">
				<div class="col-md-12">
					<h2><b><?php echo $p->nome; ?></b></h2>
					<div class="row progress-labels">
						<div class="col-sm-6">HP</div>
						<div class="col-sm-6" style="text-align: right;"><?php echo $p->hp; ?>/<?php echo 300 + 25*($p->nivel-1); ?></div>
					</div>
					<div class="progress">
						<div data-percentage="0%" style="width: <?php echo $p->hp*100/(300 + 25*($p->nivel-1)); ?>%;" class="progress-bar progress-bar-red" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					<div class="row progress-labels">
						<div class="col-sm-6">Mana</div>
						<div class="col-sm-6" style="text-align: right;"><?php echo $p->mana; ?>/<?php echo 100 + 15*($p->nivel-1); ?></div>
					</div>
					<div class="progress">
						<div data-percentage="0%" style="width: <?php echo $p->mana*100/(100 + 15*($p->nivel-1)); ?>%;" class="progress-bar progress-bar-teal" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<form name="adc" method="post" action="atributos.php" enctype="multipart/form-data">
						<h3><b>Pontos de atributos disponíveis: <?php echo $p->pontos_de_atributo; ?></b></h3>
						<div class="radio">
							<label>
								<input type="radio" name="atr" id="optionsRadios1" value="1" checked>Força: <?php echo $p->forca; ?>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="atr" id="optionsRadios2" value="2">Inteligência: <?php echo $p->inteligencia; ?>
							</label>
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="atr" id="optionsRadios3" value="3">Constituição: <?php echo $p->constituicao; ?>
							</label>
						</div>
						<button name="adc" type="submit" class="btn btn-lg btn-primary" <?php if($p->pontos_de_atributo <= 0) echo "disabled" ?>>Adicionar Ponto</button>
						</form>
					</div>
				</div>
				<div class="col-md-8 form-group">
					<h3><b>Habilidades disponíveis:</b></h3>
					<?php
					$s = $usuario->skills();
					for($i=0;$i<sizeof($s);$i++) { ?>
					<div class="col-md-6">
						<h4><b><?php echo $s[$i]->nome ?></b></h4>
						<p>Gasto de mana: <?php echo $s[$i]->custo ?></p>
						<p>Dano base: <?php echo $s[$i]->dano_base ?></p>
						<p>Dano físico:  <?php echo $s[$i]->dano_fisico ?>x</p>
						<p>Dano mágico: <?php echo $s[$i]->dano_magico ?>x</p>
						<p>Cura: <?php echo $s[$i]->cura ?></p>
					</div>
					<?php } ?>
				</div>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>