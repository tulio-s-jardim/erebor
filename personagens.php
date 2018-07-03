<?php
require_once 'php/usuario.php';

$usuario = new Usuario();
$u = $usuario->view();
$p = $usuario->viewAtivo();
$prs = $usuario->viewPersonagens();

if(isset($_POST['ativar'])) {
	$usuario->ativar($_POST['id']);
	echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_POST['sim'])) {
	$usuario->deletarP($_POST['id']);
	echo "<meta http-equiv='refresh' content='0'>";
}

if(isset($_POST['nao']))
	echo "<meta http-equiv='refresh' content='0'>";

if(isset($_POST['criar'])) {
	$usuario->criarP($_POST['nome'], $_POST['raca']);
	echo "<meta http-equiv='refresh' content='0'>";
}

include_once 'header.php';
?>
		<ul class="nav menu">
			<li><a <?php if(!empty($p->id)) echo 'href="index.php"' ?> ><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li class="active"><a href="personagens.php"><em class="fa fa-address-book">&nbsp;</em> Personagens</a></li>
			<li><a <?php if(!empty($p->id)) echo 'href="atributos.php"' ?> ><em class="fa fa-diagnoses">&nbsp;</em> Habilidades/Atributos</a></li>
			<li><a <?php if(!empty($p->id)) echo 'href="cenarios.php"' ?> ><em class="fa fa-map-marked-alt">&nbsp;</em> Cenários</a></li>
			<li><a <?php if(!empty($p->id)) echo 'href="estatisticas.php"' ?> ><em class="fa fa-chart-bar">&nbsp;</em> Estatísticas</a></li>
			<li><a <?php if(!empty($p->id)) echo 'href="login.php"' ?> ><em class="fa fa-power-off">&nbsp;</em> Desconectar</a></li>
		</ul>
	</div><!--/.sidebar-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Personagens</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Personagens</h1>
			</div>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row sideCol">
						<div class="col-md-12">
							<h2><b>Personagens</b></h2>
							<?php if(empty($p->id)) { ?>
							<div class="col-md-12 panel-red titleC">
							<h2><b>Seu último personagem morreu durante batalha. Escolha outro para continuar.</b></h2>
							</div>
							<?php } ?>
							<?php 
							if(isset($_POST['delete'])) { ?>
								<form name="deletar" method="post" action="personagens.php" enctype="multipart/form-data">
									<p>Você deseja realmente excluir <?php echo $usuario->viewPersonagem($_POST['id'])->nome ?>?</p>
									<input name="id" type="hidden" value="<?php echo $_POST['id']; ?>">
									<button name="sim" type="submit" class="btn btn-sm btn-danger">Sim</button>
									<button name="nao" type="submit" class="btn btn-sm btn-muted">Não</button>
								</form>
							<?php }
							for($i=0;$i<sizeof($prs);$i++) { ?>
							<div class="mt-2">
					<form name="edit" method="post" action="personagens.php" enctype="multipart/form-data">
								<div class="row progress-labels">
									<input name="id" type="hidden" value="<?php echo $prs[$i]->id; ?>">
									<div class="col-sm-6"><h4><?php echo $prs[$i]->nome; ?> <?php 

									if($prs[$i]->ativo==1) echo "<span class='tag'>ATIVO</span>"; 
									else if($prs[$i]->ativo==0) echo "<button name='ativar' type='submit' class='tag3'>ATIVAR</button>"; 
									else echo "<span class='tag2'>MORTO</span>";

									?> <button name='delete' type='submit' class='tag4'>EXCLUIR</button></h4></div>
									<div class="col-sm-6" style="text-align: right;"><h4>Nível <?php echo $prs[$i]->nivel; ?></h4></div>
								</div>
					</form>
								<div class="row progress-labels">
									<div class="col-sm-6"><?php echo $prs[$i]->raca; ?></div>
									<div class="col-sm-6" style="text-align: right;"><?php echo $prs[$i]->experiencia; ?>%</div>
								</div>
								<div class="progress">
									<div data-percentage="0%" style="width: <?php echo $prs[$i]->experiencia; ?>%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<?php } ?>
							<button type="button" class="btn btn-lg" onclick="document.getElementById('novoP').style.display = 'block';">Novo Personagem</button>
							<p></p>
							<div id="novoP" class="text-center" style="display:none;">
								<form name="criar" method="post" action="personagens.php" enctype="multipart/form-data">
									<div class="row">
									<div class="col-md-6">
									<h3>Nome do Personagem: </h3>
									<input type="text" name="nome" maxlength="12" style="width:100%">
									</div>
									<div class="col-md-6">
									<h3>Raça: </h3>
									<select name="raca" style="width:100%">
									<?php
									$r = $usuario->viewRacas();
									for($i=0;$i<sizeof($r);$i++) { ?>
										<option value="<?php echo $r[$i]->id ?>"><?php echo $r[$i]->nome; ?></option>
									<?php }?>
									</select>
									</div>
									</div>
									<p></p>
									<div class="col-md-12 mt-3">
									<button name="criar" type="submit" class="btn btn-lg btn-primary">Criar</button>
									<p></p>
									</div>
								</form>
							</div>
						</div>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>