<?php
require_once 'php/usuario.php';
require_once 'php/adm.php';
require_once 'session_a.php';

$admin = new Admin();
$u = $usuario->view();
$p = $usuario->viewAtivo();

if(isset($_POST['editH'])) {
	if($_POST['raca_id'] == 0) {
	$admin->hEditN($_POST['id'], $_POST['nome'], $_POST['custo'], $_POST['nivel_min'], $_POST['dano_base'], $_POST['dano_fisico'], $_POST['dano_magico'], $_POST['cura']);
	} else {
	$admin->hEdit($_POST['id'], $_POST['nome'], $_POST['custo'], $_POST['nivel_min'], $_POST['dano_base'], $_POST['dano_fisico'], $_POST['dano_magico'], $_POST['cura'], $_POST['raca_id']);
	}
}
else if(isset($_POST['delH'])) {
	$admin->hDelete($_POST['id']);
}
else if(isset($_POST['novaH'])) {
	if($_POST['raca_id'] == 0) {
	$admin->hInsert($_POST['nome'], $_POST['custo'], $_POST['nivel_min'], $_POST['dano_base'], $_POST['dano_fisico'], $_POST['dano_magico'], $_POST['cura']);
	} else {
	$admin->hInsert($_POST['nome'], $_POST['custo'], $_POST['nivel_min'], $_POST['dano_base'], $_POST['dano_fisico'], $_POST['dano_magico'], $_POST['cura'], $_POST['raca_id']);
	}
}

include_once 'header-adm.php';
?>
		<ul class="nav menu">
			<li><a href="adm.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="racas.php"><em class="fa fa-address-book">&nbsp;</em> Raças</a></li>
			<li class="active"><a href="habilidades.php"><em class="fa fa-diagnoses">&nbsp;</em> Habilidades</a></li>
			<li><a href="inimigos.php"><em class="fa fa-skull">&nbsp;</em> Inimigos</a></li>
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
				<li class="active">Habilidades</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Habilidades</h1>
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
					      <th scope="col">Raça</th>
					      <th scope="col">Nome</th>
					      <th scope="col">Custo</th>
					      <th scope="col">Nível mínimo</th>
					      <th scope="col">Dano base</th>
					      <th scope="col">Mult. físico</th>
					      <th scope="col">Mult. mágico</th>
					      <th scope="col">Cura</th>
					      <th scope="col">Editar</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  	$h = $admin->hView();
						for($i=0;$i<sizeof($h);$i++) { ?>
					    <tr>
					      <th scope="row"><?php echo $h[$i]->raca ?></th>
					      <td><?php echo $h[$i]->hnome ?></td>
					      <td><?php echo $h[$i]->custo ?></td>
					      <td><?php echo $h[$i]->nivel_min ?></td>
					      <td><?php echo $h[$i]->dano_base ?></td>
					      <td><?php echo $h[$i]->dano_fisico ?></td>
					      <td><?php echo $h[$i]->dano_magico ?></td>
					      <td><?php echo $h[$i]->cura ?></td>
					      <td>
							<button class="btn btn-sm btn-primary" onclick="appear('eRaca<?php echo $h[$i]->hid ?>');">Editar</button>
							<button class="btn btn-sm btn-danger" onclick="appear('dRaca<?php echo $h[$i]->hid ?>');">Excluir</button>
					    </tr>
						<?php } ?>
					  </tbody>
					</table>
				</div>
				<div class="col-md-12 sideCol">
					<?php 
				  	$h = $admin->hView();
					for($i=0;$i<sizeof($h);$i++) { ?>
					<form name="editH" method="post" action="habilidades.php" id="eRaca<?php echo $h[$i]->hid ?>"  class="inv" enctype="multipart/form-data">
						<h2>Editar <?php echo $h[$i]->hnome ?></h2>
						<input type="hidden" name="id" value="<?php echo $h[$i]->hid ?>">
						<p>Nome:</p>
						<input type="text" name="nome" maxlength="45" value="<?php echo $h[$i]->hnome ?>">
						<br><br>
						<p>Custo:</p>
						<input type="number" name="custo" value="<?php echo $h[$i]->custo ?>">
						<br><br>
						<p>Nível Mínimo:</p>
						<input type="number" name="nivel_min" value="<?php echo $h[$i]->nivel_min ?>">
						<br><br>
						<p>Dano base:</p>
						<input type="number" name="dano_base" value="<?php echo $h[$i]->dano_base ?>">
						<br><br>
						<p>Mult. Físico:</p>
						<input type="number" step="0.01" name="dano_fisico" value="<?php echo $h[$i]->dano_fisico ?>">
						<br><br>
						<p>Mult. Mágico:</p>
						<input type="number" step="0.01" name="dano_magico" value="<?php echo $h[$i]->dano_magico ?>">
						<br><br>
						<p>Cura:</p>
						<input type="number" name="cura" value="<?php echo $h[$i]->cura ?>">
						<br><br>
						<p>Raça:</p>
						<select name="raca_id">
  							<option value="0">Nenhuma</option>
						<?php
						$ini = $admin->racaView();
						for($j=0;$j<sizeof($ini);$j++) { ?>
  							<option value="<?php echo $ini[$j]->id ?>" <?php if($ini[$j]->id == $h[$i]->raca_id) echo 'selected' ?>><?php echo $ini[$j]->nome ?></option>
  						<?php } ?>
  						</select>
						<br><br>
						<button name="editH" class="btn btn-primary" type="submit">Editar</button>
				    </form>
				    <form name="delH" method="post" action="habilidades.php" id="dRaca<?php echo $h[$i]->hid ?>" class="inv" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $h[$i]->hid ?>">
						<h2>Excluir <?php echo $h[$i]->hnome ?></h2>
						<p>Deseja realmente excluir <?php echo $h[$i]->hnome ?>?</p>
						<button name="delH" class="btn btn-danger" type="submit">Excluir</button>
				    </form>
					<?php } ?>
				</div>
				<div class="col-md-12 sideCol">
					<form name="novaH" method="post" action="habilidades.php" id="nRaca" enctype="multipart/form-data">
						<h2>Criar habilidade</h2>
						<p>Nome:</p>
						<input type="text" name="nome" maxlength="45">
						<br><br>
						<p>Custo:</p>
						<input type="number" name="custo">
						<br><br>
						<p>Nível Mínimo:</p>
						<input type="number" name="nivel_min">
						<br><br>
						<p>Dano base:</p>
						<input type="number" name="dano_base">
						<br><br>
						<p>Mult. Físico:</p>
						<input type="number" step="0.01" name="dano_fisico">
						<br><br>
						<p>Mult. Mágico:</p>
						<input type="number" step="0.01" name="dano_magico">
						<br><br>
						<p>Cura:</p>
						<input type="number" name="cura">
						<br><br>
						<p>Raça:</p>
						<select name="raca_id">
  							<option value="0">Nenhuma</option>
						<?php
						$i = $admin->racaView();
						for($j=0;$j<sizeof($i);$j++) { ?>
  							<option value="<?php echo $i[$j]->id ?>"><?php echo $i[$j]->nome ?></option>
  						<?php } ?>
  						</select>
						<br><br>
						<button name="novaH" class="btn btn-success" type="submit">Criar habilidade</button>
				    </form>
				</div>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>