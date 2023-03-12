<?php
   $host        = "host=containers-us-west-91.railway.app";
   $port        = "port=6716";
   $dbname      = "railway";
   $credentials = "user=postgres password=prvm9G0AIfBEwjaPjGKu";

   $db = pg_connect("$host $port dbname=$dbname $credentials");
   
   if(!$db) {
      echo "Erro : Não foi possível conectar ao banco de dados PostgreSQL.";
   } else {
      echo "Conexão bem sucedida.";
   }
?>
