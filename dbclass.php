<?php 
//autor Jimmyvillatoro
//05 agosto
class DevE{

function fh(){
date_default_timezone_set("America/Mexico_City"); $script_tz = date_default_timezone_get();
$date = date("Y-m-d"); 
$time = date("H:i:s", time());
$dt= $date." ". $time;
return $dt;
}

//add
public function add($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $Idt ){

$txt=$tabla;
$txt2=$tabla2;
$bus=$campo;

$db_connection = mysqli_connect($servidor, $usuario, $clave, $basedatos) or die(mysql_error());
if (!$db_connection) {
  die("Se ha podido conectar a la base de datos");
}else
  echo mysqli_connect_error($db_connection);

$inicio="<?php 
include 'db.php';";
$fecha= ' date_default_timezone_set("America/Mexico_City"); $script_tz = date_default_timezone_get(); $date = date("Y-m-d"); $time = date("H:i:s", time()); $dt= $date." ". $time; ';
$condicion='if (mysqli_num_rows($resultado)>0) {';
$go1=' header("Location: index.php"); ';
$cierrecondicion='} else {  ';
$insert='$insert_value ="'.$sql.'";';
$retry='$retry_value = mysqli_query($db_connection,$insert_value);}';
$go2=' header("Location: index.php");';
$free='mysqli_free_result($retry_value);';
$free2='mysqli_free_result($resultado);';
$close= 'mysqli_close($db_connection);';
$fin="?>";
$cabeza='<?php
session_start(); 
?>
<html>
<head>
<title>'.$txt.'add</title>
<script src="dat/js/jquery-3.6.0.min.js"></script>
<style>
.ocultar {
    display: none;
}
.mostrar {
    display: block;
}
</style> 
<script>
function verificarPasswords() {
    pass1 = document.getElementById("pass1");
    pass2 = document.getElementById("pass2");
    if (pass1.value != pass2.value) {
        document.getElementById("error").classList.add("mostrar");
         return false;
    } else {
         document.getElementById("error").classList.remove("mostrar");
         document.getElementById("ok").classList.remove("ocultar");
         document.getElementById("login").disabled = true;
        setTimeout(function() {
            location.reload();
        }, 3000);
        return true;
    }
}
</script> 
 ';
$body='</head>
<body>
 '; 
$regresar='<a href="index.php?<?php echo $'.$usu1.'; ?>">Back</a>';
$cola='
<p>© jimmyvillatoro77@gmail.com</p>
</body>
</html>
 ';
 
$dir = "php/".$txt."/";
if (!file_exists($dir)) 
mkdir($dir, 0777, true);

//------------add 
 
//echo  'Archivo : '.$txt.'add.php listo';
   
$archivo = fopen($dir.$txt."add.php","w+b");
if( $archivo == false ) {
echo "Error al crear el archivo";
    }
    else
    {
      
$consulta = "SELECT * FROM ".$txt;
$resultado=mysqli_query($db_connection, $consulta);
$info_campo = mysqli_fetch_fields($resultado);
$fila = mysqli_fetch_array($resultado);
$field_cnt = $resultado->field_count;
     
 
$sql = "INSERT INTO ".$txt."(";   

foreach ($info_campo as $valor) {
if( $valor->flags==49667){
$primary=$valor->name;
$ban=1;
}
if($valor->flags==53257 && $ban==2){
$terciary=$valor->name;
$ban=3;}
if($valor->flags==53257){
$secundary=$valor->name;
$ban=2;}

if( $valor->flags!=49667){
$cadena1.=$valor->name.", ";
if($ban==1){
 $bus=$valor->name;
 $ban=4;
}
}
   }

if(strlen($secundary)<=0)
$secundary=$primary;
if(strlen($terciary)<=0)
$terciary=$secundary;     
      
fwrite($archivo, $inicio." \r\n");   
$request="
/*
$"."$primary = $"."_REQUEST['$primary'];
$"."$secundary = $"."_REQUEST['$secundary'];
*/
";
fwrite($archivo, $request." \r\n");   
       //REQUEST
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."= $"."_REQUEST['".$valor->name."'];";
     fwrite($archivo,$recibe."\r\n");
   }
fwrite($archivo, $fecha."\r\n");

$result='$resultado=mysqli_query($db_connection, "'.$consulta.' WHERE '.$bus.' LIKE '.$c.'".$'.$bus.'."'.$c.'" ); ';
fwrite($archivo, $result."\r\n");
fwrite($archivo, $condicion."\r\n");
fwrite($archivo, $go1."\r\n");
fwrite($archivo, $cierrecondicion."\r\n");

//---------- INSERT
$cadena2="";
$myString = substr($cadena1, 0, -2);
  $sql.= $myString.")";
  $c="'";
  $p=".";
  $s="$";
  $sql.=" VALUES (";
foreach ($info_campo as $valor) {
if( $valor->flags!=49667)
$cadena2.=' '.$c.'"'.$p.'$'.$valor->name.$p.'"'.$c.', ';
   } 
   $myString = substr($cadena2, 0, -2);
   $sql.=$myString.")";
   $insert_value =$sql;
   
$insert='$insert_value ="'.$sql.'";';
//---------- INSERT
fwrite($archivo,$insert."\r\n");
fwrite($archivo,"\r\n");
fwrite($archivo, $retry."\r\n");
$result2='$resultado=mysqli_query($db_connection, "SELECT '.$primary.'  FROM  '.$txt.'  WHERE '.$bus.' = '.$c.'".$'.$bus.'."'.$c.'" ); ';
fwrite($archivo, $result2."\r\n");
$while=' while ($row =mysqli_fetch_array($resultado))   
$'.$primary.' =$row['.$c.$primary.$c.']; ';
fwrite($archivo, $while."\r\n");
fwrite($archivo, $go2."\r\n");
fwrite($archivo, $free."\r\n");
fwrite($archivo,$free2."\r\n");
fwrite($archivo,$close."\r\n");
fwrite($archivo,$fin);

fflush($archivo);
fclose($archivo);
}
//----------------add2
//echo  'Archivo : '.$txt.'add2.php listo';
   
    $archivo = fopen($dir.$txt."add2.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {
fwrite($archivo, $cabeza." \r\n");
fwrite($archivo, $inicio." \r\n");  

$get="
/*
$"."$primary = utf8_decode($"."_GET['$primary']); 
$"."$secundary = utf8_decode($"."_GET['$secundary']);

if($"."_SESSION['$usu1']!=$"."$usu1)
{
 echo '<a href='index.php' title='Login' class='round'>Login</a>';
  exit;
}*/
";
fwrite($archivo, $get." \r\n");
fwrite($archivo,$fin);
fwrite($archivo, $body." \r\n");
fwrite($archivo, '
<div> <h2>'.$txt.'</h2> </div>'); 
fwrite($archivo, " \r\n");
if(strlen($txt2)>0){
fwrite($archivo, '
<form action="'.$txt.'add2.php" method="GET">
<div class="row mt-1" >
<div class="col">'.$txt2.': 
<SELECT NAME="selCombo1" SIZE=1 onchange = "this.form.submit()"> 
<OPTION VALUE="0">Choose an option</OPTION>
<?php
include "db.php";
$selCombo1= utf8_decode($_GET['.$c.'selCombo1'.$c.']);
$resulta=mysqli_query($db_connection, "SELECT '.$Idt.', '.$campo.' FROM  '.$txt2.' ");
if (mysqli_num_rows($resulta)>0)
{			  
while ($row =mysqli_fetch_array($resulta))  { 
$'.$Idt.' =$row['.$c.$Idt.$c.'];
$'.$campo.' =$row['.$c.$campo.$c.'];
?>
<OPTION VALUE="<?php echo $'.$Idt.'; ?>"> <?php echo $'.$campo.'; ?> </OPTION>
<?php
}
if (!$resulta) 
   die("Error: " . mysqli_error());
}
if(strlen($selCombo1) > 0){
$resulta=mysqli_query($db_connection, "SELECT '.$Idt.', '.$campo.'  FROM  '.$txt2.'  WHERE '.$Idt.' = '.$c.'".$selCombo1."'.$c.'" );
if (mysqli_num_rows($resulta)>0)
      while ($row =mysqli_fetch_array($resulta))  { 
$'.$Idt.' =$row['.$c.$Idt.$c.'];
$'.$campo.' =$row['.$c.$campo.$c.'];
 ?>
<OPTION SELECTED ="selected" VALUE="<?php echo $'.$Idt.'; ?>"> <?php  echo $'.$campo.'; ?> </OPTION>
<?php
      }
}
mysqli_free_result($resulta);
mysqli_close($db_connection);
 ?>
</SELECT>  
</div>
</div>
</form>
 ');
}

fwrite($archivo, " \r\n");
fwrite($archivo, '
<div>
<div>
<h1>REGISTRATION HERE</h1>
<form action="'.$txt.'add.php" method="POST">');
$s="$";
fwrite($archivo, " \r\n");

foreach ($info_campo as $valor) {

    echo "Nombre: ", $valor->name." ";
    echo "Tabla: ", $valor->table." ";
    echo "Longitud máx.: ", $valor->max_length." ";
    echo "Banderas: ", $valor->flags." ";
    echo "Tipo: ", $valor->type." ";
    echo "<br>";
if( $valor->flags==53257 && strlen($tabla2)>0 )
  fwrite($archivo, "
  <input type='hidden' name='".$valor->name."'   value='<?php echo utf8_decode(".$s."_GET['selCombo1']); ?>' >   \r\n");

if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24
if( $valor->flags!=49667 && $valor->flags!=53257)//primary o index
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='number' name='".$valor->name."'   placeholder='".$valor->name."'  required>   \r\n");
  
if($valor->type == 0  || $valor->type == 4 || $valor->type == 5 || $valor->type == 6 || $valor->type == 246 )//DECIMALES 
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='TEXT' name='".$valor->name."' placeholder='".$valor->name."' required>   \r\n");

if($valor->type == 7)//fecha y hora
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='DATETIME' name='".$valor->name."'  placeholder='".$valor->name."'required> \r\n");
  
if($valor->type == 10)//fecha
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='date' name='".$valor->name."' placeholder='".$valor->name."' required>   \r\n");
 
if($valor->type == 11)//hora
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='time' name='".$valor->name."' placeholder='".$valor->name."' required>  \r\n");
 
if($valor->type == 12)//fecha y hora
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='datetime' name='".$valor->name."' placeholder='".$valor->name."' required>  \r\n");

if($valor->type==249 || $valor->type==250 || $valor->type==251 || $valor->type==252)//blob
  fwrite($archivo, "<p>".$valor->name."</p>
  <textarea id='".$valor->name."' name='".$valor->name."' rows='7' cols='60'> ".$valor->name." </textarea>   \r\n");
 
if($valor->type == 253 && $valor->name != "Pass")//cadena no Password
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='text' name='".$valor->name."'  placeholder='".$valor->name."' required>   \r\n");
  
if($valor->type == 254 && $valor->name != "Pass")//cadena no Password
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='text' name='".$valor->name."'  placeholder='".$valor->name."' required>  \r\n");

if($valor->name == "Pass")//campo password
{
 fwrite($archivo, '<p>Password</p>
<input type="password" name="Pass" placeholder="Password" id="pass1"  required>
 <p>Confirm Password</p>
<input type="password" name="pas2" placeholder="Confirm Password" id="pass2"   required>
<div id="msg"></div>
<!-- Mensajes de Verificación -->
<div id="error" class="alert alert-danger ocultar" role="alert">
    Passwords do not match, please try again !
</div>
<div id="ok" class="alert alert-success ocultar" role="alert">
   Passwords match! (Processing form ...)
</div>'); 
}
   }
   
fwrite($archivo, '
<input type="submit" name="" value="Login">          
</form> 
</div>
</div>');

fwrite($archivo,$regresar."\r\n");
fwrite($archivo,$cola."\r\n");

fflush($archivo);
fclose($archivo);

mysqli_free_result($resultado);
mysqli_close($db_connection);
}

}

//update

public function upd($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $Idt ){
  
$txt=$tabla;
$txt2=$tabla2;
$bus=$campo;

$db_connection = mysqli_connect($servidor, $usuario, $clave, $basedatos) or die(mysql_error());
if (!$db_connection) {
  die("Se ha podido conectar a la base de datos");
}else
  echo mysqli_connect_error($db_connection);


$inicio="<?php 
include 'db.php';";
$fecha= ' date_default_timezone_set("America/Mexico_City"); $script_tz = date_default_timezone_get(); $date = date("Y-m-d"); $time = date("H:i:s", time()); $dt= $date." ". $time; ';
$condicion='if (mysqli_num_rows($resultado)>0) {';
$go1=' header("Location: index.php"); ';
$cierrecondicion='} else {  ';
$update='$update_value = "'.$sql2.' ';
$retry2='$retry_value = mysqli_query($db_connection,$update_value);';
$go2=' header("Location: index.php");';
$free='mysqli_free_result($retry_value);';
$free2='mysqli_free_result($resultado);';
$close= 'mysqli_close($db_connection);';
$fin="?>
";
$cabeza='<?php
session_start(); 
?>
<html>
<head>
<title>'.$txt.'upd</title>
<script src="dat/js/jquery-3.6.0.min.js"></script>
<style>
.ocultar {
    display: none;
}
.mostrar {
    display: block;
}
</style> 
<script>
function verificarPasswords() {
    pass1 = document.getElementById("pass1");
    pass2 = document.getElementById("pass2");
    if (pass1.value != pass2.value) {
        document.getElementById("error").classList.add("mostrar");
         return false;
    } else {
         document.getElementById("error").classList.remove("mostrar");
         document.getElementById("ok").classList.remove("ocultar");
         document.getElementById("login").disabled = true;
        setTimeout(function() {
            location.reload();
        }, 3000);
        return true;
    }
}
</script> 
 ';
$script='
<script src="dat/js/jquery-3.6.0.min.js"></script>
<script language=JavaScript>
$(document).ready(function(){
         $("#txtbusca").keyup(function(){
              var parametros="txtbusca="+$(this).val()
              $.ajax({
                    data:  parametros,
                  url:   "'.$txt.'ser3.php",
                  type:  "post",
                    beforeSend: function () { },
                    success:  function (response) {                 
                        $(".salida").html(response);
                  },
                  error:function(){
                       alert("funcion error")
                    }
               });
         })
})
</script>
';
$body='</head>
<body>
 '; 
$regresar='<a href="index.php?<?php echo $'.$usu1.'; ?>">Back</a>';
$cola='
<p>© jimmyvillatoro77@gmail.com</p>
</body>
</html>
 ';
 

$dir = "php/".$txt."/";
if (!file_exists($dir)) 
mkdir($dir, 0777, true);


//-------------------upd 

//echo  'Archivo : '.$txt.'upd.php listo';
   
    $archivo = fopen($dir.$txt."upd.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {
$consulta = "SELECT * FROM ".$txt;
$resultado=mysqli_query($db_connection, $consulta);
$info_campo = mysqli_fetch_fields($resultado);
$fila = mysqli_fetch_array($resultado);
$field_cnt = $resultado->field_count;

$sql = "INSERT INTO ".$txt."(";   

foreach ($info_campo as $valor) {

if( $valor->flags==49667){
$primary=$valor->name;
$ban=1;
}
if($valor->flags==53257 && $ban==2){
$terciary=$valor->name;
$ban=3;}
if($valor->flags==53257){
$secundary=$valor->name;
$ban=2;}

if( $valor->flags!=49667){
$cadena1.=$valor->name.", ";
if($ban==1){
 $bus=$valor->name;
 $ban=4;
}
}
   }

if(strlen($secundary)<=0)
$secundary=$primary;
if(strlen($terciary)<=0)
$terciary=$secundary;

//UPDATE
$cadena2="";
  $c="'";
  $p=".";
  $s="$";
$sql2 = "UPDATE ".$txt." SET ";   
   foreach ($info_campo as $valor) {
if( $valor->flags!=49667)
      $cadena2.=$valor->name.'='.' '.$c.'"'.$p.'$'.$valor->name.$p.'"'.$c.', ';
   } 
  $myString = substr($cadena2, 0, -2);
  $sql2.= $myString." ";
  $sql2.='  WHERE   '.$primary.' = '.$c.'".$'.$primary.'."'.$c.'" ; ';


fwrite($archivo,$inicio." \r\n");
$request="
/*
$"."$primary = $"."_REQUEST['$primary'];
$"."$secundary = $"."_REQUEST['$secundary'];
*/
";

fwrite($archivo, $request." \r\n");    
  
       //REQUEST
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."= $"."_REQUEST['".$valor->name."'];";
     fwrite($archivo,$recibe."\r\n");
   } 

fwrite($archivo, $fecha." \r\n");
$result5='$resultado=mysqli_query($db_connection, "SELECT * FROM '.$txt.' WHERE '.$primary.' = '.$c.'".$'.$primary.'."'.$c.'" );';

fwrite($archivo, $result5." \r\n");
fwrite($archivo, $condicion."\r\n");

//---------UPDATE

$consulta = "SELECT * FROM ".$txt;
$resultado=mysqli_query($db_connection, $consulta);

$info_campo = mysqli_fetch_fields($resultado);
$fila = mysqli_fetch_array($resultado);
$field_cnt = $resultado->field_count;

$cadena2="";
$sql2 = "UPDATE ".$txt." SET ";   
foreach ($info_campo as $valor) {
if( $valor->flags!=49667)
      $cadena2.=$valor->name.'='.' '.$c.'"'.$p.'$'.$valor->name.$p.'"'.$c.', ';
   } 
$myString = substr($cadena2, 0, -2);
$sql2.= $myString." ";
$sql2.='  WHERE   '.$primary.' = '.$c.'".$'.$primary.'."'.$c.'" ; ';

$update='$update_value = "'.$sql2.' ';
//---------UPDATE

fwrite($archivo,$update."\r\n");	    
fwrite($archivo, $retry2."\r\n");

fwrite($archivo, $go1."\r\n");
fwrite($archivo, $free."\r\n");
fwrite($archivo, $cierrecondicion."\r\n");
fwrite($archivo, $go2."}\r\n");
fwrite($archivo,$free2."\r\n");
fwrite($archivo,$close."\r\n");
fwrite($archivo,$fin);

fflush($archivo);
fclose($archivo);
}


//----------------------upd3 

//echo  'Archivo : '.$txt.'upd3.php listo';
   
    $archivo = fopen($dir.$txt."upd3.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {
fwrite($archivo,$inicio." \r\n");
fwrite($archivo, $request." \r\n");    
  
       //REQUEST
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."= $"."_REQUEST['".$valor->name."'];";
     fwrite($archivo,$recibe."\r\n");
   } 

fwrite($archivo, $fecha." \r\n");
fwrite($archivo, $result5." \r\n");
fwrite($archivo, $condicion."\r\n");

//----------------------------UPDATE--------------------------------------------
fwrite($archivo,$update."\r\n");	    
fwrite($archivo, $retry2."\r\n");
//-----------------------------UPDATE-------------------------------------------
fwrite($archivo, $go1."\r\n");
fwrite($archivo, $free."\r\n");
fwrite($archivo, $cierrecondicion."\r\n");
fwrite($archivo, $go2."}\r\n");
fwrite($archivo,$free2."\r\n");
fwrite($archivo,$close."\r\n");
fwrite($archivo,$fin);

fflush($archivo);
fclose($archivo);
}

//-------------------upd2

//echo  'Archivo : '.$txt.'upd2.php listo';
   
    $archivo = fopen($dir.$txt."upd2.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {

fwrite($archivo, $cabeza." \r\n");
fwrite($archivo, "<?php
include 'db.php'; \r\n");
fwrite($archivo, "$"."$primary= utf8_decode($"."_GET['$primary']); \r\n");
fwrite($archivo, "$"."$secundary = utf8_decode($"."_GET['$secundary']); \r\n");
fwrite($archivo, '$resultado=mysqli_query($db_connection, "SELECT * FROM '.$txt.' WHERE '.$primary.' = '.$c.'".$'.$primary.'."'.$c.'" );');
fwrite($archivo, " \r\n");
fwrite($archivo, "while ($"."row =mysqli_fetch_array($"."resultado)) { ");
fwrite($archivo, " \r\n");
//Row
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."=$"."row['".$valor->name."'];";
     fwrite($archivo,$recibe."\r\n");
   } 
fwrite($archivo, " } \r\n");
fwrite($archivo, " mysqli_free_result($"."resultado);\r\n");
fwrite($archivo, "mysqli_close($"."db_connection); \r\n");
fwrite($archivo, "?> \r\n");
fwrite($archivo, $script." \r\n");
fwrite($archivo, $body." \r\n");
fwrite($archivo, '
<div> <h2>'.$txt.'</h2> </div>'); 
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo, '
<h1>busca por <strong class="cur">'.$bus.'</strong></h1>
<form action="'.$txt.'upd2.php" method="POST">');
fwrite($archivo, '
<div class="input-group mb-3">
          <input type="text" class="form-control" id="txtbusca" value="<?php echo  $'.$bus.'; ?>" aria-label="Search" aria-describedby="basic-addon2">
       <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2"></span>
        </div>
</div>
<div class="salida"></div></form>
 ');

if(strlen($txt2)>0){
fwrite($archivo, '
<h1>'.$txt2.'</h1>
<form action="'.$txt.'upd2.php" method="GET">

<input type="hidden" name="'.$primary.'" value="<?php echo utf8_decode($_GET['.$c.$primary.$c.']); ?>">

<div class="row mt-1" >
<div class="col">'.$txt2.': 
<SELECT NAME="selCombo1" SIZE=1 onchange = "this.form.submit()"> 
<OPTION VALUE="0"> Choose an option</OPTION>
<?php
include "db.php";

$selCombo1= utf8_decode($_GET['.$c.'selCombo1'.$c.']);
$resulta=mysqli_query($db_connection, "SELECT '.$Idt.', '.$campo.' FROM  '.$txt2.' ");
if (mysqli_num_rows($resulta)>0)
{			  
while ($row =mysqli_fetch_array($resulta))  { 
$'.$Idt.' =$row['.$c.$Idt.$c.'];
$'.$campo.' =$row['.$c.$campo.$c.'];
?>
<OPTION VALUE="<?php echo $'.$Idt.'; ?>"> <?php echo $'.$campo.'; ?> </OPTION>
<?php
      }
if (!$resulta) 
   die("Error: " . mysqli_error());
}
if(strlen($selCombo1) > 0){
$resulta=mysqli_query($db_connection, "SELECT '.$Idt.', '.$campo.'  FROM  '.$txt2.'  WHERE '.$Idt.' = '.$c.'".$selCombo1."'.$c.'" );
if (mysqli_num_rows($resulta)>0)
      while ($row =mysqli_fetch_array($resulta))  { 
$'.$Idt.' =$row['.$c.$Idt.$c.'];
$'.$campo.' =$row['.$c.$campo.$c.'];
 ?>
<OPTION SELECTED ="selected" VALUE="<?php echo $'.$Idt.'; ?>"> <?php  echo $'.$campo.'; ?> </OPTION>
<?php
      }
}
mysqli_free_result($resulta);
mysqli_close($db_connection);
 ?>
</SELECT>  
</div>
</div>
</form>
 ');
}

fwrite($archivo, '
<h1>UPDATE</h1>
<form action="'.$txt.'upd.php" method="POST">');
$s="$";

fwrite($archivo,"\r\n");
 foreach ($info_campo as $valor) {

if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24
if( $valor->flags!=49667 && $valor->flags!=53257)//primery o index
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='number' name='".$valor->name."'  placeholder='".$valor->name."'  value='<?php echo $".$valor->name."; ?>' required> \r\n");
  
if(strlen($txt2)<=0){
if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24
if( $valor->flags==49667 || $valor->flags==53257 )
  fwrite($archivo, "
  <input type='hidden' name='".$valor->name."'   value='<?php echo utf8_decode(".$s."_GET['".$valor->name."']); ?>' >  \r\n");
  }else{
if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24
if( $valor->flags==49667 || $valor->flags==53257 )//primery o index
  fwrite($archivo, "
  <input type='hidden' name='".$valor->name."'   value='<?php echo utf8_decode(".$s."_GET['".$valor->name."']); ?>' >  \r\n"); 
  
  }
  
if($valor->type == 0  || $valor->type == 4 || $valor->type == 5 || $valor->type == 6 || $valor->type == 246 )//DECIMALES 
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='TEXT' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> \r\n");

if($valor->type == 7)//fechas
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='datetime' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>'  required> \r\n");
if($valor->type == 10)
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='date' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> \r\n");
if($valor->type == 11)
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='time' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> \r\n");
if($valor->type == 12)
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='datetime' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> \r\n");

if($valor->type==249 || $valor->type==250 || $valor->type==251 || $valor->type==252)//blob
  fwrite($archivo, "<p>".$valor->name."</p>
  <textarea id='".$valor->name."' name='".$valor->name."' rows='7' cols='60'> <?php echo $".$valor->name."; ?> </textarea> \r\n");
 
if($valor->type == 253 && $valor->name != "Pass")//cadena no password
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='text' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> \r\n");
if($valor->type == 254 && $valor->name != "Pass")//cadena no password
  fwrite($archivo, "<p>".$valor->name."</p>
  <input type='text' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> \r\n");

if($valor->name == "Pass")//cadena password
{
 fwrite($archivo, '
 <p>Password</p>
<input type="password" name="Pass" placeholder="Password" id="pass1" value="<?php echo $'.$valor->name.'; ?>" required>
<p>Confirm Password</p>
<input type="password" name="pas2" placeholder="Confirm Password" id="pass2" value="<?php echo $'.$valor->name.'; ?>"  required>
<div id="msg"></div>
<!-- Mensajes de Verificación -->
<div id="error" class="alert alert-danger ocultar" role="alert">
    Passwords do not match, please try again !
</div>
<div id="ok" class="alert alert-success ocultar" role="alert">
   Passwords match! (Processing form ...)
</div>
 '); 
}
fwrite($archivo,"\r\n");
   }

fwrite($archivo,'<input type="submit" name="" value="Login">
</form>
</div>
</div>');

fwrite($archivo, " \r\n");
fwrite($archivo,$regresar."\r\n");
fwrite($archivo, $cola." \r\n");
fflush($archivo);
fclose($archivo);
mysqli_free_result($resultado);
mysqli_close($db_connection);
}
}

//delete

public function del($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $Idt ){

$txt=$tabla;
$txt2=$tabla2;
$bus=$campo;
  $c="'";
  $p=".";
  $s="$";

$db_connection = mysqli_connect($servidor, $usuario, $clave, $basedatos) or die(mysql_error());
if (!$db_connection) {
  die("Se ha podido conectar a la base de datos");
}else
  echo mysqli_connect_error($db_connection);


$inicio="<?php 
include 'db.php';";
$fecha= ' date_default_timezone_set("America/Mexico_City"); $script_tz = date_default_timezone_get(); $date = date("Y-m-d"); $time = date("H:i:s", time()); $dt= $date." ". $time; ';
$condicion='if (mysqli_num_rows($resultado)>0) {';
$go1=' header("Location: index.php"); ';
$retry3='$retry_value = mysqli_query($db_connection,$delete_value);';
$go2=' header("Location: index.php");';
$free='mysqli_free_result($retry_value);';
$free2='mysqli_free_result($resultado);';
$close= 'mysqli_close($db_connection);';
$fin="?>";
$cabeza2='<?php
session_start(); 
?>
<html>
<head>
<title>'.$txt.'del</title>
<script src="dat/js/jquery-3.6.0.min.js"></script>
 ';
$body='</head>
<body>
<p>Usuario:<a style="color:orange;"> <?php echo $nombres; ?> </a></p>
 '; 
$regresar='<a href="index.php?<?php echo $'.$usu1.'; ?>">Back</a>';
$cola='
<p>© jimmyvillatoro77@gmail.com</p>
</body>
</html>
 ';

$dir = "php/".$txt."/";
if (!file_exists($dir)) 
mkdir($dir, 0777, true);


//-------------------------del 

//echo  'Archivo : '.$txt.'del.php listo';
   
    $archivo = fopen($dir.$txt."del.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {
      
$consulta = "SELECT * FROM ".$txt;
$resultado=mysqli_query($db_connection, $consulta);
$info_campo = mysqli_fetch_fields($resultado);
$fila = mysqli_fetch_array($resultado);
$field_cnt = $resultado->field_count;

foreach ($info_campo as $valor) {

if( $valor->flags==49667){
$primary=$valor->name;
$ban=1;
}
if($valor->flags==53257 && $ban==2){
$terciary=$valor->name;
$ban=3;}
if($valor->flags==53257){
$secundary=$valor->name;
$ban=2;}

if( $valor->flags!=49667){
$cadena1.=$valor->name.", ";
if($ban==1){
 $bus=$valor->name;
 $ban=4;
}
}
   }

if(strlen($secundary)<=0)
$secundary=$primary;
if(strlen($terciary)<=0)
$terciary=$secundary;



//DELETE
$sql3 = 'DELETE FROM '.$txt.' WHERE '.$primary.' LIKE '.$c.'".'.$s.'Idx."'.$c.'"; ';    
      
      
fwrite($archivo,$inicio." \r\n");

$request="
/*
$"."$primary = $"."_REQUEST['$primary'];
$"."$secundary = $"."_REQUEST['$secundary'];
*/
";

fwrite($archivo, $request." \r\n");    
  
       //REQUEST
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."= $"."_REQUEST['".$valor->name."'];";
     fwrite($archivo,$recibe."\r\n");
   } 

 $Idx= "$"."Idx= $"."_REQUEST['Idx'];";
fwrite($archivo,$Idx);       
fwrite($archivo, "\r\n");      
fwrite($archivo, $fecha." \r\n");	   
$result3='$resultado=mysqli_query($db_connection, "'.$consulta.' WHERE '.$primary.' LIKE '.$c.'".'.$s.'Idx."'.$c.'" ); ';
fwrite($archivo, $result3." \r\n");
fwrite($archivo, $condicion."\r\n");
$delete='$delete_value ="'.$sql3.' ';
fwrite($archivo,$delete."\r\n");	    
fwrite($archivo, $retry3."\r\n");
fwrite($archivo, $go1."\r\n");
fwrite($archivo, $free."\r\n");
fwrite($archivo, $cierrecondicion."\r\n");
fwrite($archivo, $go2."}\r\n");
fwrite($archivo,$free2."\r\n");
fwrite($archivo,$close."\r\n");
fwrite($archivo,$fin);

fflush($archivo);
fclose($archivo);
}


//---------------------del2

//echo  'Archivo : '.$txt.'del2.php listo';
   
$archivo = fopen($dir.$txt."del2.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {
fwrite($archivo, $cabeza2." \r\n");
fwrite($archivo,"<?php
$"."".$primary."= $"."_REQUEST['".$primary."'];
?>
");
fwrite($archivo, $body." \r\n");
fwrite($archivo, '
<div> <h2>'.$txt.'</h2> </div>'); 
fwrite($archivo, " \r\n");
fwrite($archivo, '<h1>DELETE</h1>
<form action="'.$txt.'del.php" method="POST">');
$s="$";
fwrite($archivo, " \r\n");
fwrite($archivo,"<p>".$primary." to Delete</p><input type='text' name='Idx' placeholder='".$primary." to Delete' value='<?php echo  $".$primary."; ?>' required> ");
fwrite($archivo, " \r\n");                
fwrite($archivo,'<input type="submit" name="" value="Delete">
</form>
</div>
</div>');
fwrite($archivo, " \r\n");
fwrite($archivo,$regresar."\r\n");
fwrite($archivo, $cola." \r\n");
fflush($archivo);
fclose($archivo);
mysqli_free_result($resultado);
mysqli_close($db_connection);
}

}

//select

public function select($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $Idt ){

$txt=$tabla;
$txt2=$tabla2;
$bus=$campo;
  $c="'";
  $p=".";
  $s="$";

$db_connection = mysqli_connect($servidor, $usuario, $clave, $basedatos) or die(mysql_error());
if (!$db_connection) {
  die("Se ha podido conectar a la base de datos");
}else
  echo mysqli_connect_error($db_connection);


$consulta = "SELECT * FROM ".$txt;
$resultado=mysqli_query($db_connection, $consulta);
$info_campo = mysqli_fetch_fields($resultado);
$fila = mysqli_fetch_array($resultado);
$field_cnt = $resultado->field_count;

$sql = "INSERT INTO ".$txt."(";   

foreach ($info_campo as $valor) {
if( $valor->flags==49667){
$primary=$valor->name;
$ban=1;
}
if($valor->flags==53257 && $ban==2){
$terciary=$valor->name;
$ban=3;}
if($valor->flags==53257){
$secundary=$valor->name;
$ban=2;}

if( $valor->flags!=49667){
$cadena1.=$valor->name.", ";
if($ban==1){
 $bus=$valor->name;
 $ban=4;
}
}
   }

if(strlen($secundary)<=0)
$secundary=$primary;
if(strlen($terciary)<=0)
$terciary=$secundary;

//INSERT
$cadena2="";
  $myString = substr($cadena1, 0, -2);
  $sql.= $myString.")";
  $c="'";
  $p=".";
  $s="$";
  $sql.=" VALUES (";
     foreach ($info_campo as $valor) {
if( $valor->flags!=49667)
$cadena2.=' '.$c.'"'.$p.'$'.$valor->name.$p.'"'.$c.', ';
   } 
   $myString = substr($cadena2, 0, -2);
   $sql.=$myString.")";
   $insert_value =$sql;
   
//UPDATE
$cadena2="";
$sql2 = "UPDATE ".$txt." SET ";   
   foreach ($info_campo as $valor) {
if( $valor->flags!=49667)
      $cadena2.=$valor->name.'='.' '.$c.'"'.$p.'$'.$valor->name.$p.'"'.$c.', ';
   } 
  $myString = substr($cadena2, 0, -2);
  $sql2.= $myString." ";
  $sql2.='  WHERE   '.$primary.' = '.$c.'".$'.$primary.'."'.$c.'" ; ';

//DELETE
$sql3 = 'DELETE FROM '.$txt.' WHERE '.$primary.' LIKE '.$c.'".'.$s.'Idx."'.$c.'"; ';  
$cabeza3='<?php
session_start(); 
?>
<html>
<head>
<link href="dat/css/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="dat/js/tablecloth.js"></script>
<title>'.$txt.'sel</title>
<style>
    .div-1 {
      background-color: #EBEBEB;
    }
     #products-table
{
     width: 200px;
    height: 400px;
    overflow:scroll;
}
</style>
 ';
$body='</head>
<body>
 '; 
$regresar='<a href="index.php?<?php echo $'.$usu1.'; ?>">Back</a>';
$cola='
<p>© jimmyvillatoro77@gmail.com</p>
</body>
</html>
 ';

$dir = "php/".$txt."/";
if (!file_exists($dir)) 
mkdir($dir, 0777, true);


//---------------------sel2

//echo  'Archivo : '.$txt.'sel2.php listo';
   
    $archivo = fopen($dir.$txt."sel2.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {

fwrite($archivo, $cabeza3." \r\n");
fwrite($archivo, $body." \r\n");
fwrite($archivo, '<div> <h2>'.$txt.'</h2> </div>'); 
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo,  "<div id='container'>
<h1>Select</h1>
<div class='div-1' style='width:1200px; height:600px; overflow:auto;'>
<div id='content'><table>
  <tr>");
  
 foreach ($info_campo as $valor) {
  fwrite($archivo,  "<th>".$valor->name."</th>");
  fwrite($archivo,  " \r\n");
   }
   
  fwrite($archivo, "
<?php
include 'db.php'; \r\n");
fwrite($archivo, "$"."$bus= utf8_decode($"."_GET['$bus']); \r\n");
fwrite($archivo, '$resultado=mysqli_query($db_connection, "SELECT * FROM '.$txt.' " );');
fwrite($archivo, "
while ($"."row =mysqli_fetch_array($"."resultado)) 
{ ");

//Row
fwrite($archivo, " \r\n");
$uno=1;
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."=$"."row['".$valor->name."'];";
     fwrite($archivo,$recibe."\r\n");
   } 
fwrite($archivo,  " ?>\r\n"); 
fwrite($archivo,  "</tr><tr>");
  foreach ($info_campo as $valor) {
 fwrite($archivo,  "<td><?php echo $".$valor->name."; ?></td>");
 fwrite($archivo,  " \r\n");
      }
      
fwrite($archivo, " \r\n");
fwrite($archivo, " <?php } mysqli_free_result($"."resultado);\r\n");
fwrite($archivo, "mysqli_close($"."db_connection); \r\n");
fwrite($archivo, '?> 
');   
      
fwrite($archivo, "</tr></table>	</div>
</div></br></div></br>");
fwrite($archivo,$regresar."\r\n");
fwrite($archivo, $cola." \r\n");

fflush($archivo);
fclose($archivo);
}

//-----------------sel3
//echo  'Archivo : '.$txt.'sel3.php listo';
   
    $archivo = fopen($dir.$txt."sel3.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {

fwrite($archivo, $cabeza3." \r\n");
fwrite($archivo, $body." \r\n");
fwrite($archivo, '
<div> <h2>'.$txt.'</h2> </div>'); 
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo,  "<div id='container'>
	<h1>Select for Edit</h1>
<div class='div-1' style='width:1200px; height:600px; overflow:auto;'>
<div id='content'><table>
  <tr><th>Edit</th>");
  $s="$";
 foreach ($info_campo as $valor) {
  fwrite($archivo,  "<th>".$valor->name."</th>");
  fwrite($archivo,  " \r\n");
   }

  fwrite($archivo, "
<?php
include 'db.php'; \r\n");
fwrite($archivo, "$"."$bus= utf8_decode($"."_GET['$bus']); \r\n");
fwrite($archivo, '$resultado=mysqli_query($db_connection, "SELECT * FROM '.$txt.' " );');
fwrite($archivo, "
while ($"."row =mysqli_fetch_array($"."resultado)) 
{ ");

//Row
fwrite($archivo, " \r\n");
$uno=1;
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."=$"."row['".$valor->name."'];";
     fwrite($archivo,$recibe."\r\n");
   } 
fwrite($archivo,  " ?>\r\n"); 
fwrite($archivo,  "</tr><tr>");
fwrite($archivo, '<tr><form action="'.$txt.'upd3.php" method="POST">');
fwrite($archivo,  " \r\n");
fwrite($archivo,"<input type='hidden' name='".$primary."' value='<?php echo utf8_decode(".$s."_GET['".$primary."']); ?>'> \r\n");
fwrite($archivo,"<input type='hidden' name='".$secundary."' value='<?php echo utf8_decode(".$s."_GET['".$secundary."']); ?>'> \r\n");
fwrite($archivo,  " \r\n");

foreach ($info_campo as $valor) {
if($uno==1){
   fwrite($archivo, "<td><div><button type='submit' class='btn btn-success'>Edit</button> </div></td>");  
     fwrite($archivo,  " \r\n");
   $uno++;
   }
   
if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24
  fwrite($archivo, "<td><div><input type='number' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> </div></td>  \r\n");
  
if($valor->type == 0  || $valor->type == 4 || $valor->type == 5 || $valor->type == 6 || $valor->type == 246 )//DECIMALES 
  fwrite($archivo, "<td><div><input type='TEXT' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> </div></td>  \r\n");

if($valor->type == 7)//fechas
  fwrite($archivo, "<td><div><input type='datetime-local' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> </div></td>  \r\n");
if($valor->type == 10)
  fwrite($archivo, "<td><div><input type='date' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> </div></td>  \r\n");
if($valor->type == 11)
  fwrite($archivo, "<td><div><input type='time' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> </div></td>  \r\n");
if($valor->type == 12)
  fwrite($archivo, "<td><div><input type='datetime-local' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> </div></td>  \r\n");

if($valor->type==249 || $valor->type==250 || $valor->type==251 || $valor->type==252)//blob
  fwrite($archivo, "<td><div><textarea id='".$valor->name."' name='".$valor->name."' rows='10' cols='100'> <?php echo $".$valor->name."; ?> </textarea> </div></td>  \r\n");
 
if($valor->type == 253)//cadena
  fwrite($archivo, "<td><div><input type='text' name='".$valor->name."'   placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> </div></td>  \r\n");
if($valor->type == 254)
  fwrite($archivo, "<td><div><input type='text' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo $".$valor->name."; ?>' required> </div></td>  \r\n");

   fwrite($archivo,  " \r\n");
      }
      
fwrite($archivo, "</form> \r\n");
fwrite($archivo, " <?php } mysqli_free_result($"."resultado);\r\n");
fwrite($archivo, "mysqli_close($"."db_connection); \r\n");
fwrite($archivo, '?> 
');   

fwrite($archivo, "</tr></table>	</div>
</div></br></div></br>");
fwrite($archivo,$regresar."\r\n");
fwrite($archivo, $cola." \r\n");
	
fflush($archivo);
fclose($archivo);

mysqli_free_result($resultado);
mysqli_close($db_connection);

}

}

//search

public function search($servidor, $usuario, $clave, $basedatos, $tabla, $tabla2, $campo, $usu1, $Idt ){

$txt=$tabla;
$txt2=$tabla2;
$bus=$campo;
  $c="'";
  $p=".";
  $s="$";

$db_connection = mysqli_connect($servidor, $usuario, $clave, $basedatos) or die(mysql_error());
if (!$db_connection) {
  die("Se ha podido conectar a la base de datos");
}else
  echo mysqli_connect_error($db_connection);


$consulta = "SELECT * FROM ".$txt;
$resultado=mysqli_query($db_connection, $consulta);

$info_campo = mysqli_fetch_fields($resultado);
$fila = mysqli_fetch_array($resultado);
$field_cnt = $resultado->field_count;


foreach ($info_campo as $valor) {
  

if( $valor->flags==49667){
$primary=$valor->name;
$ban=1;
}
if($valor->flags==53257 && $ban==2){
$terciary=$valor->name;
$ban=3;}
if($valor->flags==53257){
$secundary=$valor->name;
$ban=2;}

if( $valor->flags!=49667){
$cadena1.=$valor->name.", ";
if($ban==1){
 $bus=$valor->name;
 $ban=4;
}
}
  }

if(strlen($secundary)<=0)
$secundary=$primary;
if(strlen($terciary)<=0)
$terciary=$secundary;


$inicio="<?php 
include 'db.php';";
$request="
/*
$"."$primary = $"."_REQUEST['$primary'];
$"."$secundary = $"."_REQUEST['$secundary'];
*/
";
$request2='$html="";
$busca= $_REQUEST["txtbusca"];
$html.="<h2><strong class='.$c.'cur'.$c.'>Resultados</h2>";
';
$result4='$resultado=mysqli_query($db_connection, "'.$consulta.' WHERE '.$bus.' LIKE '.$c.'%".$busca."%'.$c.'" ); ';
$condicion='if (mysqli_num_rows($resultado)>0) {';
$while2="while ($"."row =mysqli_fetch_array($"."resultado)) { ";
$while2end='}
$html.="</b>";
echo $html;
}else
echo 
"Is not found";
';
$free2='mysqli_free_result($resultado);';
$close= 'mysqli_close($db_connection);';
$fin="?>
";
$cabeza='<?php
session_start(); 
?>
<html>
<head>
<title>'.$txt.'ser</title>
 ';
$script2='
<script src="dat/js/jquery-3.6.0.min.js"></script>
<script language=JavaScript>
$(document).ready(function(){
         $("#txtbusca").keyup(function(){
              var parametros="txtbusca="+$(this).val()
              $.ajax({
                    data:  parametros,
                  url:   "'.$txt.'ser.php?'.$usu1.'=<?php echo $'.$usu1.'?>",
                  type:  "post",
                    beforeSend: function () { },
                    success:  function (response) {                 
                        $(".salida").html(response);
                  },
                  error:function(){
                       alert("funcion error")
                    }
               });
         })
})
</script>
';
$body='</head>
<body>
<p>Usuario:<a style="color:orange;"> <?php echo $nombres; ?> </a></p>
 '; 
$regresar='<a href="index.php?<?php echo $'.$usu1.'; ?>">Back</a>';
$cola='
<p>© jimmyvillatoro77@gmail.com</p>
</body>
</html>
 ';
 

$dir = "php/".$txt."/";
if (!file_exists($dir)) 
mkdir($dir, 0777, true);

//------------------------ser

//echo  'Archivo : '.$txt.'ser.php listo';
   
    $archivo = fopen($dir.$txt."ser.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {

fwrite($archivo,$inicio." \r\n");
fwrite($archivo, $request." \r\n");
fwrite($archivo,$request2." \r\n");
fwrite($archivo,$result4." \r\n");
fwrite($archivo, $condicion."\r\n");
fwrite($archivo, $while2."\r\n");

$ban2=0;
//Row
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."=$"."row['".$valor->name."'];";
fwrite($archivo,$recibe."\r\n");
      if( $valor->flags==49667){
fwrite($archivo, "$"."html.= '<p><a href=".$txt."sel2.php?".$valor->name."=".$c.$p."$".$valor->name.$p.$c.">".$c.$p."$".$valor->name.$p.$c."</a></p></b>';");
     }
     fwrite($archivo, "$"."html.= '<p>".$c.$p."$".$valor->name.$p.$c."</p></b>';");
     fwrite($archivo, " \r\n");
   } 
   
fwrite($archivo, $while2end."\r\n");  
fwrite($archivo,$free2."\r\n");
fwrite($archivo,$close."\r\n");
fwrite($archivo,$fin);

fflush($archivo);
fclose($archivo);
}

//---------------------------ser2

//echo  'Archivo : '.$txt.'ser2.php listo';
   
    $archivo = fopen($dir.$txt."ser2.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {
        
fwrite($archivo, $cabeza." \r\n");
fwrite($archivo, $script2." \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo, "<?php
include 'db.php'; \r\n");
fwrite($archivo, "$"."$primary= utf8_decode($"."_GET['$primary']); \r\n");
fwrite($archivo, "$"."$secundary = utf8_decode($"."_GET['$secundary']); \r\n");
fwrite($archivo, '$resultado=mysqli_query($db_connection, "SELECT * FROM '.$txt.' WHERE '.$primary.' = '.$c.'".$'.$primary.'."'.$c.'" );');
fwrite($archivo, " \r\n");
fwrite($archivo, "while ($"."row =mysqli_fetch_array($"."resultado)) { ");
fwrite($archivo, " \r\n");
//Row
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."=$"."row['".$valor->name."'];";
     fwrite($archivo,$recibe."\r\n");
   } 
fwrite($archivo, " } \r\n");
fwrite($archivo, " mysqli_free_result($"."resultado);\r\n");
fwrite($archivo, "mysqli_close($"."db_connection); \r\n");
fwrite($archivo, "?> \r\n");

fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");   
fwrite($archivo, " <?php  \r\n");
fwrite($archivo, "$"."$bus = utf8_decode($"."_GET['$bus']); \r\n");
fwrite($archivo, "?> \r\n");
fwrite($archivo, $body." \r\n");
fwrite($archivo, ' 
<div> <h2>'.$txt.'</h2> </div>'); 
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo, '
<h2>busca por <strong class="cur">'.$bus.'</strong></h2>
<form action="'.$txt.'ser.php" method="POST">');
$c="'";
fwrite($archivo, '
<div class="input-group mb-3">
<input type="hidden" name="'.$usu1.'" value="<?php echo utf8_decode($_GET['.$c.''.$usu1.''.$c.']); ?>">
          <input type="text" class="form-control" id="txtbusca" value="<?php echo  $'.$bus.'; ?>" aria-label="Search" aria-describedby="basic-addon2">
       <div class="input-group-append">
          <span class="input-group-text" id="basic-addon2"></span>
        </div>
</div>
<div class="salida"></div>
</form> ');
	
fwrite($archivo, " \r\n");
fwrite($archivo, " \r\n");
fwrite($archivo,$regresar."\r\n");
fwrite($archivo, $cola." \r\n");

fflush($archivo);
fclose($archivo);
}

//-------------------------ser3

//echo  'Archivo : '.$txt.'ser3.php listo';
   
    $archivo = fopen($dir.$txt."ser3.php","w+b");
    if( $archivo == false ) {
      echo "Error al crear el archivo";
    }
    else
    {

fwrite($archivo,$inicio." \r\n");
fwrite($archivo, $request." \r\n");
fwrite($archivo,$request2." \r\n");
fwrite($archivo,$result4." \r\n");
fwrite($archivo, $condicion."\r\n");
fwrite($archivo, $while2."\r\n");

//Row

$ban2=0;
foreach ($info_campo as $valor) {
     $recibe= "$".$valor->name."=$"."row['".$valor->name."'];";
fwrite($archivo,$recibe."\r\n");
if( $valor->flags==49667){
fwrite($archivo, "$"."html.= '<p><a href=".$txt."upd2.php?".$valor->name."=".$c.$p."$".$valor->name.$p.$c.">".$c.$p."$".$valor->name.$p.$c."</a><p></b>';");
     }
     fwrite($archivo, "$"."html.= '<p>".$c.$p."$".$valor->name.$p.$c."</p></b>';");
     fwrite($archivo, " \r\n");
     

   } 
  
fwrite($archivo, $while2end."\r\n");  
fwrite($archivo,$free2."\r\n");
fwrite($archivo,$close."\r\n");
fwrite($archivo,$fin);
fflush($archivo);
fclose($archivo);

mysqli_free_result($resultado);
mysqli_close($db_connection);
}

}

//------------------------------------------------------------------------------copy

public function copiar($txt){
echo "</br>";
$dir3 = "php/".$txt."/dat/js";
if (!file_exists($dir3)) 
mkdir($dir3, 0777, true);

copy('dat/js/jquery-3.6.0.min.js','php/'.$txt.'/dat/js/jquery-3.6.0.min.js');
copy('dat/js/tablecloth.js','php/'.$txt.'/dat/js/tablecloth.js');

$dir3 = "php/".$txt."/dat/css";
if (!file_exists($dir3)) 
mkdir($dir3, 0777, true);
copy('dat/css/tablecloth.css','php/'.$txt.'/dat/css/tablecloth.css');

$dir3 = "php/".$txt."/dat/img";
if (!file_exists($dir3)) 
mkdir($dir3, 0777, true);
copy('dat/img/tr_back.gif','php/'.$txt.'/dat/img/tr_back.gif');
}

}//class end
?>