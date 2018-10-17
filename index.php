<!DOCTYPE html>
<html>
<head>
	<title>Calculadora de Subredes JA</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
	<header >
		<article class="jumbotron" style="background-color:#0747a6">
			<h1 class="text-center" style="color: white"> Calculadora de Subredes </h1>
		</article>
	</header>

    <?php
    if(isset($_POST["ipAdress"]))
    {
        $ipAdress = $_POST["ipAdress"];
    }
    else{
        $ipAdress= 0;
    }
    if(isset($_POST["firstNetmask"]))
    {
        $firstNetmask= $_POST["firstNetmask"];
    }
    else{
        $firstNetmask = 0;
    }
    if(isset($_POST["finalNetmask"]))
    {
        $finalNetmask= $_POST["finalNetmask"];
    }
    else{
        $finalNetmask= 0;
    }
    ?> <!--Validación variables cargadas-->
	<article class="container">
		<form action="index.php" method="POST">
			<div  class="form-group row">
				<div class="form-group form-group-sm col-sm-4">
					<label class="col-form-label">Dirección IP:</label>	
					<input type="text" name="ipAdress" value="<?php echo $ipAdress; ?>" class="form-control">
				</div>
				<div class="form-group form-group-sm col-sm-4">
					<label class="col-form-label">Netmask Inicial (ejem: 24):</label>
					<input type="number" name="firstNetmask" value="<?php echo $firstNetmask; ?>" class="form-control">
				</div>
				<div class="form-group form-group-sm col-sm-4">
					<label class="col-form-label">Netmask Final (ejem: 30):</label>		
					<input type="number" name="finalNetmask" value="<?php echo $finalNetmask; ?>" class="form-control">
				</div>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-primary">
					Calcular
				</button>
				<button class="btn btn-success">
					Limpiar
				</button>
			</div>
			
		</form>
	</article>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>