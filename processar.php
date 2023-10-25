<?php
session_start(); // Inicie a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST["texto"]; // Pega o valor do campo de texto 'texto'
    $destinatario = $_POST["destinatario"];

    // Converte o texto em código binário
    $mensagemCriptografada = implode(' ', array_map(function ($char) {
        return decbin(ord($char));
    }, str_split($texto)));

    $host = "sql301.infinityfree.com";
    $username = "if0_35290775";
    $password = "Nho51UKKFJ3BAVk";
    $dbname = "if0_35290775_infonet";

    // Cria a conexão
    $conn = new mysqli($host, $username, $password, $dbname);

    // Verifica se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Insira a data/hora atual
    $dataHora = date("Y-m-d H:i:s");

    // Insira os dados na tabela "mensagem" usando placeholders
    $sql = "INSERT INTO mensagem (texto, destinatario, data_hora) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $mensagemCriptografada, $destinatario, $dataHora);

    if ($stmt->execute()) {
        // Inserção bem-sucedida

        // Armazene os dados na sessão para exibição na página de dados_enviados.php
        $_SESSION['texto1'] = $texto;
        $_SESSION['texto'] = $mensagemCriptografada;
        $_SESSION['destinatario'] = $destinatario;
        $_SESSION['data_hora'] = $dataHora;

        $conn->close();

        // Redirecione para a página dados_enviados.php
        header("Location: dados_enviados.php");
        exit();
    } else {
        // Erro na inserção
        $status = "Erro ao enviar dados: " . $stmt->error;
    }

    $conn->close();
}
?>
