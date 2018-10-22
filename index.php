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
			<a href="index.php"><h1 class="text-center" style="color: white"> Calculadora de Subredes </h1></a>
		</article>
	</header>

    <!--Validación variables cargadas-->
    <?php 
        if(isset($_POST["ipAdress"]))
        {
            if(isset($_POST['calculate_button']))
            {
                $ipAdress = $_POST["ipAdress"];
            }else
                $ipAdress = "";
        }
        else{
            $ipAdress= 0;
        }
        if(isset($_POST["firstNetmask"]))
        {
            if(isset($_POST['calculate_button']))
            {
                $firstNetmask= $_POST["firstNetmask"];
            }else
                $firstNetmask="";
        }
        else{
            $firstNetmask = 0;
        }
        if(isset($_POST["finalNetmask"]))
        {
            if(isset($_POST['calculate_button']))
            {
                $finalNetmask= $_POST["finalNetmask"];
            }else
                $finalNetmask="";
        }
        else{
            $finalNetmask= 0;
        }
    ?> 

    <!--Formulario-->
	<article class="container">
		<form action="index.php" method="POST">
			<div  class="form-group row">
				<div class="form-group form-group-sm col-sm-4">
					<label class="col-form-label">Dirección IP:</label>
					<input type="text" id="ipAdress" name="ipAdress" value="<?php echo $ipAdress; ?>" class="form-control" required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
				</div>
				<div class="form-group form-group-sm col-sm-4">
					<label class="col-form-label">Netmask Inicial (ejem: 24):</label>
					<input type="text" required id="firstNetmask" name="firstNetmask" value="<?php echo $firstNetmask; ?>" class="form-control">
				</div>
				<div class="form-group form-group-sm col-sm-4">
					<label class="col-form-label">Netmask Final (ejem: 30):</label>		
					<input type="number" required id="finalNetmask" name="finalNetmask"
                           value="<?php echo $finalNetmask; ?>" class="form-control" step="1" max="30">
				</div>
			</div>
			<div class="text-center">
				<button type="submit" name="calculate_button" class="btn btn-primary">Calcular</button>
				<button type="submit" name="clean_button" class="btn btn-success">Limpiar</button>
			</div>
			
		</form>
	</article>

    <!--Validacion de Formulario-->
    <script type="application/javascript">
        var ipAdressInput = document.getElementById("ipAdress");
        var firstNetmask = document.getElementById("firstNetmask");
        var finalNetmask = document.getElementById("finalNetmask");
        function getIpNetmask() {
            var ipAdress = ipAdressInput.value.split('.');
            if (ipAdress[0] > 0 && ipAdress[0] < 127)
                firstNetmask.value = 8;
            else if (ipAdress[0] >= 128 && ipAdress[0] < 191)
                firstNetmask.value = 16;
            else if (ipAdress[0] >= 192 && ipAdress[0] < 223)
                firstNetmask.value = 24;
            else
                firstNetmask.value = "No soportado";
            finalNetmask.min=firstNetmask.value;//el mínimo de la netmask de destino es la netmask por default
        }

        var triggerIp = document.getElementById("ipAdress");
        triggerIp.addEventListener("change", getIpNetmask, false);
    </script>

    <!--Calculo de Resultados-->
    <?php 
       if(isset($_POST['calculate_button']))
      {
         if($ipAdress!=""&&$firstNetmask=""&&$finalNetmask="")
          {
            echo "vamos a calcular";
          }else
            echo "todos los campos deben tener un valor";
      }
    ?>
    
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>