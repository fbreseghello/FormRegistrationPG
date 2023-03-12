<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="edit.css">
  <title>Administração</title>
  <script>
    function confirmDelete() {
      return confirm("Tem certeza que deseja deletar o usuário?");
    }
  </script>
</head>

<body>
  <div class="container" style="overflow-x:auto;">
    <table class="box">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nome</th>
          <th scope="col">Sobrenome</th>
          <th scope="col">Cep</th>
          <th scope="col">Rua</th>
          <th scope="col">Bairro</th>
          <th scope="col">Cidade</th>
          <th scope="col">Estado</th>
          <th scope="col">Número</th>
          <th scope="col">Complemento</th>
          <th scope="col">Ação
          </th>
        </tr>
      </thead>
      <tbody>
        <?php

                // Define as credenciais de conexão ao banco de dados
                $dbname = "railway";
                $user = "postgres";
                $password = "prvm9G0AIfBEwjaPjGKu";
                $host = "containers-us-west-91.railway.app";
                $port = "6716";

                // Conecte-se ao banco de dados
                $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

                // Defina a consulta que deseja executar
                $sql = "SELECT * FROM usuarios" ;

                // Execute a consulta
                $result = pg_query($conn, $sql);

                // Itere sobre os dados e exiba o nome de cada usuário
                while ($row = pg_fetch_assoc($result)) {
                    $id=$row['id'];
                    $name=$row['nome'];
                    $sobrenome=$row['sobrenome'];
                    $cep=$row['cep'];
                    $rua=$row['rua'];
                    $bairro=$row['bairro'];
                    $cidade=$row['cidade']; 
                    $uf=$row['uf'];
                    $numero=$row['numero'];
                    $complemento=$row['complemento'];
                    echo '            
                    <tr>
                        <td scope="row">'.$id.'</td>
                        <td>'.$name.'</td>
                        <td>'.$sobrenome.'</td>
                        <td>'.$cep.'</td>
                        <td>'.$rua.'</td>
                        <td>'.$bairro.'</td>
                        <td>'.$cidade.'</td>
                        <td>'.$uf.'</td>
                        <td>'.$numero.'</td>
                        <td>'.$complemento.'</td>
                        <div class="button-group">
                        <td>
                        <button class="btn"><a href="editregistros.php?updateid='.$id.'"title="Editar"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#d00000" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                        </a>
                        </button>

                        <a href="delete.php?deleteid='.$id.'" onclick="return confirmDelete();" title="Deletar"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#1a89c9" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                        </a>
                        </button>
                       </td>
                    </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>
