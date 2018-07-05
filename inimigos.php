<?php
require_once 'php/usuario.php';
require_once 'php/adm.php';
require_once 'session_a.php';

$admin = new Admin();
$u = $usuario->view();
$p = $usuario->viewAtivo();

if(isset($_POST['editI'])) {
	$admin->iEdit($_POST['id'], $_POST['nome'], $_POST['hp_maximo'], $_POST['dano'], $_POST['mult_magico'], $_POST['mult_fisico'], $_POST['exp_concedida']);
}
else if(isset($_POST['delI'])) {
	$admin->iDelete($_POST['id']);
}
else if(isset($_POST['novoI'])) {
	$admin->iInsert($_POST['nome'], $_POST['hp_maximo'], $_POST['dano'], $_POST['mult_magico'], $_POST['mult_fisico'], $_POST['exp_concedida']);
}

include_once 'header-adm.php';
?>
		<ul class="nav menu">
			<li><a href="adm.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="racas.php"><em class="fa fa-address-book">&nbsp;</em> Raças</a></li>
			<li><a href="habilidades.php"><em class="fa fa-diagnoses">&nbsp;</em> Habilidades</a></li>
			<li class="active"><a href="inimigos.php"><em class="fa fa-skull">&nbsp;</em> Inimigos</a></li>
			<li><a href="inimigos_em_cenarios.php"><em class="fa fa-map-marked-alt">&nbsp;</em> Cenários</a></li>
			<li><a href="login.php"><em class="fa fa-power-off">&nbsp;</em> Desconectar</a></li>
		</ul>
	</div><!--/.sidebar-->
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Inimigos</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Inimigos</h1>
			</div>
		</div><!--/.row-->

		<script type="text/javascript">
		function appear(onde, total) {
			elements = document.getElementsByClassName('inv');
			for(var i=0; i < elements.length; i++) { 
				elements[i].style.display = "none";
			}
			document.getElementById(onde).style.display = "block";
		}
		</script>

		<div class="panel panel-container">
			<div class="row">
				<div class="col-md-12 sideCol">
					<table class="table">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">Id</th>
					      <th scope="col">Nome</th>
					      <th scope="col">HP</th>
					      <th scope="col">Dano</th>
					      <th scope="col">Mult. físico</th>
					      <th scope="col">Mult. mágico</th>
					      <th scope="col">XP</th>
					      <th scope="col">Editar</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  	$h = $admin->inimigoView();
						for($i=0;$i<sizeof($h);$i++) { ?>
					    <tr>
					      <th scope="row"><?php echo $h[$i]->id ?></th>
					      <td><?php echo $h[$i]->nome ?></td>
					      <td><?php echo $h[$i]->hp_maximo ?></td>
					      <td><?php echo $h[$i]->dano ?></td>
					      <td><?php echo $h[$i]->mult_fisico ?></td>
					      <td><?php echo $h[$i]->mult_magico ?></td>
					      <td><?php echo $h[$i]->exp_concedida ?></td>
					      <td>
							<button class="btn btn-sm btn-primary" onclick="appear('eRaca<?php echo $h[$i]->id ?>');">Editar</button>
							<button class="btn btn-sm btn-danger" onclick="appear('dRaca<?php echo $h[$i]->id ?>');">Excluir</button>
					    </tr>
						<?php } ?>
					  </tbody>
					</table>
				</div>
				<div class="col-md-12 sideCol">
					<?php 
				  	$h = $admin->inimigoView();
					for($i=0;$i<sizeof($h);$i++) { ?>
					<form name="editI" method="post" action="inimigos.php" id="eRaca<?php echo $h[$i]->id ?>"  class="inv" enctype="multipart/form-data">
						<h2>Editar <?php echo $h[$i]->nome ?></h2>
						<input type="hidden" name="id" value="<?php echo $h[$i]->id ?>">
						<p>Nome:</p>
						<input type="text" name="nome" maxlength="45" value="<?php echo $h[$i]->nome ?>">
						<br><br>
						<p>HP:</p>
						<input type="number" name="hp_maximo" value="<?php echo $h[$i]->hp_maximo ?>">
						<br><br>
						<p>Dano:</p>
						<input type="number" name="dano" value="<?php echo $h[$i]->dano ?>">
						<br><br>
						<p>Mult. Físico:</p>
						<input type="number" step="0.01" name="mult_fisico" value="<?php echo $h[$i]->mult_fisico ?>">
						<br><br>
						<p>Mult. Mágico:</p>
						<input type="number" step="0.01" name="mult_magico" value="<?php echo $h[$i]->mult_magico ?>">
						<br><br>
						<p>Experiência Concedida:</p>
						<input type="number" name="exp_concedida" value="<?php echo $h[$i]->exp_concedida ?>">
						<br><br>
						<button name="editI" class="btn btn-primary" type="submit">Editar</button>
				    </form>
				    <form name="delI" method="post" action="inimigos.php" id="dRaca<?php echo $h[$i]->id ?>" class="inv" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $h[$i]->id ?>">
						<h2>Excluir <?php echo $h[$i]->nome ?></h2>
						<p>Deseja realmente excluir <?php echo $h[$i]->nome ?>?</p>
						<button name="delI" class="btn btn-danger" type="submit">Excluir</button>
				    </form>
					<?php } ?>
				</div>
				<div class="col-md-12 sideCol">
					<form name="novoI" method="post" action="inimigos.php" id="nRaca" enctype="multipart/form-data">
						<h2>Criar inimigo</h2>
						<p>Nome:</p>
						<input type="text" name="nome" maxlength="45">
						<br><br>
						<p>HP:</p>
						<input type="number" name="hp_maximo">
						<br><br>
						<p>Dano:</p>
						<input type="number" name="dano">
						<br><br>
						<p>Mult. Físico:</p>
						<input type="number" step="0.01" name="mult_fisico">
						<br><br>
						<p>Mult. Mágico:</p>
						<input type="number" step="0.01" name="mult_magico">
						<br><br>
						<p>Experiência Concedida:</p>
						<input type="number" name="exp_concedida">
						<br><br>
						<button name="novoI" class="btn btn-success" type="submit">Criar inimigo</button>
				    </form>
				</div>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>