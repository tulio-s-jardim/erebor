<?php
require_once 'php/usuario.php';
require_once 'session_u.php';

$u = $usuario->view();
$p = $usuario->viewAtivo();

include_once 'header.php';
?>
		<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-address-card">&nbsp;</em> Home</a></li>
			<li><a href="personagens.php"><em class="fa fa-address-book">&nbsp;</em> Personagens</a></li>
			<li><a href="atributos.php"><em class="fa fa-diagnoses">&nbsp;</em> Atributos</a></li>
			<li><a href="cenarios.php"><em class="fa fa-map-marked-alt">&nbsp;</em> Cenários</a></li>
			<li class="active"><a href="estatisticas.php"><em class="fa fa-chart-bar">&nbsp;</em> Estatísticas</a></li>
			<li><a href="login.php"><em class="fa fa-power-off">&nbsp;</em> Desconectar</a></li>
		</ul>
	</div><!--/.sidebar-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Estatísticas</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Estatísticas</h1>
			</div>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="row sideCol">
				<div class="col-md-12">
					<h2><b>Estatísticas</b></h2>
				</div>
				<div class="col-md-6">
					<h3>Média dos personagens</h3>
					<div class="canvas-wrapper">
						<canvas class="chart" id="radar-chart" ></canvas>
					</div>
					<p></p>
				</div>
				<div class="col-md-6">
					<h3>Total de pontos distribuídos no servidor:</h3>
					<p><?php echo $usuario->ptosServer(); ?></p>
					<h3>Personagens mortos:</h3>
					<p><?php echo $usuario->mortosServer(); ?></p>
					<h3>Dano médio dos inimigos:</h3>
					<p><?php echo explode(".",$usuario->danoIServer())[0]; ?></p>
					<h3>Vida média dos inimigos:</h3>
					<p><?php echo explode(".",$usuario->hpIServer())[0]; ?></p>
					<p></p>
				</div>
			</div><!--/.row-->
		</div>
<?php
include_once 'footer.php';
?>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/custom.js"></script>

<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	var radarAtributos = {
	    labels: ["Nível", "Força", "Inteligência", "Constituição"],
	    datasets: [
	        {
	            label: "Média de atributos e nível",
	            fillColor : "rgba(48, 164, 255, 0.2)",
	            strokeColor : "rgba(48, 164, 255, 0.8)",
	            pointColor : "rgba(48, 164, 255, 1)",
	            pointStrokeColor : "#fff",
	            pointHighlightFill : "#fff",
	            pointHighlightStroke : "rgba(48, 164, 255, 1)",
	            data: <?php 
	            $media = $usuario->atrServer();
	            echo '['.$media->nivel.', '.$media->forca.', '.$media->inteligencia.', '.$media->constituicao.']';
	            ?>
	        }
	    ]
	};
</script>
<script>
		window.onload = function () {
		var chart5 = document.getElementById("radar-chart").getContext("2d");
		window.myRadarChart = new Chart(chart5).Radar(radarAtributos, {
		responsive: true,
		scaleLineColor: "rgba(0,0,0,.05)",
		angleLineColor: "rgba(0,0,0,.2)"
		});
	};
</script>