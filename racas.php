<?php
require_once 'php/usuario.php';
require_once 'php/adm.php';

$usuario = new Usuario();
$admin = new Admin();
$u = $usuario->view();
$p = $usuario->viewAtivo();

if(isset($_POST['editRaca'])) {
	$admin->racaEdit($_POST['id'], $_POST['nome']);
}
else if(isset($_POST['delRaca'])) {
	$admin->racaDelete($_POST['id']);
}
else if(isset($_POST['novaRaca'])) {
	$admin->racaInsert($_POST['nome']);
}

include_once 'header-adm.php';
?>
		<ul class="nav menu">
			<li><a href="adm.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li class="active"><a href="racas.php"><em class="fa fa-address-book">&nbsp;</em> Raças</a></li>
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
				<li class="active">Raças</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Raças</h1>
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
				<div class="col-md-6 sideCol">
					<table class="table">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">ID</th>
					      <th scope="col">Nome</th>
					      <th scope="col">Editar</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php 
					  	$r = $admin->racaView();
					  	$rM = $admin->racaMax();
						for($i=0;$i<sizeof($r);$i++) { ?>
					    <tr>
					      <th scope="row"><?php echo $r[$i]->id ?></th>
					      <td><?php echo $r[$i]->nome ?></td>
					      <td>
							<button class="btn btn-primary" onclick="appear('eRaca<?php echo $r[$i]->id ?>', <?php echo $rM ?>);">Editar</button>
							<button class="btn btn-danger" onclick="appear('dRaca<?php echo $r[$i]->id ?>', <?php echo $rM ?>);">Excluir</button>
					    </tr>
						<?php } ?>
					  </tbody>
					</table>
				</div>
				<div class="col-md-3 sideCol">
					<?php 
				  	$r = $admin->racaView();
					for($i=0;$i<sizeof($r);$i++) { ?>
					<form name="editRaca" method="post" action="racas.php" id="eRaca<?php echo $r[$i]->id ?>"  class="inv" enctype="multipart/form-data">
						<h2>Editar <?php echo $r[$i]->nome ?></h2>
						<input type="hidden" name="id" value="<?php echo $r[$i]->id ?>">
						<p>Nome:</p>
						<input type="text" name="nome" maxlength="45" value="<?php echo $r[$i]->nome ?>">
						<br><br>
						<button name="editRaca" class="btn btn-primary" type="submit">Editar</button>
				    </form>
				    <form name="delRaca" method="post" action="racas.php" id="dRaca<?php echo $r[$i]->id ?>" class="inv" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $r[$i]->id ?>">
						<h2>Excluir <?php echo $r[$i]->nome ?></h2>
						<p>Deseja realmente excluir <?php echo $r[$i]->nome ?>?</p>
						<button name="delRaca" class="btn btn-danger" type="submit">Excluir</button>
				    </form>
					<?php } ?>
				</div>
				<div class="col-md-3 sideCol">
					<form name="novaRaca" method="post" action="racas.php" id="nRaca" enctype="multipart/form-data">
						<h2>Criar raça</h2>
						<p>Nome:</p>
						<input type="text" name="nome" maxlength="45">
						<br><br>
						<button name="novaRaca" class="btn btn-success" type="submit">Criar raça</button>
				    </form>
				</div>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>