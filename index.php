<?php
// Conexão com postgreSQL 
$conn = pg_connect("host=containers-us-west-91.railway.app port=6716 dbname=railway user=postgres password=prvm9G0AIfBEwjaPjGKu");

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

// Execução da consulta SELECT
$result_select = pg_query_params($conn, $sql_select, array($nome, $sobrenome, $cep, $rua, $bairro, $cidade, $uf, $numero, $complemento));

// Verificar se já existe um registro com os mesmos valores
if (pg_num_rows($result_select) > 0) {
    //echo "Os dados já existem no banco de dados.";
    echo "";
} else {
    // Construção do INSERT 
    $sql_insert = "INSERT INTO usuarios (nome, sobrenome, cep, rua, bairro, cidade, uf, numero, complemento)
    VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)";

    // Execução do INSERT
    $result_insert = pg_query_params($conn, $sql_insert, array($nome, $sobrenome, $cep, $rua, $bairro, $cidade, $uf, $numero, $complemento));

    // Checar se o INSERT funcionou
    if ($result_insert) {
        echo "Formulário enviado!";
        //header('location:display.php');
    } else {
        echo "Erro ao inserir" . pg_last_error($conn);
    }
}


// Fechar conexão
pg_close($conn);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro | Concept Prime</title>

    <!-- Adicionando JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Adicionando Javascript -->
    <script>
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
</head>

<body>
    <!-- Inicio do formulario -->
    <div class="box">
        <form action="index.php" method="POST">
            <fieldset>
                <legend><b>Cadastro</b></legend>
                <br>
                <div class="inputBox">
                    <label for="nome" class="labelInput"> Nome:
                        <input type="text" name="nome" id="nome" class="inputUser" required />
                    </label><br><br>
                    <div class="inputBox">
                        <label for="sobrenome" class="labelInput"> Sobrenome:
                            <input type="text" name="sobrenome" id="sobrenome" class="inputUser" required />
                        </label><br><br>

                        <div class="inputBox">
                            <form method="get" action=".">
                                <label for="cep" class="labelInput">Cep:
                                    <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" class="inputUser" required />
                                </label><br><br>

                                <div class="inputBox"></div>
                                <label for="rua" class="labelInput">Rua:
                                    <input name="rua" type="text" id="rua" size="auto" class="inputUser" required />
                                </label><br><br>

                                <div class="inputBox"></div>
                                <label for="bairro" class="labelInput">Bairro:
                                    <input name="bairro" type="text" id="bairro" size="auto" class="inputUser" required />
                                </label><br><br>

                                <div class="inputBoxRead"></div>
                                <label>Cidade:
                                    <input name="cidade" size="auto" class="form-control inputUser" id="cidade" type="text" readonly required />
                                </label><br><br>

                                <div class="inputBoxRead"></div>
                                <label>Estado:
                                    <input name="uf" size="auto" class="form-control inputUser" id="uf" type="text" readonly required />
                                </label><br><br>

                                <div class="inputBox"></div>
                                <label for="numero" class="labelInput">Número:
                                    <input name="numero" type="number" id="numero" size="auto" class="inputUser" required />
                                </label><br><br>

                                <div class="inputBox"></div>
                                <label for="complemento" class="labelInput">Complemento:
                                    <input name="complemento" type="textarea" id="complemento" size="auto" class="inputUser" />
                                </label><br><br>
                                <input type="submit" name="submit" type="submit" id="submit" />

            </fieldset>
        </form>
    </div>
</body>

</html>
