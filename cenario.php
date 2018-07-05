<?php
require_once 'php/usuario.php';
require_once 'session_u.php';

$u = $usuario->view();
$p = $usuario->viewAtivo();
$c = $usuario->viewCenario($_POST['c_id']);
$usuario->vEvent($_POST['inimigo']);
$i = $usuario->viewVersus($_POST['inimigo']);

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
				<li><a href="cenarios.php">Cenários</a></li>
				<li class="active"><?php echo $c->nome; ?></li>
			</ol>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row sideCol">
				<div class="col-md-12 panel-<?php echo $c->dificuldade < 26 ? 'teal' : ($c->dificuldade < 51 ? 'blue' : ($c->dificuldade < 76 ? 'orange' : 'red')) ?> titleC">
					<h2><b><?php echo $c->nome; ?></b></h2>
				</div>
				<p></p>
				<div class="col-md-12">
					<h2>Você se deparou com <b><?php echo $i->nome; ?></b></h2>
					<p></p>
					<div class="row progress-labels">
						<div class="col-sm-6">HP</div>
						<div class="col-sm-6" style="text-align: right;"><?php if(!isset($_POST['vitoria'])) echo $i->hp_atual; else echo "0"; ?>/<?php echo $i->hp_maximo; ?></div>
					</div>
					<div class="progress">
						<div data-percentage="0%" style="width: <?php if(!isset($_POST['vitoria'])) echo $i->hp_atual*100/$i->hp_maximo; else echo "0" ?>%;" class="progress-bar progress-bar-red" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
					</div>				
				</div>
				<div class="col-md-12">
					<?php
					$s = $usuario->skills();
					for($j=0;$j<sizeof($s);$j++) { ?>
					<div class="col-md-3">
					<form name="ataque" method="post" action="cenario.php" enctype="multipart/form-data">
						<input type="hidden" name="c_id" value="<?php echo $_POST['c_id'] ?>">
						<input type="hidden" name="inimigo" value="<?php echo $_POST['inimigo'] ?>">
						<input type="hidden" name="skill_id" value="<?php echo $s[$j]->id ?>">
						<button type="submit" name="ataque" class="btn btn-md" <?php if(isset($_POST['vitoria']) || isset($_POST['morte']) || $s[$j]->custo > $p->mana) echo "disabled" ?> ><b><?php echo $s[$j]->nome ?></b></button>
					</form>
						<p></p>
						<p>Gasto de mana: <?php echo $s[$j]->custo ?></p>
						<p>Dano base: <?php echo $s[$j]->dano_base ?></p>
						<p>Dano físico:  <?php echo $s[$j]->dano_fisico ?>x</p>
						<p>Dano mágico: <?php echo $s[$j]->dano_magico ?>x</p>
						<p>Cura: <?php echo $s[$j]->cura ?></p>
					</div>
					<?php } ?>
				</div>
				<?php
				if(isset($_POST['dano'])) { 
					$dano = $_POST['dano']; 
					$danoI = $_POST['danoI']; ?> 
					<div class="col-md-12">
						<h3>Você acertou <b><?php echo $i->nome; ?></b> com <?php echo $dano ?> de dano.</h3>
						<h3><b><?php echo $i->nome; ?></b> te acertou com <?php echo $danoI ?> de dano<?php if(isset($_POST['cura'])) echo " mas você curou ".$_POST['cura']." do dano" ?>.</h3>
					</div>
					<?php 
						if(isset($_POST['morte'])) { ?>
					<div class="col-md-12">
						<h2><b><?php echo $i->nome; ?></b> te matou!</h2>
					</div>
						<?php }
						else if(isset($_POST['vitoria'])) { ?>
					<div class="col-md-12">
						<h2>Você ganhou <b><?php echo $i->exp_concedida; ?> XP</b> por matar <b><?php echo $i->nome; ?></b>.</h2>
						<form name="cenario" method="post" action="cenario.php" enctype="multipart/form-data">
						<input type="hidden" name="c_id" value="<?php echo $c->id ?>">
						<input type="hidden" name="inimigo" value="<?php echo $usuario->inimigoEncontrado($c->id) ?>">
						<button name="cenario" type="submit" class="panel panel-<?php echo $c->dificuldade < 26 ? 'teal' : ($c->dificuldade < 51 ? 'blue' : ($c->dificuldade < 76 ? 'orange' : 'red')) ?> panel-heading" style="width: 100%">
							Continuar em <?php echo $c->nome ?>
						</button>
						</form>
					</div>
						<?php }
					} ?>
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
			</div><!--/.row-->
		</div>
		<?php
				if(isset($_POST['ataque'])) {
					$skill = $usuario->skill($_POST['skill_id']);
					$dano = $skill->dano_base + $skill->dano_magico*$p->inteligencia + $skill->dano_fisico*$p->forca;
					if($skill->cura > 0) {
						$danoI = round($i->dano*0.7 - ($p->constituicao/2) + $i->dano*0.3*rand(0,100)/100);
						$cura = round($skill->cura + $skill->dano_magico*$p->inteligencia);
						echo 'combate ' .
						$usuario->combate($danoI-$cura, $skill->custo, $dano, $i->id);
					}
					else {
						$danoI = round($i->dano*0.7 - ($p->constituicao/2) + $i->dano*0.3*rand(0,100)/100);
						$usuario->combate($danoI, $skill->custo, $dano, $i->id);
					} ?>
					<form name="refresh" id="refresh" method="post" action="<?php if($usuario->morto($p->id) != 1) echo 'cenario'; else echo 'personagens'; ?>.php" enctype="multipart/form-data">
						<input type="hidden" name="c_id" value="<?php echo $_POST['c_id'] ?>">
						<input type="hidden" name="inimigo" value="<?php echo $_POST['inimigo'] ?>">
						<?php
						if($usuario->morto($p->id) == 1)
							echo '<input type="hidden" name="morte" value="1">';
						if($i->hp_atual - $dano < 1)
							echo '<input type="hidden" name="vitoria" value="1">';
						if(isset($cura))
							echo '<input type="hidden" name="cura" value="'.$cura.'">';
						?>
						<input type="hidden" name="dano" value="<?php echo $dano ?>">
						<input type="hidden" name="danoI" value="<?php echo $danoI ?>">
					</form>
					<script type="text/javascript">
						function formAutoSubmit () {
						var frm = document.getElementById("refresh");
						frm.submit();
						}
						window.onload = formAutoSubmit;
					</script>
				<?php }?>
<?php
include_once 'footer.php';
?>