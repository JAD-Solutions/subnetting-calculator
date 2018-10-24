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
        if(isset($_POST["tipo"]))
        {
            if(isset($_POST['calculate_button']))
            {
                $tipo= $_POST["tipo"];
            }else
                $tipo="";
        }
        else{
            $tipo="";
        }
        if(isset($_POST["tipo2"]))
        {
            if(isset($_POST['calculate_button']))
            {
                $tipo2= $_POST["tipo2"];
            }else
                $tipo2="";
        }
        else{
            $tipo2="";
        }

    ?> 

    <!--Formulario-->
	<article class="container">
		<form action="index.php" method="POST">
			<div  class="form-group row">
				<div class="form-group form-group-sm col-sm-3">
					<label class="col-form-label">Dirección IP:</label>
					<input type="text" class="form-control" required id="ipAdress" name="ipAdress" value="<?php echo $ipAdress; ?>" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
				</div>
                <div class="form-group form-group-sm col-sm-3">
					<label class="col-form-label">Tipo de RED :</label>
                    <input type="text" class="form-control" required id="tipo" name="tipo" value="<?php echo $tipo; ?>" disabled>
					<input type="hidden" required id="tipo2" name="tipo2" value="<?php echo $tipo2; ?>  " >
				</div>
				<div class="form-group form-group-sm col-sm-3">
					<label class="col-form-label">Netmask Inicial (ejem: 24):</label>
					<input type="number" class="form-control" required id="firstNetmask" name="firstNetmask" value="<?php echo $firstNetmask; ?>">
				</div>
				<div class="form-group form-group-sm col-sm-3">
					<label class="col-form-label">Netmask Final (ejem: 30):</label>		
					<input type="number" required id="finalNetmask" name="finalNetmask"
                           value="<?php echo $finalNetmask; ?>" class="form-control" step="1" max="30">
				</div>
			</div>
            <br/>
			<div class="text-center">
				<button type="submit" name="calculate_button"  id="calculate_button" class="btn btn-primary">Calcular</button>
				<button type="submit" name="clean_button" class="btn btn-success">Limpiar</button>
			</div>
			
		</form>
	</article>



    <!--Calculo de Resultados-->
    <article class="jumbotron" style="background-color: #ffffff">
        <?php
           if(isset($_POST['calculate_button']))
          {
             if($firstNetmask!="No soportado"&&($finalNetmask>=$firstNetmask))
              {

                $firstBitsHost=32-$firstNetmask;
                $firstIpNumber= pow(2,$firstBitsHost);

                $finalBitsHost=32-$finalNetmask;
                $finalIpNumber= pow(2,$finalBitsHost);

                $subnettingNumber=$firstIpNumber/$finalIpNumber;
                $subnettingSize=$firstIpNumber/$subnettingNumber;

                  ?>
                  <table class="table table-stripped">
                      <thead  class="thead-dark">
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Subnetting</th>
                          <th scope="col">IPS Disponibles</th>
                          <th scope="col">Broadcast</th>
                      </tr>
                      </thead>
                      <tbody>


                  <?php

                if($tipo2=="Clase A"){
                    echo "calculo A";
                }
                if($tipo2=="Clase B"){
                    echo "calculo B";
                }
                if($tipo2=="Clase C"){

                    $ip=0;
                    $aux=$ip+1;
                    $aux2=$ip+$subnettingSize-2;
                    $aux3=$ip+$subnettingSize-1;
                    echo "<tr><th scope='col'>1</th><td>$ip</td><td>$aux - $aux2</td><td>$aux3</td></tr>";
                    for($i=2;$i<=$subnettingNumber;$i++){
                        $ip+=$subnettingSize;
                        $aux=$ip+1;
                        $aux2=$ip+$subnettingSize-2;
                        $aux3=$ip+$subnettingSize-1;
                        echo "<tr><th scope='col'>$i</th><td>$ip</td><td>$aux - $aux2</td><td>$aux3</td></tr>";
                    }
                    ?>
                    </tbody>
                    </table>

        <?php
                }
              }else
                echo "no se puede calcular";
          }
        ?>
    </article>


    <!--Validacion de Formulario-->
    <script type="application/javascript">
        var ipAdressInput = document.getElementById("ipAdress");
        var firstNetmask = document.getElementById("firstNetmask");
        var finalNetmask = document.getElementById("finalNetmask");
        var tipo = document.getElementById("tipo");
        function getClase() {
            var ipAdress = ipAdressInput.value.split('.');
            if (ipAdress[0] > 0 && ipAdress[0] < 127)
            {
                tipo.value="Clase A";
                tipo2.value="Clase A";
            }
            else if (ipAdress[0] >= 128 && ipAdress[0] < 191)
            {
                tipo.value="Clase B";
                tipo2.value="Clase B";
            }

            else if (ipAdress[0] >= 192 && ipAdress[0] < 223){
                tipo.value="Clase C";
                tipo2.value="Clase C";
            }

        }
        function getIpNetmask() {
            var ipAdress = ipAdressInput.value.split('.');
            if (ipAdress[0] > 0 && ipAdress[0] < 127)
            {
                firstNetmask.value = 8;
                tipo.value="Clase A";
                tipo2.value="Clase A";
            }
            else if (ipAdress[0] >= 128 && ipAdress[0] < 191)
            {
                firstNetmask.value = 16;
                tipo.value="Clase B";
                tipo2.value="Clase B";
            }

            else if (ipAdress[0] >= 192 && ipAdress[0] < 223){
                firstNetmask.value = 24;
                tipo.value="Clase C";
                tipo2.value="Clase C";
            }

            else
                firstNetmask.value = "No soportado";
            finalNetmask.min=firstNetmask.value;//el mínimo de la netmask de destino es la netmask por default
        }
        var triggerIp = document.getElementById("ipAdress");
        triggerIp.addEventListener("change", getIpNetmask, false);
        document.addEventListener("click", getClase, false);

    </script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>