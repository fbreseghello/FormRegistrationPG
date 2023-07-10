<?php

// Define as credenciais de conexão ao banco de dados
$dbname = "";
$user = "";
$password = "";
$host = "";
$port = "";

// Conectar ao banco de dados
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM \"usuarios\" WHERE id=$id";
    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Usuário deletado!";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/styeldel.css">
    <title>Editar Registro</title>
</head>

<body>
    <!-- Inicio da edição de registro -->
    <div class="box" style="overflow-x:auto;">
        <form method="POST">
            <fieldset>
                <legend><b>Usuário Apagado!</b></legend>
                <br><br>              
                <a href="display.php" class="btn3">Retornar</a>
                </button>
            </fieldset>
        </form>
    </div>
</body>

</html>
