<?php
require_once 'php/usuario.php';
require_once 'php/adm.php';
require_once 'session_a.php';

$admin = new Admin();
$u = $usuario->view();
$p = $usuario->viewAtivo();

if(isset($_POST['editC'])) {
	$admin->cenarioEdit($_POST['id'], $_POST['nome'], $_POST['dificuldade']);
}
else if(isset($_POST['delC'])) {
	$admin->cenarioDelete($_POST['id']);
}
else if(isset($_POST['novoC'])) {
	$admin->cenarioInsert($_POST['nome'], $_POST['dificuldade']);
}
else if(isset($_POST['eProb'])) {
	$admin->iecEdit($_POST['id'], $_POST['inimigo_id'], $_POST['prob']);
}
else if(isset($_POST['dProb'])) {
	$admin->iecDelete($_POST['id'], $_POST['inimigo_id']);
}
else if(isset($_POST['novoProb'])) {
	$admin->iecInsert($_POST['id'], $_POST['inimigo_id'], $_POST['prob']);
}

include_once 'header-adm.php';
?>
		<ul class="nav menu">
			<li><a href="adm.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="racas.php"><em class="fa fa-address-book">&nbsp;</em> Raças</a></li>
			<li><a href="habilidades.php"><em class="fa fa-diagnoses">&nbsp;</em> Habilidades</a></li>
			<li><a href="inimigos.php"><em class="fa fa-skull">&nbsp;</em> Inimigos</a></li>
			<li class="active"><a href="inimigos_em_cenarios.php"><em class="fa fa-map-marked-alt">&nbsp;</em> Cenários</a></li>
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

		<script type="text/javascript">
		function appear(onde) {
			elements = document.getElementsByClassName('inv');
			for(var i=0; i < elements.length; i++) { 
				elements[i].style.display = "none";
			}
			document.getElementById(onde).style.display = "block";
		}
		</script>

		<div class="panel panel-container">
			<div class="row">
				<?php 
				if(isset($_POST['prob']) || isset($_POST['eProb']) || isset($_POST['dProb']) || isset($_POST['novoProb'])) {
				?>
				<div class="col-md-8 sideCol">
					<h2>Inimigos em <?php echo $_POST['nome'] ?></h2>
					<?php
					$iec = $admin->iecView($_POST['id']);
					for($j=0;$j<sizeof($iec);$j++) { ?>
					<form name="editProb" method="post" action="inimigos_em_cenarios.php" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
						<input type="hidden" name="nome" value="<?php echo $_POST['nome'] ?>">
						<input type="hidden" name="inimigo_id" value="<?php echo $iec[$j]->inimigo_id ?>">
						<label><?php echo $iec[$j]->nome ?></label>
						<input type="number" name="prob" max="100" min="1" value="<?php echo $iec[$j]->probabilidade ?>"><br><br>
						<button name="eProb" class="btn btn-primary" type="submit">Editar</button>
						<button name="dProb" class="btn btn-danger" type="submit">Remover</button><br><br>
				    </form>
					<?php } ?>
				</div>
				<div class="col-md-4 sideCol">
					<form name="novoProb" method="post" action="inimigos_em_cenarios.php" id="nRaca" enctype="multipart/form-data">
						<h2>Adicionar inimigo</h2>
						<input type="hidden" name="id" value="<?php echo $_POST['id'] ?>">
						<input type="hidden" name="nome" value="<?php echo $_POST['nome'] ?>">
						<p>Inimigo:</p>
						<select name="inimigo_id">
						<?php
						$i = $admin->inimigoView();
						for($j=0;$j<sizeof($i);$j++) { ?>
  							<option value="<?php echo $i[$j]->id ?>"><?php echo $i[$j]->nome ?></option>
  						<?php } ?>
  						</select>
						<br><br>
						<p>Probabilidade:</p>
						<input type="number" name="prob" max="100" min="1">
						<br><br>
						<button name="novoProb" class="btn btn-success" type="submit">Adicionar Inimigo</button>
				    </form>
				</div>
				<?php } else { ?>
				<div class="col-md-6 sideCol">
					<table class="table">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Nome</th>
					      <th scope="col">Dif.</th>
					      <th scope="col">Editar</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  	$cnr = $admin->cenarioView();
						for($i=0;$i<sizeof($cnr);$i++) { ?>
					    <tr>
					      <th scope="row"><?php echo $cnr[$i]->id ?></th>
					      <td><?php echo $cnr[$i]->nome ?></td>
					      <td><?php echo $cnr[$i]->dificuldade ?></td>
					      <td>
							<button class="btn btn-sm btn-primary" onclick="appear('eRaca<?php echo $cnr[$i]->id ?>');">Editar</button>
							<button class="btn btn-sm btn-danger" onclick="appear('dRaca<?php echo $cnr[$i]->id ?>');">Excluir</button>
					    </tr>
						<?php } ?>
					  </tbody>
					</table>
				</div>
				<div class="col-md-3 sideCol">
					<?php 
				  	$cnr = $admin->cenarioView();
					for($i=0;$i<sizeof($cnr);$i++) { ?>
					<form name="editC" method="post" action="inimigos_em_cenarios.php" id="eRaca<?php echo $cnr[$i]->id ?>"  class="inv" enctype="multipart/form-data">
						<h2>Editar <?php echo $cnr[$i]->nome ?></h2>
						<input type="hidden" name="id" value="<?php echo $cnr[$i]->id ?>">
						<p>Nome:</p>
						<input type="text" name="nome" maxlength="45" value="<?php echo $cnr[$i]->nome ?>">
						<br><br>
						<p>Dificuldade:</p>
						<input type="number" name="dificuldade" max="100" min="1" value="<?php echo $cnr[$i]->dificuldade ?>">
						<br><br>
						<button name="editC" class="btn btn-primary" type="submit">Editar</button><br><br>
						<button name="prob" class="btn btn-primary" type="submit">Editar inimigos no cenário</button><br><br>
				    </form>
				    <form name="delC" method="post" action="inimigos_em_cenarios.php" id="dRaca<?php echo $cnr[$i]->id ?>" class="inv" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $cnr[$i]->id ?>">
						<h2>Excluir <?php echo $cnr[$i]->nome ?></h2>
						<p>Deseja realmente excluir <?php echo $cnr[$i]->nome ?>?</p>
						<button name="delC" class="btn btn-danger" type="submit">Excluir</button>
				    </form>
					<?php } ?>
				</div>
				<div class="col-md-3 sideCol">
					<form name="novoC" method="post" action="inimigos_em_cenarios.php" id="nRaca" enctype="multipart/form-data">
						<h2>Criar cenário</h2>
						<p>Nome:</p>
						<input type="text" name="nome" maxlength="45">
						<br><br>
						<p>Dificuldade:</p>
						<input type="number" name="dificuldade" max="100" min="1">
						<br><br>
						<button name="novoC" class="btn btn-success" type="submit">Criar cenário</button>
				    </form>
				</div>
				<?php } ?>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>