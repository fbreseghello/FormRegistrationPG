<?php
   $host        = "";
   $port        = "";
   $dbname      = "";
   $credentials = "";

   $db = pg_connect("$host $port dbname=$dbname $credentials");
   
   if(!$db) {
      echo "Erro : Não foi possível conectar ao banco de dados PostgreSQL.";
   } else {
      echo "Conexão bem sucedida.";
   }
?>
