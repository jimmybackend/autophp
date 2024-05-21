<?php 

//30 agosto

class DevC{



public $host   = '0.0.0.0';

public $user   = 'root';

public $password   = 'root';

public $database   = 'dantask';      

public $dbConnect  = false;

private static $conn;



public function __construct(){

          if(!$this->dbConnect){ 

          $conn = new mysqli($this->host, $this->user, $this->password, $this->database);

            if($conn->connect_error){

                die('Error failed to connect to MySQL: ' . $conn->connect_error);

            }else{

                $this->dbConnect = $conn;

            }

        }

    }



//los campos de la tabla

public function getCampo($sqlQuery) {

    $result = mysqli_query($this->dbConnect, $sqlQuery);

    if(!$result){

      die('Error in query: '. mysqli_error($conn));

    }

      return  mysqli_fetch_fields($result);

  } 



//registros de la tabla

public function getCampo2($sqlQuery) {

     $result = mysqli_query($this->dbConnect, $sqlQuery);

    if(!$result){

      die('Error in query: '. mysqli_error($conn));

    }

    $data= array();

    while ($row = mysqli_fetch_array($result)) {

      $data[]=$row;            

    }

    return $data;

  }



//numero de campos de la tabla

public function getCampo3($sqlQuery) {

    $result = mysqli_query($this->dbConnect, $sqlQuery);

    if(!$result){

      die('Error in query: '. mysqli_error($conn));

    }

return count(mysqli_fetch_fields($result));

  }

 

//los registros de la tabla desde una funcion en this class

private function getData($sqlQuery) {

    $result = mysqli_query($this->dbConnect, $sqlQuery);

    if(!$result){

      die('Error in query: '. mysqli_error($conn));

    }

    $data= array();

    while ($row = mysqli_fetch_assoc ($result)) {

      $data[]=$row;            

    }

    return $data;

  }



//numero de registros de la tabla 

private function getNumRows($sqlQuery) {

    $result = mysqli_query($this->dbConnect, $sqlQuery);

    if(!$result){

      die('Error in query: '. mysqli_error($conn));

    }

    $numRows = mysqli_num_rows($result);

    return $numRows;

  }



//insert

public function INSERT($tabla, $id, $data=array()) { 

$consulta = 'SELECT * FROM '.$tabla; 

$cadena1='';

$cadena2='';

$cadena3='';

  $c="'";

  $c2='"';

  $p='.';

  $s='$';

$resultado=mysqli_query($this->dbConnect, $consulta);

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

$cadena1.=$valor->name.', ';

if($ban==1){

 $bus=$valor->name;

 $ban=4;

}

}

   }

/*

//---------- INSERT

$sql = 'INSERT INTO '.$tabla."(";  

$myString = substr($cadena1, 0, -2);

  $sql.= $myString.') VALUES (';

foreach ($info_campo as $valor) {

if( $valor->flags!=49667)

$cadena2.=' '.$c.$c2.$p.$s.$valor->name.$p.$c2.$c.', ';

   } 

   $myString = substr($cadena2, 0, -2);

   $sql.=$myString.')';

   $insert_value =$sql;

   

$sqlInsert=' '.$c2.$sql.$c2.' ';

echo $sqlInsert;

//---------- INSERT

*/

//---------- INSERT DATA



$consulta3 = 'SELECT * FROM '.$tabla; 

$resultado3=mysqli_query($this->dbConnect, $consulta3);

$info_campo3 = mysqli_fetch_fields($resultado3);

$fila = mysqli_fetch_array($resultado3);

$field_cnt = $resultado3->field_count;



$sql3 = 'INSERT INTO '.$tabla.'(';  

$myString = substr($cadena1, 0, -2);

  $sql3.= $myString.') VALUES (';

  $i=0;

foreach ($info_campo3 as $valor) {

if( $valor->flags!=49667)

$cadena3.=' '.$c.''.$data[$i++].''.$c.', ';

   } 

   $myString = substr($cadena3, 0, -2);

   $sql3.=$myString.')';

     

$sqlInsert=' '.$sql3.' ';

//echo $sqlInsert;



//---------- INSERT DATA



if(strlen($data[0])>0){

    $result = mysqli_query($this->dbConnect, $sqlInsert);

    if(!$result){

      return ('Error in query: '. mysqli_error($conn));

    } }

  }





//update

public function UPDATE($tabla, $id, $data=array()) {   

$consulta = 'SELECT * FROM '.$tabla; 

$cadena1='';

$cadena2='';

$cadena3='';

  $c="'";

  $c2='"';

  $p='.';

  $s='$';



$resultado=mysqli_query($this->dbConnect, $consulta);

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

$cadena1.=$valor->name.', ';

if($ban==1){

 $bus=$valor->name;

 $ban=4;

}

}

   }

/*

//---------UPDATE

$consulta = 'SELECT * FROM '.$tabla;

$resultado=mysqli_query($this->dbConnect, $consulta);

$info_campo = mysqli_fetch_fields($resultado);

$fila = mysqli_fetch_array($resultado);

$field_cnt = $resultado->field_count;

$sql2 = 'UPDATE '.$tabla.' SET ';   

foreach ($info_campo as $valor) {

if( $valor->flags!=49667)

$cadena2.=$valor->name.'='.' '.$c.$c2.$p.$s.$valor->name.$p.$c2.$c.', ';

   } 

$myString = substr($cadena2, 0, -2);

$sql2.= $myString.' WHERE   '.$primary.' = '.$c.$c2.$p.$s.$primary.$p.$c2.$c.'; ';

$sqlUserUpdate=$sql2;

echo $sqlUserUpdate;

//---------UPDATE

*/

  

//---------- UPDATE DATA

$consulta3 = 'SELECT * FROM '.$tabla; 

$resultado3=mysqli_query($this->dbConnect, $consulta3);

$info_campo3 = mysqli_fetch_fields($resultado3);

$fila = mysqli_fetch_array($resultado3);

$field_cnt = $resultado3->field_count;

$sql3 =  'UPDATE '.$tabla.' SET ';   

  $i=0;

foreach ($info_campo3 as $valor) {

if( $valor->flags!=49667)

$cadena3.=$valor->name.'='.' '.$c.$data[$i++].$c.', ';

   } 

   $myString = substr($cadena3, 0, -2);

   $sql3.=$myString.'  WHERE   '.$primary.' = '.$c.$id.$c.' ';  

$sqlUserUpdate=$sql3;

//echo $sqlUserUpdate;



//---------- UPDATE DATA



if(strlen($data[0])>0){

$result = mysqli_query($this->dbConnect, $sqlUserUpdate); 

    if(!$result){

      return ('Error in query: '. mysqli_error($conn));

    } 

  }



  }





//delete 

public function DELETE($tabla, $id, $dato){

$sqlQuery = "DELETE FROM ".$tabla." WHERE ".$id."=".$dato." ";

        $result = mysqli_query($this->dbConnect, $sqlQuery); 

        if(!$result){

          return ('Error in query: '. mysqli_error($conn));   

      }

    }

      

//select    

public function SELECT($tabla, $id){

$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";

$field = $this->getCampo($sqlQuery);

$row   = $this->getCampo2($sqlQuery);

//FIELD

echo "<table>

<tr>";

$i=0;

foreach ($field  as $valor) {

echo  '<th>--'.$valor->name.'--</th>';

$i++;

}

echo "</tr>

</table>";



//ROW

echo "<table>

<tr>";

foreach ($row as $valor) {

$x=0;

while($x<$i){

echo  '<td>'.$valor[$x].'</td>';

$x++;

}

echo "</tr>";

}

echo "</table>";



  }



//select  los campos dela tabla retorna en arreglo

public function SELECTfield($tabla, $id){

$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";

$field = $this->getCampo($sqlQuery);

return $field;

}



//select  los registros de la tabla retorna en arreglo

public function SELECTrow($tabla, $id){

$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";

$row   = $this->getCampo2($sqlQuery);

return $row; 

}



//select  todos los registros de la tabla retorna en arreglo que su recursiva sea 0

public function SELECTrow2($tabla, $id){

$Id=$id.'2';

$sqlQuery = "SELECT * FROM ".$tabla." WHERE ".$Id."=0 ORDER BY  ".$id." ";

$row   = $this->getCampo2($sqlQuery);

return $row; 

}



//select  Id y Nombre de la tabla retorna en arreglo que su recursiva sea 0

public function SELECTrow3($tabla, $id, $name, $value){

$Id=$id.'2';

$sqlQuery = "SELECT ".$Id.", ".$name." FROM ".$tabla." WHERE ".$id."=".$value." ORDER BY  ".$id." ";

$row   = $this->getCampo2($sqlQuery);

return $row; 

}



//select  todos los registros de la tabla retorna en arreglo que su recursiva sea un numero dado

public function SELECTrow4($tabla, $id, $id2){

$Id=$id.'2';

$sqlQuery = "SELECT * FROM ".$tabla." WHERE ".$Id."=".$id2." ORDER BY  ".$id." ";

$row   = $this->getCampo2($sqlQuery);

return $row; 

}



//search

public function SEARCH($tabla, $id, $dato){

$sqlQuery = "SELECT * FROM ".$tabla." WHERE ".$id."=".$dato." ";

    

    $field = $this->getCampo($sqlQuery);

    $row   = $this->getCampo2($sqlQuery);

    //FIELD

    echo "<table>

    <tr>";

    $i=0;

    foreach ($field  as $valor) {

    echo  '<th>--'.$valor->name.'--</th>';

    $i++;

    }

    echo "</tr>

    </table>";

    

    //ROW

    echo "<table>

    <tr>";

    foreach ($row as $valor) {

    $x=0;

    while($x<$i){

    echo  '<td>'.$valor[$x].'</td>';

    $x++;

    }

    echo "</tr>";

    }

    echo "</table>";

    

  }



//search2 busca un registro en especifico

public function SEARCH2($tabla, $id, $dato){

$sqlQuery = "SELECT * FROM ".$tabla." WHERE ".$id."=".$dato." ";

    $result = mysqli_query($this->dbConnect, $sqlQuery);

    if(!$result){

      die('Error in query: '. mysqli_error($conn));

    }

    $data= array();

    while ($row = mysqli_fetch_array($result)) {

      $data[]=$row; 

    }

      return $data;

  }



//--------------------------------------------------crea Archivos---------------------------



public function INSERT3($tabla, $id) { 



  $sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." "; 

  $field = $this->getCampo($sqlQuery);

  

  $dir = "php2/".$tabla."/";

  if (!file_exists($dir)) 

  mkdir($dir, 0777, true);

  

  $archivo = fopen($dir.$tabla."add.php","w+b");

  if( $archivo == false ) {

  echo "Error al crear el archivo";

      }

      else

      {

        $s='$';

fwrite($archivo,"<?php

".$s."tabla  ='".$tabla."';

".$s."id     ='".$id."';

".$s."data=array();

include ('".$tabla."class.php');

".$s."dev = new Dev(); \r\n");

  

  $i=0;

  $recibe="";

  foreach ($field as $valor) {

    if( $valor->flags!=49667)

    $recibe="".$s."data[".$i++."]=$"."_REQUEST['".$valor->name."'];";

    fwrite($archivo,$recibe."\r\n");

   }



  fwrite($archivo,"".$s."dev->INSERT(".$s."tabla, ".$s."id, ".$s."data);

  header('Location: ".$tabla."sel2.php');

  ?> \r\n");

  }  

  fflush($archivo);

  fclose($archivo);

  }

  

public function INSERT4($tabla, $id, $tabla2, $idt) { 

$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";

$field = $this->getCampo($sqlQuery);

 



$dir = "php2/".$tabla."/";

    if (!file_exists($dir)) 

    mkdir($dir, 0777, true);

    

$archivo = fopen($dir.$tabla."add2.php","w+b");

    if( $archivo == false ) {

    echo "Error al crear el archivo";

        }

        else

        {

  $cabeza='<?php

  session_start();

  ?>

  <html>

  <head>

  <title>'.$tabla.'add</title>

  <script src="dat/js/jquery-3.6.0.min.js"></script>';

  

$s='$';

$c2='"';

fwrite($archivo,$cabeza."\r\n");

$body='</head>

<body>'; 

fwrite($archivo,$body."\r\n");

  //FIELD

fwrite($archivo,'

<h1>INSERT HERE</h1>

<form action="'.$tabla.'add.php" method="POST">');

  $s="$";

  $c="'";

  fwrite($archivo,"\r\n");



foreach ($field  as $valor) {



    if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24

    if( $valor->flags != 49667)//primary 

    fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

    <input type='number' name='".$valor->name."'   placeholder='".$valor->name."' required>");

    

    if( $valor->flags==53257 && strlen($tabla2)>0 ) //si existe Tabla Maestra

    {

          fwrite($archivo,"\r\n");

          fwrite($archivo,'<p>'.$tabla2.'</p>');

          fwrite($archivo,"\r\n");

          fwrite($archivo,"<SELECT NAME='".$idt."'>");

          fwrite($archivo,"\r\n");

          fwrite($archivo,"<OPTION VALUE='0'> Choose an option</OPTION>");

          fwrite($archivo,"\r\n");

    fwrite($archivo,"<?php

      ".$s."tabla  ='".$tabla2."';

      ".$s."id     ='".$idt."';

      ".$s."row=array();

      include ('".$tabla."class.php');

      ".$s."dev = new Dev();

      ".$s."row=".$s."dev->SELECTrow(".$s."tabla, ".$s."id); \r\n");  

      fwrite($archivo," foreach (".$s."row as ".$s."dato) {");

            fwrite($archivo,"\r\n");

            fwrite($archivo,"echo ".$c2."<OPTION VALUE='".$s."dato[0]'>".$s."dato[1]</OPTION>".$c2.";");

            fwrite($archivo,"\r\n");

            fwrite($archivo,"}");

            fwrite($archivo,"?> \r\n"); 

            fwrite($archivo,'</SELECT>');

            fwrite($archivo,"\r\n");

    }





    if($valor->type == 0  || $valor->type == 4 || $valor->type == 5 || $valor->type == 6 || $valor->type == 246 )//DECIMALES 

    fwrite($archivo,"<p>".$valor->name."</p>\r\n

    <input type='TEXT' name='".$valor->name."' placeholder='".$valor->name."' required>");

    

    if($valor->type == 7)//fecha y hora

    fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

    <input type='datetime-local' name='".$valor->name."'  placeholder='".$valor->name."' required>");

    

    if($valor->type == 10)//fecha

    fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

    <input type='date' name='".$valor->name."' placeholder='".$valor->name."' required>");

    

    if($valor->type == 11)//hora

    fwrite($archivo,"<p>".$valor->name."</p>\r\n

    <input type='time' name='".$valor->name."' placeholder='".$valor->name."' required>");

    

    if($valor->type == 12)//fecha y hora

    fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

    <input type='datetime-local' name='".$valor->name."' placeholder='".$valor->name."' required>");

    

    if($valor->type==249 || $valor->type==250 || $valor->type==251 || $valor->type==252)//blob

    fwrite($archivo,"<p>".$valor->name."</p>\r\n

    <textarea id='".$valor->name."' name='".$valor->name."' rows='7' cols='60'> ".$valor->name." </textarea>");

    

    if($valor->type == 253 )//cadena

    fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

    <input type='text' name='".$valor->name."'  placeholder='".$valor->name."' required>");

    

    if($valor->type == 254 )//cadena 

    fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

    <input type='text' name='".$valor->name."'  placeholder='".$valor->name."' required>");

   

     }

     

     fwrite($archivo,"\r\n<input type='submit' value='INSERT'>\r\n

    </form>");

  

  

$regresar='<a href="../index2.php?<?php echo $'.$id.'; ?>">Back</a>';

fwrite($archivo,$regresar."\r\n");

$cola='<p>© jimmyvillatoro77@gmail.com</p>

</body>

</html>';

fwrite($archivo,$cola."\r\n");



    }  

  fflush($archivo);

  fclose($archivo);

    }

 

public function UPDATE3($tabla, $id) { 

$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." "; 

      $field = $this->getCampo($sqlQuery);

    

      $dir = "php2/".$tabla."/";

      if (!file_exists($dir)) 

      mkdir($dir, 0777, true);

      

      $archivo = fopen($dir.$tabla."upd.php","w+b");

      if( $archivo == false ) {

      echo "Error al crear el archivo";

          }

          else

          {

            $s='$';

fwrite($archivo,"<?php

".$s."tabla ='".$tabla."';

".$s."id    ='".$id."';

".$s."dato  = ".$s."_REQUEST['dato'];

".$s."data=array();

include ('".$tabla."class.php');

".$s."dev = new Dev(); \r\n");

      

      $i=0;

foreach ($field as $valor) {

// if( $valor->flags!=49667)

$recibe="".$s."data[".$i++."]=$"."_REQUEST['".$valor->name."'];";

fwrite($archivo,$recibe."\r\n");

       }

  

fwrite($archivo,"".$s."dev->UPDATE(".$s."tabla, ".$s."id, ".$s."data);

header('Location: ".$tabla."sel2.php');

      ?> \r\n");

      }  

      fflush($archivo);

      fclose($archivo);

      }



public function UPDATE4($tabla, $id, $tabla2, $dato) { 

$dir = "php2/".$tabla."/";

if (!file_exists($dir)) 

        mkdir($dir, 0777, true);



$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";



$field2 = $this->getCampo($sqlQuery);

$field3 = $this->getCampo($sqlQuery);

$datas=$this->SEARCH2($tabla, $id, $dato);



        //# FIELD

        $i=0;

        foreach ($field2  as $valor1) {

            $i++;

        }

        //# ROW

        $data=array();

        foreach ($datas as $valor2) {

        $x=0;

        while($x<$i){

          $data[$x++]=$valor2[$x++];

        }

        }



        

$archivo = fopen($dir.$tabla."upd2.php","w+b");

        if( $archivo == false ) {

        echo "Error al crear el archivo";

            }

            else

            {

$cabeza='<?php

session_start();

?>

<html>

<head>

<title>'.$tabla.'upd2</title>

<script src="dat/js/jquery-3.6.0.min.js"></script>';

fwrite($archivo,$cabeza."\r\n");      



$s='$';

$c="'";



fwrite($archivo,"<?php \r\n");

fwrite($archivo,"include ('".$tabla."class.php');

".$s."tabla ='".$tabla."';

".$s."id    ='".$id."';

".$s."dev   = new Dev();

".$s."data  = array();

".$s."dato  = ".$s."_REQUEST['dato'];

if(strlen(".$s."dato)>0){

".$s."data=".$s."dev->SEARCH2(".$s."tabla, ".$s."id, ".$s."dato);");

fwrite($archivo,"\r\n");

fwrite($archivo,"foreach (".$s."data as ".$s."valor) { \r\n");

  $i=0;

foreach ($field3 as $valor) {

$recibe=$s.$valor->name."=".$s."valor[".$i++."];";

fwrite($archivo,$recibe."\r\n");

       }

fwrite($archivo,"}} \r\n");       

fwrite($archivo,"?> \r\n");

$x=0;  

$body='</head>

<body>'; 

fwrite($archivo,$body."\r\n");

fwrite($archivo,'

<h1>SEARCH</h1>

<form action="'.$tabla.'upd2.php" method="POST">');

fwrite($archivo,"\r\n<input type='TEXT' name='dato' placeholder='ID TO SEARCH' required>\r\n");

fwrite($archivo,"\r\n<input type='submit' value='SEARCH'>\r\n</form>");

      

      //FIELD

fwrite($archivo,'

<h1>UPDATE HERE</h1>

<form action="'.$tabla.'upd.php" method="POST">');

      $field = $this->getCampo($sqlQuery);

      $row   = $this->getCampo2($sqlQuery);

foreach ($field  as $valor) {

if( $valor->flags==53257 && strlen($tabla2)>0 ) //si existe Tabla Maestra

        {

fwrite($archivo,"\r\n");

fwrite($archivo,'<p>'.$valor->name.'</p>');

fwrite($archivo,"\r\n");

fwrite($archivo,'<SELECT NAME="'.$valor->name.'">');

fwrite($archivo,"\r\n");



foreach ($row as $dato) {

if($dato[0]==$data[$x++])

fwrite($archivo,'<OPTION VALUE="'.$dato[0].'" SELECTED ="selected"><?php echo "'.$dato[1].'"; ?></OPTION>');



fwrite($archivo,'<OPTION VALUE="'.$dato[0].'"> '.$dato[1].' </OPTION>');



fwrite($archivo,"\r\n");

            }

fwrite($archivo,'</SELECT>');

fwrite($archivo,"\r\n");

          }

        

        if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24

        if( $valor->flags==49667 )//primary 

          fwrite($archivo,"\r\n

          <input type='hidden' name='".$valor->name."'   placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

        if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24

        if( $valor->flags==53257 )//index

          fwrite($archivo,"\r\n

          <input type='hidden' name='".$valor->name."'   placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

          

        if($valor->type == 1  || $valor->type == 2 || $valor->type == 3 ||$valor->type == 8 || $valor->type == 9 )//numeros int 24

        if( $valor->flags!=49667 )//primary o index && $valor->flags!=53257

        fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

        <input type='number' name='".$valor->name."'   placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

        if($valor->type == 0  || $valor->type == 4 || $valor->type == 5 || $valor->type == 6 || $valor->type == 246 )//DECIMALES 

        fwrite($archivo,"<p>".$valor->name."</p>\r\n

        <input type='TEXT' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

        if($valor->type == 7)//fecha y hora

        fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

        <input type='datetime' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

        if($valor->type == 10)//fecha

        fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

        <input type='date' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

        if($valor->type == 11)//hora

        fwrite($archivo,"<p>".$valor->name."</p>\r\n

        <input type='time' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

        if($valor->type == 12)//fecha y hora

        fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

        <input type='datetime' name='".$valor->name."' placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

        if($valor->type==249 || $valor->type==250 || $valor->type==251 || $valor->type==252)//blob

        fwrite($archivo,"<p>".$valor->name."</p>\r\n

        <textarea id='".$valor->name."' name='".$valor->name."' rows='7' cols='60'><?php echo ".$s.$valor->name."; ?></textarea>");

        

        if($valor->type == 253 )//cadena

        fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

        <input type='text' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

        if($valor->type == 254 )//cadena 

        fwrite($archivo,"\r\n<p>".$valor->name."</p>\r\n

        <input type='text' name='".$valor->name."'  placeholder='".$valor->name."' value='<?php echo  ".$s.$valor->name."; ?>' required>");

        

         }

         

fwrite($archivo,"\r\n<input type='submit' value='UPDATE'>\r\n

</form>");

      

$regresar='<a href="../index2.php?Id=<?php echo $'.$id.'; ?>">Back</a>';

fwrite($archivo,$regresar."\r\n");

$cola='<p>© jimmyvillatoro77@gmail.com</p>

</body>

</html>';

        fwrite($archivo,$cola."\r\n");



        }  

      fflush($archivo);

      fclose($archivo);

        }



public function DELETE3($tabla, $id, $dato) { 

$sqlQuery = "DELETE FROM ".$tabla." WHERE ".$id."=".$dato." ";

    

$dir = "php2/".$tabla."/";

if (!file_exists($dir)) 

mkdir($dir, 0777, true);

      

$archivo = fopen($dir.$tabla."del.php","w+b");

if( $archivo == false ) {

echo "Error al crear el archivo";

          }

          else

          {

$s='$';

fwrite($archivo,"<?php

".$s."tabla ='".$tabla."';

".$s."id    ='".$id."';

".$s."dato  = ".$s."_REQUEST['dato'];

".$s."data=array();

include ('".$tabla."class.php');

".$s."dev = new Dev(); \r\n");



fwrite($archivo,"".$s."dev->DELETE(".$s."tabla, ".$s."id, ".$s."data);

?> \r\n");

      }  

      fflush($archivo);

      fclose($archivo);



}



public function DELETE4($tabla, $id, $dato) { 

$dir = "php2/".$tabla."/";

if (!file_exists($dir)) 

mkdir($dir, 0777, true);



$sqlQuery = "DELETE FROM ".$tabla." WHERE ".$id."=".$dato." ";

        

$archivo = fopen($dir.$tabla."del2.php","w+b");

if( $archivo == false ) {

echo "Error al crear el archivo";

            }

            else

            {

$cabeza='<?php

session_start();

?>

<html>

<head>

<title>'.$tabla.'del2</title>

<script src="dat/js/jquery-3.6.0.min.js"></script>';

fwrite($archivo,$cabeza."\r\n");      



$s='$';

$c="'";



fwrite($archivo,"<?php \r\n");

fwrite($archivo,"include ('".$tabla."class.php');

".$s."tabla ='".$tabla."';

".$s."id    ='".$id."';

".$s."dev   = new Dev();

".$s."dato  = ".$s."_REQUEST['dato'];

if(strlen(".$s."dato)>0)

".$s."dev->DELETE(".$s."tabla, ".$s."id, ".$s."dato);

");

fwrite($archivo,"?>");

fwrite($archivo,"\r\n");

$x=0;  

$body='</head>

       <body>'; 

fwrite($archivo,$body."\r\n");

fwrite($archivo,'

      <h1>DELETE</h1>

      <form action="'.$tabla.'del2.php" method="POST">');

fwrite($archivo,"\r\n<input type='TEXT' name='dato' placeholder='ID TO DELETE' required>\r\n");

fwrite($archivo,"\r\n<input type='submit' value='DELETE'>\r\n</form>");   

$regresar='<a href="../index2.php?Id=<?php echo $'.$id.'; ?>">Back</a>';

fwrite($archivo,$regresar."\r\n");

$cola='<p>© jimmyvillatoro77@gmail.com</p>

</body>

</html>';

fwrite($archivo,$cola."\r\n");

}  

fflush($archivo);

fclose($archivo);

}



public function SEARCH3($tabla, $id, $dato) { 

$sqlQuery = "SELECT * FROM ".$tabla." WHERE ".$id."=".$dato." ";

  

  $field = $this->getCampo($sqlQuery);

      

  $dir = "php2/".$tabla."/";

  if (!file_exists($dir)) 

  mkdir($dir, 0777, true);

        

  $archivo = fopen($dir.$tabla."sea.php","w+b");

  if( $archivo == false ) {

  echo "Error al crear el archivo";

            }

            else

            {

  $s='$';

  fwrite($archivo,"<?php

  ".$s."tabla ='".$tabla."';

  ".$s."id    ='".$id."';

  ".$s."dato  = ".$s."_REQUEST['dato'];

   include ('".$tabla."class.php');

  ".$s."dev = new Dev(); \r\n");

  

  fwrite($archivo,' if(strlen(".$s."dato)>0)

  ');

  fwrite($archivo,"".$s."dev->SEARCH(".$s."tabla, ".$s."id, ".$s."dato);

        ?> \r\n");

        }  

        fflush($archivo);

        fclose($archivo);

  

  }



public function SEARCH4($tabla, $id, $dato) { 

$dir = "php2/".$tabla."/";

  if (!file_exists($dir)) 

  mkdir($dir, 0777, true);

  

  $sqlQuery = "SELECT * FROM ".$tabla." WHERE ".$id."=".$dato." ";

          

  $archivo = fopen($dir.$tabla."sea2.php","w+b");

  if( $archivo == false ) {

  echo "Error al crear el archivo";

              }

              else

              {

  $cabeza='<?php

  session_start();

  ?>

  <html>

  <head>

  <link href="dat/css/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />

  <script type="text/javascript" src="dat/js/tablecloth.js"></script>

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

<script src="dat/js/jquery-3.6.0.min.js"></script>';

  fwrite($archivo,$cabeza."\r\n");      

  

  $s='$';

  $c="'";



  $x=0;  

  $body='</head>

  <body>'; 

  fwrite($archivo,$body."\r\n");

  fwrite($archivo,'

 <h1>SEARCH</h1>

 <form action="'.$tabla.'sea2.php" method="POST">');

  fwrite($archivo,"\r\n<input type='TEXT' name='dato' placeholder='ID TO SEARCH' required>\r\n");

  fwrite($archivo,"\r\n<input type='submit' value='SEARCH'>\r\n

          </form>");

     fwrite($archivo,"\r\n");    

     fwrite($archivo,"<?php \r\n");

  fwrite($archivo,"include ('".$tabla."class.php');

  ".$s."tabla ='".$tabla."';

  ".$s."id    ='".$id."';

  ".$s."dev   = new Dev();

  ".$s."dato  = ".$s."_REQUEST['dato'];

  if(strlen(".$s."dato)>0)

  ".$s."dev->SEARCH(".$s."tabla, ".$s."id, ".$s."dato);");

  fwrite($archivo,"\r\n");  

  fwrite($archivo,"?>\r\n");  

  fwrite($archivo,"\r\n");       

  $regresar='<a href="../index2.php?Id=<?php echo $'.$id.'; ?>">Back</a>';

  fwrite($archivo,$regresar."\r\n");

  $cola='<p>© jimmyvillatoro77@gmail.com</p>

  </body>

  </html>';

  fwrite($archivo,$cola."\r\n");

  }  

  fflush($archivo);

  fclose($archivo);

  }



public function SELECT3($tabla, $id){

$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";

  

    $field = $this->getCampo($sqlQuery);

        

    $dir = "php2/".$tabla."/";

    if (!file_exists($dir)) 

    mkdir($dir, 0777, true);

          

    $archivo = fopen($dir.$tabla."sel.php","w+b");

    if( $archivo == false ) {

    echo "Error al crear el archivo";

              }

              else

              {

$s='$';

fwrite($archivo,"<?php

".$s."tabla ='".$tabla."';

".$s."id    ='".$id."';

include ('".$tabla."class.php');

".$s."dev = new Dev(); \r\n");

     

fwrite($archivo,"".$s."dev->SELECT(".$s."tabla, ".$s."id);

?> \r\n");

          }  

fflush($archivo);

fclose($archivo);



      }





public function SELECT4($tabla, $id){

$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";

          

          $dir = "php2/".$tabla."/";

                  if (!file_exists($dir)) 

                  mkdir($dir, 0777, true);

                  

                                

                  $archivo = fopen($dir.$tabla."sel2.php","w+b");

                  if( $archivo == false ) {

                  echo "Error al crear el archivo";

                              }

                              else

                              {

$cabeza='<?php

session_start();

?>

<html>

<head>

<link href="dat/css/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" src="dat/js/tablecloth.js"></script>

<title>'.$tabla.'sel</title>

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

<script src="dat/js/jquery-3.6.0.min.js"></script>';

fwrite($archivo,$cabeza."\r\n");      

$body='</head>

<body>

<h1>SELECT</h1>'; 

fwrite($archivo, $body." \r\n");

fwrite($archivo," \r\n");                 

$s='$';

$c="'";

                  

fwrite($archivo,"<?php \r\n");

fwrite($archivo,"include ('".$tabla."class.php');

".$s."tabla ='".$tabla."';

".$s."id    ='".$id."';

".$s."dev   = new Dev();

".$s."dato  = ".$s."_REQUEST['dato'];

".$s."field=".$s."dev->SELECTfield(".$s."tabla, ".$s."id);

".$s."row=".$s."dev->SELECTrow(".$s."tabla, ".$s."id);

");

$c2='"';



fwrite($archivo,"echo".$c2."<div class='div-1' style='width:1200px; height:600px; overflow:auto;'>

<div id='content'>

<table> 

 <tr>".$c2.";

 ".$s."i=0;

 foreach (".$s."field  as ".$s."valor) {

 echo  '<th>'.".$s."valor->name.'</th>';

 ".$s."i++;

 }

 echo'</tr> <tr>';

   foreach (".$s."row as ".$s."valor) {

    ".$s."x=0;

   while(".$s."x<".$s."i){

   echo  '<td>'.".$s."valor[".$s."x].'</td>';

   ".$s."x++;

   }

   echo '</tr>';

   }

   echo '</table></div></br></div>';");

   fwrite($archivo," \r\n");

          fwrite($archivo,"?> \r\n");

                      

                        

          $regresar='<a href="../index2.php?Id=<?php echo $'.$id.'; ?>">Back</a>';

          fwrite($archivo,$regresar."\r\n");

          $cola='<p>© jimmyvillatoro77@gmail.com</p>

          </body>

          </html>';

          fwrite($archivo,$cola."\r\n");

                  }  

          fflush($archivo);

          fclose($archivo);

          

          }



public function SELECT5($tabla, $id){

$sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";

                      

$dir = "php2/".$tabla."/";

if (!file_exists($dir)) 

mkdir($dir, 0777, true);

                              

$archivo = fopen($dir.$tabla."sel3.php","w+b");

if( $archivo == false ) {

 echo "Error al crear el archivo";

 }

 else

 {

 $cabeza='<?php

session_start();

?>

<html>

<head>

<link href="dat/css/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" src="dat/js/tablecloth.js"></script>

<title>'.$tabla.'sel</title>

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

<script src="dat/js/jquery-3.6.0.min.js"></script>';

fwrite($archivo,$cabeza."\r\n");      

$s='$';

$c="'";

$body='</head>

<body>

<h1>SELECT</h1>

 '; 

fwrite($archivo, $body." \r\n");                              

 fwrite($archivo,"<?php \r\n");

fwrite($archivo,"include ('".$tabla."class.php');

".$s."tabla ='".$tabla."';

 ".$s."id    ='".$id."';

 ".$s."dev   = new Dev();

".$s."dato  = ".$s."_REQUEST['dato'];

".$s."campos=array();

".$s."field=".$s."dev->SELECTfield(".$s."tabla, ".$s."id);

".$s."row=".$s."dev->SELECTrow(".$s."tabla, ".$s."id);

");



$c2='"';

fwrite($archivo," \r\n");

fwrite($archivo,"echo".$c2."<div class='div-1' style='width:1200px; height:600px; overflow:auto;'>

<div id='content'>

<table> 

<tr><th>Edit</th>".$c2.";

".$s."i=0;

foreach (".$s."field  as ".$s."valor) {

 echo  '<th>'.".$s."valor->name.'</th>';

 ".$s."campos[".$s."i]=".$s."valor->name;

 ".$s."i++;

}

echo'</tr> <tr>';

 foreach (".$s."row as ".$s."valor) {

".$s."x=0;

 echo".$c2."<td><form action='".$tabla."upd.php' method='POST'>".$c2.";

 echo".$c2."<button type='submit' class='btn btn-success'>Edit</button></td>".$c2.";   

while(".$s."x<".$s."i){



if(".$s."valor->type == 1  || ".$s."valor->type == 2 || ".$s."valor->type == 3 ||".$s."valor->type == 8 || ".$s."valor->type == 9 )//numeros int 24

echo".$c2."<td><input type='number' name='".$c2.".".$s."campos[".$s."x].".$c2."'  placeholder='".$c2.".".$s."campos[".$s."x].".$c2."' value='".$s."valor[".$s."x]' required></td>  \r\n".$c2.";

  

if(".$s."valor->type == 0  || ".$s."valor->type == 4 || ".$s."valor->type == 5 || ".$s."valor->type == 6 || ".$s."valor->type == 246 )//DECIMALES 

echo".$c2."<td><input type='TEXT' name='".$c2.".".$s."campos[".$s."x].".$c2."'  placeholder='".$c2.".".$s."campos[".$s."x].".$c2."' value='".$s."valor[".$s."x]' required></td>  \r\n".$c2.";



if(".$s."valor->type == 7)//fechas

echo".$c2."<td><input type='datetime-local' name='".$c2.".".$s."campos[".$s."x++].".$c2."'  placeholder='".$c2.".".$s."campos2[".$s."x].".$c2."' value='".$s."valor[".$s."x]' required></td>  \r\n".$c2.";

if(".$s."valor->type == 10)

echo".$c2."<td><input type='date' name='".$c2.".".$s."campos[".$s."x].".$c2."'  placeholder='".$c2.".".$s."campos[".$s."x].".$c2."' value='".$s."valor[".$s."x]' required></td>  \r\n".$c2.";

if(".$s."valor->type == 11)

echo".$c2."<td><input type='time' name='".$c2.".".$s."campos[".$s."x].".$c2."'  placeholder='".$c2.".".$s."campos[".$s."x].".$c2."' value='".$s."valor[".$s."x]' required></td>  \r\n".$c2.";

if(".$s."valor->type == 12)

echo".$c2."<td><input type='datetime-local' name='".$c2.".".$s."campos[".$s."x].".$c2."'  placeholder='".$c2.".".$s."campos[".$s."x].".$c2."' value='".$s."valor[".$s."x]' required></td>  \r\n".$c2.";



if(".$s."valor->type==249 || ".$s."valor->type==250 || ".$s."valor->type==251 || ".$s."valor->type==252)//blob

echo".$c2."<td><textarea id='".$s."valor->name' name='".$c2.".".$s."campos[".$s."x].".$c2."' rows='10' cols='100'>".$s."valor[".$s."x]</textarea></td>  \r\n".$c2.";

 

if(".$s."valor->type == 253)//cadena

echo".$c2."<td><input type='text' name='".$c2.".".$s."campos[".$s."x].".$c2."'  placeholder='".$c2.".".$s."campos[".$s."x].".$c2."' value='".$s."valor[".$s."x]' required></td>  \r\n".$c2.";

if(".$s."valor->type == 254)

echo".$c2."<td><input type='text' name='".$c2.".".$s."campos[".$s."x].".$c2."'  placeholder='".$c2.".".$s."campos[".$s."x].".$c2."' value='".$s."valor[".$s."x]' required></td>  \r\n".$c2.";



".$s."x++;

 }

 echo '</form></tr>';

 }

 

echo '</table></div></br></div>';");

fwrite($archivo," \r\n");

fwrite($archivo,"?> \r\n");

              

$regresar='<a href="../index2.php?Id=<?php echo $'.$id.'; ?>">Back</a>';

 fwrite($archivo,$regresar."\r\n");

$cola='<p>© jimmyvillatoro77@gmail.com</p>

 </body>

</html>';

fwrite($archivo,$cola."\r\n");

 }  

fflush($archivo);

 fclose($archivo);

                      

}

            

public function SELECT6($tabla, $id){

  $sqlQuery = "SELECT * FROM ".$tabla." ORDER BY  ".$id." ";

                        

  $dir = "php2/".$tabla."/";

  if (!file_exists($dir)) 

  mkdir($dir, 0777, true);

                                

  $archivo = fopen($dir.$tabla."sel4.php","w+b");

  if( $archivo == false ) {

   echo "Error al crear el archivo";

   }

   else

   {

   $cabeza='<?php

  session_start();

  ?>

  <html>

  <head>

  <link href="dat/css/tablecloth.css" rel="stylesheet" type="text/css" media="screen" />

  <script type="text/javascript" src="dat/js/tablecloth.js"></script>

  <title>'.$tabla.'sel4</title>

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

  <script src="dat/js/jquery-3.6.0.min.js"></script>';

  fwrite($archivo,$cabeza."\r\n");      

  $s='$';

  $c="'";

  $body='</head>

  <body>

  <h1>Select '.$tabla.'</h1>

   '; 

  fwrite($archivo, $body." \r\n");

  

  

  fwrite($archivo,"<?php \r\n");

  fwrite($archivo,"include ('".$tabla."class.php');

  ".$s."tabla ='".$tabla."';

  ".$s."id    ='".$id."';

  ".$s."dev   = new Dev();

  ".$s."dato  = ".$s."_REQUEST['dato'];

  ".$s."campos=array();

  ".$s."field=".$s."dev->SELECTfield(".$s."tabla, ".$s."id);

  ".$s."row=".$s."dev->SELECTrow2(".$s."tabla, ".$s."id);

  ");

  $c2='"';

  

  fwrite($archivo,"echo".$c2."<div class='div-1' style='width:1200px; height:600px; overflow:auto;'>

  <div id='content'>

  <table> 

   <tr><th>Select</th>".$c2.";

   ".$s."i=0;

   foreach (".$s."field  as ".$s."valor) {

   echo  '<th>'.".$s."valor->name.'</th>';

   ".$s."campos[".$s."i]=".$s."valor->name;

   ".$s."i++;

   }

   echo'</tr><tr>';



     foreach (".$s."row as ".$s."valor) {

      ".$s."x=0;

      echo".$c2."<td><form action='".$tabla."sel4.php' method='GET'>

      <input type='hidden' name='Id'   value='".$s."valor[0]' >

      <input type='hidden' name='Name'   value='".$s."valor[2]' > 

      <input type='submit' value='SELECT'> 

      </td>".$c2.";

     while(".$s."x<".$s."i){

     echo  '<td>'.".$s."valor[".$s."x].'</td>';

     ".$s."x++;

     }

     echo '</form></tr>';

     }

     echo '</table></div></br></div>';");

fwrite($archivo," \r\n");

fwrite($archivo,"?> \r\n");



            $c2='"';

fwrite($archivo,"<?php 

".$s."Id= utf8_decode(".$s."_GET['Id']); 

if(".$s."Id>0){

?>

<div id='container'>

<h2>Name: <?php 

".$s."Id= utf8_decode(".$s."_GET['Id']); 

echo ".$s."Name=utf8_decode(".$s."_GET['Name']); 



".$s."tabla ='".$tabla."';

".$s."id    ='".$id."';

".$s."name  ='Name';

".$s."field2=".$s."dev->SELECTfield(".$s."tabla, ".$s."id);

".$s."row2=".$s."dev->SELECTrow3(".$s."tabla, ".$s."id, ".$s."name, ".$s."Id);



foreach (".$s."row2 as ".$s."valor2) {

  ".$s."x=0;

  while(".$s."x<".$s."i){

    ".$s."Idp2=".$s."valor2[".$s."x];

  ".$s."x++;

  }

  }

  ".$s."Idp2=".$s."valor2[0];



".$s."row3=".$s."dev->SELECTrow3(".$s."tabla, ".$s."id, ".$s."name, ".$s."Idp2);



foreach (".$s."row3 as ".$s."valor3) {

  ".$s."y=0;

  while(".$s."y<".$s."i){

    ".$s."Namex=".$s."valor3[".$s."y];

  ".$s."y++;

  }

  }

".$s."Namex=".$s."valor3[1];



 ".$s."row4=".$s."dev->SELECTrow4(".$s."tabla, ".$s."id, ".$s."Id);



?>"); 



fwrite($archivo,"<h2>Select Sub".$tabla."</h2>

<form action='".$tabla."sel4.php' method='GET'>

<input type='hidden' name='Id'   value='<?php echo ".$s."Idp2; ?>' >

<input type='hidden' name='Name'   value='<?php echo ".$s."Namex; ?>' >

<td>

<input type='submit' value='BACK'>

</td>  

</form>");



fwrite($archivo,"<?php \r\n");

fwrite($archivo,"echo".$c2."<div class='div-1' style='width:1200px; height:600px; overflow:auto;'>

<div id='content'>

<table> 

<tr><th>Select</th>".$c2.";

".$s."i=0;

foreach (".$s."field2  as ".$s."valor) {

echo  '<th>'.".$s."valor->name.'</th>';

".$s."campos[".$s."i]=".$s."valor->name;

".$s."i++;

}

echo'</tr> <tr>';

          

foreach (".$s."row4 as ".$s."valor) {

".$s."x=0;

echo".$c2."<form action='".$tabla."sel4.php' method='GET'>

<input type='hidden' name='Id'   value='".$s."valor[0]' >

<input type='hidden' name='Name'   value='".$s."valor[2]' > 

<td>

<input type='submit' value='SELECT'> 

</td>".$c2.";

while(".$s."x<".$s."i){

echo  '<td>'.".$s."valor[".$s."x].'</td>';

".$s."x++;

}

echo '</form></tr>';

}

echo '</table></div></br></div>';");

fwrite($archivo," \r\n");

fwrite($archivo,"?> \r\n");

  

fwrite($archivo,"<?php } 

?>");

                

  $regresar='<a href="../index2.php?Id=<?php echo $'.$id.'; ?>">Back</a>';

   fwrite($archivo,$regresar."\r\n");

  $cola='<p>© jimmyvillatoro77@gmail.com</p>

   </body>

  </html>';

  fwrite($archivo,$cola."\r\n");

   }  

  fflush($archivo);

   fclose($archivo);

                        

  }



// la clases para los archivos

public function CLASE($tabla) { 

$s='$';

$p='.';

$c="'";

$c2='"';

$cx=$s.'c="'.$c.'";';

$cx2=$s."c='".$c2."';";



$dir = "php2/".$tabla."/";

if (!file_exists($dir)) 

 mkdir($dir, 0777, true);

        

$archivo = fopen($dir.$tabla."class.php","w+b");

if( $archivo == false ) {

echo "Error al crear el archivo";

            }

            else

            {

fwrite($archivo,"<?php 



class Dev{



      public ".$s."host       = 'localhost';

      public ".$s."user       = 'web238_13';

      public ".$s."password   = 'us1317mx@';

      public ".$s."database   = 'web238_db13';

      public ".$s."dbConnect  = false;

      private static ".$s."conn;



public function __construct(){

        if(!".$s."this->dbConnect){ 

          ".$s."conn = new mysqli(".$s."this->host, ".$s."this->user, ".$s."this->password, ".$s."this->database);

            if(".$s."conn->connect_error){

                die('Error failed to connect to MySQL: ' . ".$s."conn->connect_error);

            }else{

              ".$s."this->dbConnect = ".$s."conn;

            }

        }

    }



//los campos de la tabla

public function getCampo(".$s."sqlQuery) {

  ".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlQuery);

    if(!".$s."result){

      die('Error in query: '. mysqli_error(".$s."conn));

    }

      return  mysqli_fetch_fields(".$s."result);

  } 



//registros de la tabla

public function getCampo2(".$s."sqlQuery) {

    ".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlQuery);

    if(!".$s."result){

      die('Error in query: '. mysqli_error(".$s."conn));

    }

    ".$s."data= array();

    while (".$s."row = mysqli_fetch_array(".$s."result)) {

      ".$s."data[]=".$s."row;            

    }

    return ".$s."data;

  }



//numero de campos de la tabla

public function getCampo3(".$s."sqlQuery) {

  ".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlQuery);

    if(!".$s."result){

      die('Error in query: '. mysqli_error(".$s."conn));

    }

return count(mysqli_fetch_fields(".$s."result));

  }

 

//los registros de la tabla desde una funcion en this class

private function getData(".$s."sqlQuery) {

  ".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlQuery);

    if(!".$s."result){

      die('Error in query: '. mysqli_error(".$s."conn));

    }

    ".$s."data= array();

    while (".$s."row = mysqli_fetch_assoc (".$s."result)) {

      ".$s."data[]=".$s."row;            

    }

    return ".$s."data;

  }



//numero de registros de la tabla

private function getNumRows(".$s."sqlQuery) {

  ".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlQuery);

    if(!".$s."result){

      die('Error in query: '. mysqli_error(".$s."conn));

    }

    ".$s."numRows = mysqli_num_rows(".$s."result);

    return ".$s."numRows;

  }



//borra un registros de la tabla  

public function DELETE(".$s."tabla, ".$s."id, ".$s."dato){

    ".$s."sqlQuery = 'DELETE FROM ".$c.$p.$s."tabla".$p.$c." WHERE ".$c.$p.$s."id".$p.$c."=".$c.$p.$s."dato".$p.$c." ';

    ".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlQuery); 

    if(!".$s."result){

      return ('Error in query: '. mysqli_error(".$s."conn));   

  }

}



//selecciona los registros de la tabla

public function SELECT(".$s."tabla, ".$s."id){

".$s."sqlQuery = 'SELECT * FROM ".$c.$p.$s."tabla".$p.$c." ORDER BY  ".$c.$p.$s."id".$p.$c." ';

".$s."field = ".$s."this->getCampo(".$s."sqlQuery);

echo '<table>

<tr>';

".$s."i=0;

foreach (".$s."field  as ".$s."valor) {

echo  '<th>'.".$s."valor->name.'</th>';

".$s."i++;

}

echo '</tr>

</table>';



".$s."row   = ".$s."this->getCampo2(".$s."sqlQuery);

echo '<table>

<tr>';



foreach (".$s."row as ".$s."valor) {

".$s."x=0;

while(".$s."x<".$s."i){

echo  '<td>'.".$s."valor[".$s."x].'</td>';

".$s."x++;

}

echo '</tr>';

}

echo '</table>';

}





//select  los campos dela tabla retorna en arreglo

public function SELECTfield(".$s."tabla, ".$s."id){

  ".$s."sqlQuery = 'SELECT * FROM ".$c.$p.$s."tabla".$p.$c." ORDER BY  ".$c.$p.$s."id".$p.$c." ';

  ".$s."field = ".$s."this->getCampo(".$s."sqlQuery);

    return ".$s."field;

      }



//select  los registros de la tabla retorna en arreglo

public function SELECTrow(".$s."tabla, ".$s."id){

    ".$s."sqlQuery = 'SELECT * FROM ".$c.$p.$s."tabla".$p.$c." ORDER BY  ".$c.$p.$s."id".$p.$c." ';

    ".$s."row   = ".$s."this->getCampo2(".$s."sqlQuery);

        return ".$s."row; 

          }



//select  todos los registros de la tabla retorna en arreglo que su recursiva sea 0

public function SELECTrow2(".$s."tabla, ".$s."id){

".$s."Id=".$s."id.'2';

".$s."sqlQuery = 'SELECT * FROM ".$c.$p.$s."tabla".$p.$c." WHERE ".$c.$p.$s."Id".$p.$c."=0 ORDER BY  ".$c.$p.$s."id".$p.$c." ';

".$s."row   = ".$s."this->getCampo2(".$s."sqlQuery);

return ".$s."row; 

}



//select  Id y Nombre de la tabla retorna en arreglo que su recursiva sea 0

public function SELECTrow3(".$s."tabla, ".$s."id, ".$s."name, ".$s."value){

".$s."Id=".$s."id.'2';

".$s."sqlQuery = 'SELECT ".$c.$p.$s."Id".$p.$c.", ".$c.$p.$s."name".$p.$c." FROM ".$c.$p.$s."tabla".$p.$c." WHERE ".$c.$p.$s."id".$p.$c."=".$c.$p.$s."value".$p.$c." ORDER BY  ".$c.$p.$s."id".$p.$c." ';

".$s."row   = ".$s."this->getCampo2(".$s."sqlQuery);

return ".$s."row; 

}



//select  todos los registros de la tabla retorna en arreglo que su recursiva sea un numero dado

public function SELECTrow4(".$s."tabla, ".$s."id, ".$s."id2){

".$s."Id=".$s."id.'2';

".$s."sqlQuery = 'SELECT * FROM ".$c.$p.$s."tabla".$p.$c." WHERE ".$c.$p.$s."Id".$p.$c."=".$c.$p.$s."id2".$p.$c." ORDER BY  ".$c.$p.$s."id".$p.$c." ';

".$s."row   = ".$s."this->getCampo2(".$s."sqlQuery);

return ".$s."row; 

}



//busca un registro de la tabla

public function SEARCH(".$s."tabla, ".$s."id, ".$s."dato){

".$s."sqlQuery = 'SELECT * FROM ".$c.$p.$s."tabla".$p.$c." WHERE ".$c.$p.$s."id".$p.$c."=".$c.$p.$s."dato".$p.$c." ';

".$s."field = ".$s."this->getCampo(".$s."sqlQuery);

".$s."row   = ".$s."this->getCampo2(".$s."sqlQuery);



echo".$c2."<div class='div-1' style='width:1200px; height:200px; overflow:auto;'>

<div id='content'>

<table> 

 <tr>".$c2.";

".$s."i=0;

foreach (".$s."field  as ".$s."valor) {

echo  '<th>'.".$s."valor->name.'</th>';

".$s."i++;

}

echo '</tr><tr>';

foreach (".$s."row as ".$s."valor) {

".$s."x=0;

while(".$s."x<".$s."i){

echo  '<td>'.".$s."valor[".$s."x].'</td>';

".$s."x++;

}

echo '</tr>';

}

echo '</table></div></br></div>';

}



//busca un registro de la tabla

public function SEARCH2(".$s."tabla, ".$s."id, ".$s."dato){

".$s."sqlQuery = 'SELECT * FROM ".$c.$p.$s."tabla".$p.$c." WHERE ".$c.$p.$s."id".$p.$c."=".$c.$p.$s."dato".$p.$c." ';

".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlQuery);

if(!".$s."result){

  die('Error in query: '. mysqli_error(".$s."conn));

}

".$s."data= array();

while (".$s."row = mysqli_fetch_array(".$s."result)) {

  ".$s."data[]=".$s."row;            

}

  return ".$s."data;

  

}



//insert

public function INSERT(".$s."tabla, ".$s."id, ".$s."data=array()) { 

".$s."consulta = 'SELECT * FROM '.".$s."tabla; 

".$s."cadena1='';

".$s."cadena2='';

".$s."cadena3='';

  ".$cx."

  ".$cx2."

  ".$s."p='.';

  ".$s."s='$';

".$s."resultado=mysqli_query(".$s."this->dbConnect, ".$s."consulta);

".$s."info_campo = mysqli_fetch_fields(".$s."resultado);

".$s."fila = mysqli_fetch_array(".$s."resultado);

".$s."field_cnt = ".$s."resultado->field_count;



foreach (".$s."info_campo as ".$s."valor) {

if( ".$s."valor->flags==49667){

".$s."primary=".$s."valor->name;

".$s."ban=1;

}

if(".$s."valor->flags==53257 && ".$s."ban==2){

".$s."terciary=".$s."valor->name;

".$s."ban=3;}

if(".$s."valor->flags==53257){

".$s."secundary=".$s."valor->name;

".$s."ban=2;}



if( ".$s."valor->flags!=49667){

".$s."cadena1.=".$s."valor->name.', ';

if(".$s."ban==1){

 ".$s."bus=".$s."valor->name;

 ".$s."ban=4;

}

}

   }



//---------- INSERT DATA



".$s."consulta3 = 'SELECT * FROM '.".$s."tabla; 

".$s."resultado3=mysqli_query(".$s."this->dbConnect, ".$s."consulta3);

".$s."info_campo3 = mysqli_fetch_fields(".$s."resultado3);

".$s."fila = mysqli_fetch_array(".$s."resultado3);

".$s."field_cnt = ".$s."resultado3->field_count;



".$s."sql3 = 'INSERT INTO '.".$s."tabla.'(';  

".$s."myString = substr(".$s."cadena1, 0, -2);

  ".$s."sql3.= ".$s."myString.') VALUES (';

  ".$s."i=0;

foreach (".$s."info_campo3 as ".$s."valor) {

if( ".$s."valor->flags!=49667)

".$s."cadena3.=' '.".$s."c.''.".$s."data[".$s."i++].''.".$s."c.', ';

   } 

   ".$s."myString = substr(".$s."cadena3, 0, -2);

   ".$s."sql3.=".$s."myString.')';

     

".$s."sqlInsert=' '.".$s."sql3.' ';

//echo ".$s."sqlInsert;



//---------- INSERT DATA



if(strlen(".$s."data[0])>0){

    ".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlInsert);

    if(!".$s."result){

      return ('Error in query: '. mysqli_error(".$s."conn));

    } }

  }



//update

public function UPDATE(".$s."tabla, ".$s."id, ".$s."data=array()) {   

".$s."consulta = 'SELECT * FROM '.".$s."tabla; 

".$s."cadena1='';

".$s."cadena2='';

".$s."cadena3='';

  ".$cx."

  ".$cx2."

  ".$s."p='.';

  ".$s."s='$';



".$s."resultado=mysqli_query(".$s."this->dbConnect, ".$s."consulta);

".$s."info_campo = mysqli_fetch_fields(".$s."resultado);

".$s."fila = mysqli_fetch_array(".$s."resultado);

".$s."field_cnt = ".$s."resultado->field_count;



foreach (".$s."info_campo as ".$s."valor) {

if( ".$s."valor->flags==49667){

".$s."primary=".$s."valor->name;

".$s."ban=1;

}

if(".$s."valor->flags==53257 && ".$s."ban==2){

".$s."terciary=".$s."valor->name;

".$s."ban=3;}

if(".$s."valor->flags==53257){

".$s."secundary=".$s."valor->name;

".$s."ban=2;}



if( ".$s."valor->flags!=49667){

".$s."cadena1.=".$s."valor->name.', ';

if(".$s."ban==1){

 ".$s."bus=".$s."valor->name;

 ".$s."ban=4;

}

}

   }



//---------- UPDATE DATA

".$s."consulta3 = 'SELECT * FROM '.".$s."tabla; 

".$s."resultado3=mysqli_query(".$s."this->dbConnect, ".$s."consulta3);

".$s."info_campo3 = mysqli_fetch_fields(".$s."resultado3);

".$s."fila = mysqli_fetch_array(".$s."resultado3);

".$s."field_cnt = ".$s."resultado3->field_count;

".$s."sql3 =  'UPDATE '.".$s."tabla.' SET ';   

  ".$s."i=0;

foreach (".$s."info_campo3 as ".$s."valor) {

".$s."cadena3.=".$s."valor->name.'='.' '.".$s."c.".$s."data[".$s."i++].".$s."c.', ';

   } 

   ".$s."myString = substr(".$s."cadena3, 0, -2);

   ".$s."sql3.=".$s."myString.'  WHERE   '.".$s."primary.' = '.".$s."c.".$s."data[0].".$s."c.' ';  

".$s."sqlUserUpdate=".$s."sql3;

//echo ".$s."sqlUserUpdate;



//---------- UPDATE DATA



if(strlen(".$s."data[0])>0){

".$s."result = mysqli_query(".$s."this->dbConnect, ".$s."sqlUserUpdate); 

    if(!".$s."result){

      return ('Error in query: '. mysqli_error(".$s."conn));

    } 

  }

  }





}

?>\r\n");

            }

            

fflush($archivo);

fclose($archivo);

        }



//------------------------------------------------------------------------------copy



public function COPY($txt){

echo "</br>";

$dir3 = "php2/".$txt."/dat/js";

if (!file_exists($dir3)) 

mkdir($dir3, 0777, true);



//copy('dat/js/jquery-3.6.0.min.js','php/'.$txt.'/dat/js/jquery-3.6.0.min.js');

copy('dat/js/tablecloth.js','php2/'.$txt.'/dat/js/tablecloth.js');



$dir3 = "php2/".$txt."/dat/css";

if (!file_exists($dir3)) 

mkdir($dir3, 0777, true);

copy('dat/css/tablecloth.css','php2/'.$txt.'/dat/css/tablecloth.css');



$dir3 = "php2/".$txt."/dat/img";

if (!file_exists($dir3)) 

mkdir($dir3, 0777, true);

copy('dat/img/tr_back.gif','php2/'.$txt.'/dat/img/tr_back.gif');

}



}//class end

?>

