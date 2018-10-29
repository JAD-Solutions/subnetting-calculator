<!DOCTYPE html>
<html>
<head>
	<title>Calculadora de Subredes JA</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto" rel="stylesheet">
</head>

<body>
	<header >
		<article class="jumbotron" style="background-color:#0747a6; margin-left: auto; margin-right: auto;">
                <h1>
                    <a href="" class="typewrite" data-period="2000" data-type='[ "Calculadora de subredes.", "Segmente su red de internet.", "La nueva solución en materia de redes.", "Aprende a segmentar." ]'>
                        <span class="wrap"></span>
                    </a>
                </h1>
		</article>
	</header>

    <!--Validación variables cargadas-->
    <?php 
        if(isset($_POST["ipAdress"]))
        {
            if(isset($_POST['calculate_button']))
            {
                $ipAdress = $_POST["ipAdress"];
            }else{
                $ipAdress = "";
            }
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
    ?> 

    <!--Formulario-->
	<article class="container">
		<form action="index.php" method="POST">
			<div  class="form-group row">
				<div class="form-group form-group-sm col-sm-3">
					<label class="col-form-label">Dirección IP:</label>
                    <div class="help-tip">
                        <p>La dirección es la credencial pública que tiene para navegar por internet.</p>
                    </div>
					<input type="text" class="form-control" required id="ipAdress" name="ipAdress" value="<?php echo $ipAdress; ?>" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$">
  				</div>
                <div class="form-group form-group-sm col-sm-3">
					<label class="col-form-label">Tipo de RED:</label>
                    <div class="help-tip">
                        <p>En este trabajo se usarán tres redes: A < 127, B < 191, C < 223.</p>
                    </div>
                    <input type="text" readonly="readonly" class="form-control" required id="tipo" name="tipo" value="<?php echo $tipo; ?>">
				</div>
				<div class="form-group form-group-sm col-sm-3">
					<label class="col-form-label">Netmask Inicial (ejem: 24):</label>
                    <div class="help-tip">
                        <p>Este campo es llenado automáticamente por la aplicación a la hora que se introduce una dirección ip.</p>
                    </div>
					<input type="number" class="form-control" required id="firstNetmask" name="firstNetmask" value="<?php echo $firstNetmask; ?>">
				</div>
				<div class="form-group form-group-sm col-sm-3">
					<label class="col-form-label">Netmask Final (ejem: 30):</label>
                    <div class="help-tip">
                        <p>La diferencia entre Netmask Final e Inicial es el número exponente que eleva a 2 dando como resultado las subredes a conseguir. Ejem: 2<sup>5</sup> = 32 subredes.</p>
                    </div>
					<input type="number" required id="finalNetmask" name="finalNetmask"
                           value="<?php echo $finalNetmask; ?>" class="form-control" step="1" max="30">
				</div>
			</div>

			<div class="text-center">
				<button type="submit" name="calculate_button"  id="calculate_button" data-toggle="tooltip"
                        data-placement="top" title="Enlista las subredes disponibles" class="btn btn-primary">Calcular</button>
				<button type="submit" name="clean_button" data-toggle="tooltip"
                        data-placement="top" title="Vacía la aplicación" class="btn btn-success">Limpiar</button>
			</div>
			
		</form>
        <br>
	</article>

    <!--Calculo de Resultados-->
    <?php 
       if(isset($_POST['calculate_button']))
      {
         if($firstNetmask!="No soportado")
          {
              
            $firstBitsHost=32-$firstNetmask;
            $firstIpNumber= pow(2,$firstBitsHost);

            $finalBitsHost=32-$finalNetmask;
            $finalIpNumber= pow(2,$finalBitsHost);

            $subnettingNumber=$firstIpNumber/$finalIpNumber;
            $subnettingSize=$firstIpNumber/$subnettingNumber;
    ?>
              <article class="jumbotron" style="background-color: white; width: 80%;margin-left: auto;margin-right: auto; padding-top: 0; padding-bottom: 0;">

              <table class="table table-sm">
                  <thead  class="thead-dark">
                  <tr>
                      <th scope="col">#</th>
                      <th scope="col">Subredes  <?php echo "/ $finalNetmask"?></th>
                      <th scope="col">Host Mínimo</th>
                      <th scope="col">Host Máximo</th>
                      <th scope="col">Broadcast</th>
                      <th scope="col">Total</th>
                  </tr>
                </thead>
            <tbody>
    <?php
        //Inicializo las variables
            $subnettingAux1=0;
            $subnettingAux2=0;
            $subnettingAux3=0;
            $subnettingAux4=0;

            $subnetting1=0;
            $subnetting2=0;
            $subnetting3=0;
            $subnetting4=0;

            $firstIpAux1=0;
            $firstIpAux2=0;
            $firstIpAux3=0;
            $firstIpAux4=0;
                 
            $finishIpAux1=0;
            $finishIpAux2=0;
            $finishIpAux3=0;
            $finishIpAux4=0;

            $broadcastAux1=0;
            $broadcastAux2=0;
            $broadcastAux3=0;
            $broadcastAux4=0;

            $total=1;//variable que dice cuántas redes hay
            $vali=0;

            $octetos=(explode(".",$ipAdress));

            for($i=1;$i<=$subnettingNumber;$i++){

                $subnettingAux4+=$subnettingSize;
                if($subnettingAux4>255){
                    $val=$subnettingAux4/256;
                    $subnettingAux3+=round($val, 0, PHP_ROUND_HALF_DOWN);
                    $subnettingAux4=0;
                }
                if($subnettingAux3>255){
                    $val=$subnettingAux3/256;
                    $subnettingAux2+=round($val, 0, PHP_ROUND_HALF_DOWN);
                    $subnettingAux3=0;
                    $subnettingAux4=0;
                }

            // Calculo de Broadcast
                $broadcastAux1=$subnettingAux1;
                $broadcastAux2=$subnettingAux2;
                $broadcastAux3=$subnettingAux3;
                $broadcastAux4=$subnettingAux4-1;
                if($subnettingAux4==0){
                    if($subnettingAux3==0){
                        $broadcastAux2=$subnettingAux2-1;
                        $broadcastAux3=255;
                        $broadcastAux4=255;
                    }else{
                        $broadcastAux3=$subnettingAux3-1;
                        $broadcastAux4=255;
                    }
                   
                }
                
                    // Calculo de IpFinal
                    $finishIpAux1=$broadcastAux1;
                    $finishIpAux2=$broadcastAux2;
                    $finishIpAux3=$broadcastAux3;
                    $finishIpAux4=$broadcastAux4-1;
                  
                    $firstIpAux1=$subnetting1;
                    $firstIpAux2=$subnetting2;
                    $firstIpAux3=$subnetting3;
                    $firstIpAux4=$subnetting4+1;
                    
                    if($tipo=="Clase A"){
                        if($vali==0)
                            $total=(($finishIpAux2+1)*($finishIpAux3+1)*($finishIpAux4+2))-2;
                        $vali++;
                        echo "<tr><th scope='col'>$i</th>
                               <td> $octetos[0] . $subnetting2 . $subnetting3 . $subnetting4</td>
                               <td> $octetos[0] . $firstIpAux2 . $firstIpAux3 . $firstIpAux4</td>
                               <td> $octetos[0] . $finishIpAux2 . $finishIpAux3 . $finishIpAux4</td>
                               <td> $octetos[0] . $broadcastAux2 . $broadcastAux3 . $broadcastAux4</td>
                               <td> <strong>$total</strong> </td></tr>";
                    }elseif($tipo=="Clase B"){
                        if($vali==0)
                            $total=(($finishIpAux3+1)*($finishIpAux4+2))-2;
                        $vali++;
                        echo "<tr><th scope='col'>$i</th>
                               <td> $octetos[0] . $octetos[1] . $subnetting3 . $subnetting4</td>
                               <td> $octetos[0] . $octetos[1] . $firstIpAux3 . $firstIpAux4</td>
                               <td> $octetos[0] . $octetos[1] . $finishIpAux3 . $finishIpAux4</td>
                               <td> $octetos[0] . $octetos[1] . $broadcastAux3 . $broadcastAux4</td>
                               <td> <strong>$total</strong> </td></tr>";
                    }elseif($tipo=="Clase C"){
                        if($vali==0)
                            $total=(($finishIpAux4+2))-2;
                        $vali++;
                        echo "<tr><th scope='col'>$i</th>
                               <td> $octetos[0] . $octetos[1] . $octetos[2] . $subnetting4</td>
                               <td> $octetos[0] . $octetos[1] . $octetos[2] . $firstIpAux4</td>
                               <td> $octetos[0] . $octetos[1] . $octetos[2] . $finishIpAux4</td>
                               <td> $octetos[0] . $octetos[1] . $octetos[2] . $broadcastAux4</td>
                               <td> <strong>$total</strong> </td></tr>";
                    }else{

                    }
                    $subnetting1=$subnettingAux1;
                    $subnetting2=$subnettingAux2;
                    $subnetting3=$subnettingAux3;
                    $subnetting4=$subnettingAux4;
                }   
                ?>
                </tbody>
                </table>
    </article>
    <?php
          }else
            echo "no se puede calcular";
      }
    ?>

    <footer>
        <article class="jumbotron" style="background-color: #0747a6; width: 100%; padding: 1rem;margin: 0;">
            <h6 style="color: white; width: 40%;margin-left: auto; margin-right: auto;text-align: center;">Hecho con 🍚 por <a href="https://github.com/huasipango">Anthony Cabrera</a> y <a href="https://github.com/shoniisra">Johnny Villacís</a>.</h6>
        </article>
    </footer>

    <!--Validacion de Formulario-->
    <script src="js/main.js" type="application/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>