<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $messageId = $_POST['messageId'];

    // Conecte-se ao banco de dados
    $host = "sql301.infinityfree.com";
    $username = "if0_35290775";
    $password = "Nho51UKKFJ3BAVk";
    $dbname = "if0_35290775_infonet";
    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Atualize o status "enviado" para 1
    $sql = "UPDATE mensagem SET enviado = 1 WHERE id = $messageId";

    if ($conn->query($sql) === TRUE) {
        echo "success"; // Resposta bem-sucedida
    } else {
        echo "error: " . $conn->error; // Resposta de erro
    }

    $conn->close();
}
?>
