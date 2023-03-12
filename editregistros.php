<?php
// Conexão com postgreSQL 
$conn = pg_connect("host=containers-us-west-91.railway.app port=6716 dbname=railway user=postgres password=prvm9G0AIfBEwjaPjGKu");
$id = $_GET['updateid'];

// Obter os dados do formulário
$nome = isset($_POST['nome']) ? pg_escape_string($conn, $_POST['nome']) : "";
$sobrenome = isset($_POST['sobrenome']) ? pg_escape_string($conn, $_POST['sobrenome']) : "";
$cep = isset($_POST['cep']) ? pg_escape_string($conn, $_POST['cep']) : "";
$rua = isset($_POST['rua']) ? pg_escape_string($conn, $_POST['rua']) : "";
$bairro = isset($_POST['bairro']) ? pg_escape_string($conn, $_POST['bairro']) : "";
$cidade = isset($_POST['cidade']) ? pg_escape_string($conn, $_POST['cidade']) : "";
$uf = isset($_POST['uf']) ? pg_escape_string($conn, $_POST['uf']) : "";
$numero = isset($_POST['numero']) ? pg_escape_string($conn, $_POST['numero']) : "";
$complemento = isset($_POST['complemento']) ? pg_escape_string($conn, $_POST['complemento']) : "";

// validação dos dados do formulário
$nome = htmlspecialchars($nome);
$sobrenome = htmlspecialchars($sobrenome);
$cep = htmlspecialchars($cep);
$rua = htmlspecialchars($rua);
$bairro = htmlspecialchars($bairro);
$cidade = htmlspecialchars($cidade);
$uf = htmlspecialchars($uf);
$numero = htmlspecialchars($numero);
$complemento = htmlspecialchars($complemento);

// Construção da consulta SELECT 
$sql_select = "SELECT * FROM usuarios WHERE nome = $1 AND sobrenome = $2 AND cep = $3 AND rua = $4 AND bairro = $5 AND cidade = $6 AND uf = $7 AND numero = $8 AND complemento = $9";
$params_select = array($nome, $sobrenome, $cep, $rua, $bairro, $cidade, $uf, $numero, $complemento);

// Consulta para preenchimento dos campos
$sql_select = "SELECT * FROM usuarios WHERE id = $1";
$params_select = array($id);
$result_select = pg_query_params($conn, $sql_select, $params_select);
$row = pg_fetch_assoc($result_select);

// Execução da consulta SELECT
$result_select = pg_query_params($conn, $sql_select, $params_select);

// Verificar se já existe um registro com os mesmos valores
if (pg_num_rows($result_select) > 0) {
    //echo "Os dados já existem no banco de dados.";
    echo "";
} else {
    // Construção do UPDATE 
    $sql_update = "UPDATE usuarios SET nome=$1, sobrenome=$2, cep=$3, rua=$4, bairro=$5, cidade=$6, uf=$7, numero=$8, complemento=$9 WHERE id=$10";
    $params_update = array($nome, $sobrenome, $cep, $rua, $bairro, $cidade, $uf, $numero, $complemento, $id);

    // Execução do UPDATE
    $result_update = pg_query_params($conn, $sql_update, $params_update);

    // Checar se o UPDATE funcionou
    if ($result_update) {
        echo "Formulário atualizado!";
        //header('location:display.php');
    } else {
        echo "Erro ao atualizar" . pg_last_error($conn);
    }
}

// Fechar conexão
pg_close($conn);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="regtab.css">
    <title>Editar Registro</title>
</head>

<body>
    <!-- Inicio da edição de registro -->
    <div class="box">
        <form method="POST">
            <fieldset>
                <legend><b>Editar Registro</b></legend>
                <br>
                <div class="inputBox"></div>
                <label for="nome" class="labelInput"> Nome:
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $row['nome']; ?>" />
                </label><br><br>

                <div class="inputBox"></div>
                <label for="sobrenome" class="labelInput"> Sobrenome:
                    <input type="text" name="sobrenome" id="sobrenome" class="inputUser" value="<?php echo $row['sobrenome']; ?>" />
                </label><br><br>

                <div class="inputBox"></div>
                <label for="cep" class="labelInput">Cep:
                    <input name="cep" type="text" id="cep" size="10" maxlength="9" class="inputUser" value="<?php echo $row['cep']; ?>" />
                </label><br><br>

                <div class="inputBox"></div>
                <label for="rua" class="labelInput">Rua:
                    <input name="rua" type="text" id="rua" size="auto" class="inputUser" value="<?php echo $row['rua']; ?>" />
                </label><br><br>

                <div class="inputBox"></div>
                <label for="bairro" class="labelInput">Bairro:
                    <input name="bairro" type="text" id="bairro" size="auto" class="inputUser" value="<?php echo $row['bairro']; ?>" />
                </label><br><br>

                <div class="inputBoxRead"></div>
                <label>Cidade:
                    <input name="cidade" size="auto" class="inputUser" id="cidade" type="text" value="<?php echo $row['cidade']; ?>" />
                </label><br><br>

                <div class="inputBoxRead"></div>
                <label>Estado:
                    <input name="uf" size="auto" class="inputUser" id="uf" type="text" value="<?php echo $row['uf']; ?>" />
                </label><br><br>

                <div class="inputBox"></div>
                <label for="numero" class="labelInput">Número:
                    <input name="numero" size="auto" class="inputUser" id="numero" type="number" value="<?php echo $row['numero']; ?>"/>
                </label><br><br>

                <div class="inputBox"></div>
                <label for="complemento" class="labelInput">Complemento:
                    <input name="complemento" size="auto" class="inputUser" id="complemento" type="textarea" value="<?php echo $row['complemento']; ?>"/>
                </label><br><br>

                <button type="submit" class="btn" id="submit">Salvar Edição</button><br><br>
                
                <a href="display.php" class="btn-custom" id="index">Retornar Página</a><br>

                <a href="index.php" class="btn-custom" id="index">Cadastrar novo</a>



            </fieldset>
        </form>
    </div>
</body>

</html>
