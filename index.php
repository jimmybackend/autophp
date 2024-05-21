<!DOCTYPE html>

<html lang="en">

<head>

<!-- basic -->

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- mobile metas -->

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="viewport" content="initial-scale=1, maximum-scale=1">

<!-- site metas -->

<title>Indice - Automatas</title>

	<meta name="keywords" content="" />

		<meta name="description: automata finito con Clases y Objetos" content="">

        <meta name="author: Jimmy Villatoro" content="jimmyvillatoro77@gmail.com">

<style>

    .div-1 {

        background-color: #EBEBEB;

    }

    

    .div-2 {

      background-color: #ABBAEA;

    }

    

    .div-3 {

      background-color: #FBD603;

    }

    

     #products-table

{

     width: 200px;

    height: 400px;

    overflow:scroll;

}

</style>



</head>

<body>





<!-- CLASS BEGIN-->

<?php

$C        =$_GET['C'];

if($C==1){

?>





<!--BEGIN-->

<div> 

<?php

$tabla     =$_GET['tabla'];

$id        =$_GET['id'];

$tabla2    =$_GET['tabla2'];

$idt       =$_GET['idt'];

$campo     =$_GET['campo'];



include ('dbclass2.php');

$dev = new DevC();

$dev->host=$_GET['server'];

$dev->user=$_GET['user'];

$dev->password=$_GET['pass'];

$dev->database=$_GET['db'];





?>

</div>

<!-- END-->



<!-- ADD BEGIN-->

<div> 

<?php

$tabla       =$_GET['tabla'];

$tabla2      =$_GET['tabla2'];

$id          =$_GET['id'];

$idt          =$_GET['idt'];

$ADD         =$_GET['ADD'];

if($ADD==1){

$data=array();

$data[0]=$_REQUEST['Empresa'];

$data[1]=$_REQUEST['Nombres'];

$data[2]=$_REQUEST['Apellidos'];

$data[3]=$_REQUEST['Direccion'];

$data[4]=$_REQUEST['Rfc'];

$data[5]=$_REQUEST['Movil'];

$data[6]=$_REQUEST['Correo'];

$data[7]=$_REQUEST['Pass'];

$data[8]=$_REQUEST['Foto'];

$data[9]=$_REQUEST['Fecha'];

$data[10]=$_REQUEST['Estado'];

$data[11]=$_REQUEST['Tipo'];

$data[12]=$_REQUEST['Ident2'];



  $dev->INSERT($tabla, $id, $data);

  $dev->INSERT3($tabla, $id);

  $dev->INSERT4($tabla, $id, $tabla2, $idt);



}



?>

</div>

<!-- ADD END-->



<!-- UPD BEGIN-->

<div> 

<?php

$tabla       =$_GET['tabla'];

$tabla2      =$_GET['tabla2'];

$id          =$_GET['id'];

$dato          =2;

$UPD         =$_GET['UPD'];

if($UPD==1){

$data=array();

$data[0]=$_REQUEST['Empresa'];

$data[1]=$_REQUEST['Nombres'];

$data[2]=$_REQUEST['Apellidos'];

$data[3]=$_REQUEST['Direccion'];

$data[4]=$_REQUEST['Rfc'];

$data[5]=$_REQUEST['Movil'];

$data[6]=$_REQUEST['Correo'];

$data[7]=$_REQUEST['Pass'];

$data[8]=$_REQUEST['Foto'];

$data[9]=$_REQUEST['Fecha'];

$data[10]=$_REQUEST['Estado'];

$data[11]=$_REQUEST['Tipo'];

$data[12]=$_REQUEST['Ident2'];



   $dev->UPDATE($tabla, $id, $data);

   $dev->UPDATE3($tabla, $id);

   $dev->UPDATE4($tabla, $id, $tabla2, $dato);



}

?>

</div>

<!-- UPD END-->





<!-- DELETE BEGIN-->

<div> 

<?php

$tabla       =$_GET['tabla'];

$id          =$_GET['id'];

$dato        =$_GET['dato'];

$DEL         =$_GET['DEL'];

if($DEL==1){



  $dev->DELETE($tabla, $id, $dato);

 // $dev->DELETE3($tabla, $id, $dato);

  $dev->DELETE4($tabla, $id, $dato);

}

?>

</div>

<!-- DELETE END-->



<!-- SELECT BEGIN-->

<div> 

<?php

$tabla       =$_GET['tabla'];

$id          =$_GET['id'];

$SEL      =$_GET['SEL'];

if($SEL==1){



  $dev->SELECT($tabla, $id);

 // $dev->SELECT3($tabla, $id);

  $dev->SELECT4($tabla, $id);

  $dev->SELECT5($tabla, $id);

  $dev->SELECT6($tabla, $id);



}

?>

</div>

<!-- SELECT END-->



<!-- SEARCH BEGIN-->

<div> 

<?php

$tabla       =$_GET['tabla'];

$id          =$_GET['id'];

$dato        =$_GET['dato'];

$SEA         =$_GET['SEA'];

if($SEA==1){



  $dev->SEARCH($tabla, $id, $dato);

 // $dev->SEARCH3($tabla, $id, $dato);

  $dev->SEARCH4($tabla, $id, $dato);

}

?>

</div>

<!-- SEARCH END-->



<?php

$tabla       =$_GET['tabla'];

$dev->CLASE($tabla);

$dev->COPY($tabla);



function agregar_zip2($dir, $zip) {

   

  if (is_dir($dir)) {

   if ($da = opendir($dir)) {

     while (($archivo = readdir($da)) !== false) {

       if (is_dir($dir . $archivo) && $archivo != "." && $archivo != "..") {

          echo "<strong>Creando directorio: $dir$archivo</strong><br/>";

          agregar_zip2($dir . $archivo . "/", $zip);

         } elseif (is_file($dir . $archivo) && $archivo != "." && $archivo != "..") {

          echo "Agregando archivo: $dir$archivo <br/>";

          $zip->addFile($dir . $archivo, $dir . $archivo);

        }

      }

      closedir($da);

    }

  }

}



$tabla       =$_GET['tabla'];

$dir = "php2/".$tabla."/";

$zip = new ZipArchive();

$rutaFinal = "php2/";

 

if(!file_exists($rutaFinal)){

  mkdir($rutaFinal);

}

 

$archivoZip = $tabla."CLASS.zip";

 

if ($zip->open($archivoZip, ZIPARCHIVE::CREATE) === true) {

  agregar_zip2($dir, $zip);

  $zip->close();



  rename($archivoZip, "$rutaFinal/$archivoZip");



  if (file_exists($rutaFinal. "/" . $archivoZip)) {

    echo "Proceso Finalizado!! <br/><br/>

                Descargar: <a href='$rutaFinal/$archivoZip'>$archivoZip</a>";

  } else {

    echo "Error, archivo zip no ha sido creado!!";

  }

}







}

?>

<!-- CLASS END-->













<!-- EXTRUCT BEGIN-->

<?php

$E        =$_GET['E'];

if($E==1){

   

  $servidor  =$_GET['server']; 

  $usuario   =$_GET['user'];

  $clave     =$_GET['pass'];

  $basedatos =$_GET['db'];

  $tabla     =$_GET['tabla'];

  $usu1      =$_GET['id'];

  $tabla2    =$_GET['tabla2'];

  $idt       =$_GET['idt'];

  $campo     =$_GET['campo'];

  





include ('dbclass.php');

$dev0 = new DevE();



if(strlen($tabla)>0){

  $dev0->add($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $idt);

  $dev0->upd($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $idt);

  $dev0->del($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $idt);

  $dev0->select($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $idt);

  $dev0->search($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $idt);

  $dev0->copiar($tabla);

 

  

  

  function agregar_zip($dir, $zip) {

   

    if (is_dir($dir)) {

     if ($da = opendir($dir)) {

       while (($archivo = readdir($da)) !== false) {

         if (is_dir($dir . $archivo) && $archivo != "." && $archivo != "..") {

            echo "<strong>Creando directorio: $dir$archivo</strong><br/>";

            agregar_zip($dir . $archivo . "/", $zip);

           } elseif (is_file($dir . $archivo) && $archivo != "." && $archivo != "..") {

            echo "Agregando archivo: $dir$archivo <br/>";

            $zip->addFile($dir . $archivo, $dir . $archivo);

          }

        }

        closedir($da);

      }

    }

  }

  

  $dir = "php/".$tabla."/";

  $zip = new ZipArchive();

  $rutaFinal = "php/";

   

  if(!file_exists($rutaFinal)){

    mkdir($rutaFinal);

  }

   

  $archivoZip = $tabla."EXTRUCT.zip";

   

  if ($zip->open($archivoZip, ZIPARCHIVE::CREATE) === true) {

    agregar_zip($dir, $zip);

    $zip->close();

  

    rename($archivoZip, "$rutaFinal/$archivoZip");

  

    if (file_exists($rutaFinal. "/" . $archivoZip)) {

      echo "Proceso Finalizado!! <br/><br/>

                  Descargar: <a href='$rutaFinal/$archivoZip'>$archivoZip</a>";

    } else {

      echo "Error, archivo zip no ha sido creado!!";

    }

  }

  

  }





?>



<?php

}

?>

<!-- EXTRUCT END-->

<?php
/*
include "db.php";

$resultado=mysqli_query($db_connection, "describe peoples " );
while ($row =mysqli_fetch_array($resultado))
{ 
echo $IdD=$row['Field'].' ';
echo $IdD=$row['Type'].' ';
echo $IdD=$row['Null'].' ';
echo $IdD=$row['Key'].' ';
echo $IdD=$row['Default'].' ';
echo $IdD=$row['Extra'].' ';
}
mysqli_free_result($resultado);
*/
?>



<!-- INDEX BEGIN-->

<div class="div-2" style="width:300px; height:470px; overflow:auto;">

<h2>Auto-php</h2>

<form action="index.php" method="GET">
  
<div><input type="text" name="server" placeholder="Servidor" value="0.0.0.0"  required></div>
<div><input type="text" name="user" placeholder="Usuario" value="root"  required></div>
<div><input type="password" name="pass" placeholder="Password" value="root"  required></div>

<div class="row mt-1" >
<div class="col">Database: 
<SELECT NAME="db" SIZE=1 onchange = "this.form.submit()"> 
<OPTION VALUE="0">Choose an database</OPTION>
<?php
include "db.php";
$selCombo1= utf8_decode($_GET['db']);
$resulta=mysqli_query($db_connection, "Show databases");
while ($row =mysqli_fetch_array($resulta))
{ 
 $Db=$row['Database'];
?>
<OPTION VALUE="<?php echo $Db; ?>"> <?php echo $Db; ?> </OPTION>
<?php
}
if(strlen($selCombo1) > 0){
 ?>
<OPTION SELECTED ="selected" VALUE="<?php echo $selCombo1; ?>"> <?php  echo $selCombo1; ?> </OPTION>
<?php
}
mysqli_free_result($resulta);
mysqli_close($db_connection);
 ?>
</SELECT>  
</div>
</div>


<div class="row mt-1" >
<div class="col">Table: 
<SELECT NAME="tabla" SIZE=1 onchange = "this.form.submit()"> 
<OPTION VALUE="0">Choose an table</OPTION>
<?php
include "db.php";
$selCombo1= utf8_decode($_GET['db']);
$selCombo2= utf8_decode($_GET['tabla']);
$resultado=mysqli_query($db_connection, "Show tables " );
while ($row =mysqli_fetch_array($resultado))
{ 
$Tb=$row['Tables_in_'.$selCombo1.''];
?>
<OPTION VALUE="<?php echo $Tb; ?>"> <?php echo $Tb; ?> </OPTION>
<?php
}
if(strlen($selCombo2) > 0){
 ?>
<OPTION SELECTED ="selected" VALUE="<?php echo $selCombo2; ?>"> <?php  echo $selCombo2; ?> </OPTION>
<?php
}
mysqli_free_result($resulta);
mysqli_close($db_connection);
 ?>
</SELECT>  
</div>
</div>


<div class="row mt-1" >
<div class="col">Primary key: 
<SELECT NAME="id" SIZE=1 onchange = "this.form.submit()"> 
<?php
include "db.php";
$selCombo1= utf8_decode($_GET['db']);
$selCombo2= utf8_decode($_GET['tabla']);
$selCombo3= utf8_decode($_GET['id']);
$resultado=mysqli_query($db_connection, "describe ".$selCombo2." " );
while ($row =mysqli_fetch_array($resultado))
{ 
if($row['Key']=='PRI')
$Pri=$row['Field'];
}
?>
<OPTION VALUE="<?php echo $Pri; ?>"> <?php echo $Pri; ?> </OPTION>
<?php

if(strlen($selCombo3) > 0){
 ?>
<OPTION SELECTED ="selected" VALUE="<?php echo $selCombo3; ?>"> <?php  echo $selCombo3; ?> </OPTION>
<?php
}
mysqli_free_result($resulta);
mysqli_close($db_connection);
 ?>
</SELECT>  
</div>
</div>

<div class="row mt-1" >
<div class="col">Master table: 
<SELECT NAME="tabla2" SIZE=1 onchange = "this.form.submit()"> 
<OPTION VALUE="0">Choose an master table</OPTION>
<?php
include "db.php";
$selCombo1= utf8_decode($_GET['db']);
$selCombo4= utf8_decode($_GET['tabla2']);
$resultado=mysqli_query($db_connection, "Show tables " );
while ($row =mysqli_fetch_array($resultado))
{ 
$Tb=$row['Tables_in_'.$selCombo1.''];
?>
<OPTION VALUE="<?php echo $Tb; ?>"> <?php echo $Tb; ?> </OPTION>
<?php
}
if(strlen($selCombo4) > 0){
 ?>
<OPTION SELECTED ="selected" VALUE="<?php echo $selCombo4; ?>"> <?php  echo $selCombo4; ?> </OPTION>
<?php
}
mysqli_free_result($resulta);
mysqli_close($db_connection);
 ?>
</SELECT>  
</div>
</div>

<div class="row mt-1" >
<div class="col">Primary key: 
<SELECT NAME="idt" SIZE=1 onchange = "this.form.submit()"> 
<?php
include "db.php";
$selCombo4= utf8_decode($_GET['tabla2']);
$selCombo5= utf8_decode($_GET['idt']);
$resultado=mysqli_query($db_connection, "describe ".$selCombo4." " );
while ($row =mysqli_fetch_array($resultado))
{ 
if($row['Key']=='PRI')
$Prim=$row['Field'];
}
?>
<OPTION VALUE="<?php echo $Prim; ?>"> <?php echo $Prim; ?> </OPTION>
<?php

if(strlen($selCombo5) > 0){
 ?>
<OPTION SELECTED ="selected" VALUE="<?php echo $selCombo5; ?>"> <?php  echo $selCombo5; ?> </OPTION>
<?php
}
mysqli_free_result($resulta);
mysqli_close($db_connection);
 ?>
</SELECT>  
</div>
</div>

<div class="row mt-1" >
<div class="col">Search row: 
<SELECT NAME="campo" SIZE=1 onchange = "this.form.submit()"> 
<OPTION VALUE="0">Choose an row</OPTION>
<?php
include "db.php";
$selCombo4= utf8_decode($_GET['tabla2']);
$selCombo6= utf8_decode($_GET['campo']);
$resultado=mysqli_query($db_connection, "describe ".$selCombo4." " );
while ($row =mysqli_fetch_array($resultado))
{ 
$Pri=$row['Field'];

?>
<OPTION VALUE="<?php echo $Pri; ?>"> <?php echo $Pri; ?> </OPTION>
<?php
}
if(strlen($selCombo6) > 0){
 ?>
<OPTION SELECTED ="selected" VALUE="<?php echo $selCombo6; ?>"> <?php  echo $selCombo6; ?> </OPTION>
<?php
}
mysqli_free_result($resulta);
mysqli_close($db_connection);
 ?>
</SELECT>  
</div>
</div>
<div><input type="text" name="dato" placeholder="Dato" value="1" ></div>



<label><input type="checkbox" name="E" value="1"> EXTRUCT</label>

<label><input type="checkbox" name="C" value="1"> CLASS</label><br>



<label><input type="checkbox" name="ADD" value="1">INSERT</label><br>

<label><input type="checkbox" name="UPD" value="1">UPDATE</label><br>

<label><input type="checkbox" name="DEL" value="1">DELETE</label><br>

<label><input type="checkbox" name="SEL" value="1">SELECT</label><br>

<label><input type="checkbox" name="SEA" value="1">SEARCH</label><br>





<div><button type="submit" class="btn btn-success">Just Do it</button>

</form>

</div>

</div>

<div class="div-3" style="width:300px; height:340px; overflow:auto;">



<h2>Desarrolladores</h2>



<p><strong>Licencia</strong> <a href="LICENSE">licencia</a></p>

<p><strong>Leeme</strong> <a href="README.md">leeme</a></p>

<p><strong>SQL</strong> <a href="auto-php.sql">Comandos Mysql</a></p>

<p><strong>INF</strong><a href="Auto-php.pdf">Auto-php pdf</a></p>

<p><strong>EXTRUCT</strong> <a href="php/visitEXTRUCT.zip">visitEXTRUCT</a></p>

<p><strong>CLASS</strong> <a href="php2/visitCLASS.zip">visitEXTRUCT</a></p>



<div id="footer" style="text-align: center; font-size: 0.75em;"> <p>copyright &copy; 2022 jimmyvillatoro77@gmail.com</p></div>

<div style="text-align: center; font-size: 0.75em;">Diseño de <a href="http://www.desarrollawebs.com/">;]</a></div>

</div>

</body>

<!-- INDEX END-->

</html>

