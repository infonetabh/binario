<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da Tabela Mensagem</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }
        h1 {
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 1rem;
            background-color: #f5f5f5;
            padding: 1rem;
            position: relative; /* Para o posicionamento relativo */
        }
        .whatsapp-button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
        .whatsapp-button:hover {
            background-color: #666;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".whatsapp-button").click(function (event) {
            event.preventDefault();
            var button = $(this);
            var messageId = button.data("message-id");

            // Realize uma solicitação AJAX para atualizar o campo "enviado" no banco de dados
            $.ajax({
                url: "atualizar_enviado.php", // Crie um arquivo PHP para realizar a atualização do banco de dados
                method: "POST",
                data: { messageId: messageId },
                success: function (response) {
                    // Se a atualização for bem-sucedida, atualize o texto na página
                    if (response === "success") {
                        button.siblings(".enviado").text("Mensagem já enviada");
                        button.remove();

                        // Redirecione o usuário para o link do WhatsApp em uma nova aba usando JavaScript
                        window.open(button.attr("href"), "_blank");
                    }
                }
            });
        });
    });


        function iniciarCronometro(segundos) {
            var cronometro = segundos;
            var titulo = document.querySelector("h1");

            var intervalo = setInterval(function() {
                titulo.innerHTML = "Recarregando em " + cronometro + " segundos...";
                cronometro--;

                if (cronometro < 0) {
                    clearInterval(intervalo);
                    location.reload(); // Recarrega a página quando o cronômetro atingir zero
                }
            }, 1000); // Atualiza a cada segundo (1000 milissegundos)
        }

        // Inicie o cronômetro com um valor, por exemplo, 10 segundos
        window.onload = function() {
            iniciarCronometro(60);
        };
    </script>
</head>
<body>
    <header>
        <h1>Recarregando em 60 segundos...</h1>
    </header>
    <div class="container">
    <?php
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

// Consulta SQL para selecionar todos os registros da tabela "mensagem"
$sql = "SELECT * FROM mensagem ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";

    while ($row = $result->fetch_assoc()) {
        echo "<li>";
        echo "<strong>ID:</strong> " . $row["id"] . "<br>";
        echo "<strong>Número:</strong> " . $row["destinatario"] . "<br>";
        echo "<strong>Texto:</strong> " . $row["texto"] . "<br>";
        echo "<strong>Data/Hora:</strong> " . $row["data_hora"] . "<br>";
        if ($row["enviado"] != 1) {
            $phone = str_replace(" ", "%20", $row["destinatario"]);
            $message = "🚨 *ATENÇÃO* 🚨\nVocê recebeu uma mensagem anônima criptografada,\n\n👤: *" . $row["texto"] . "*\n\nDirija-se à barraca do 3° de Infonet para descriptografar sua mensagem!";
            $whatsappLink = "https://api.whatsapp.com/send?phone=55" . $phone . "&text=" . rawurlencode($message);
            echo "<a class='whatsapp-button' href='$whatsappLink' target='_blank' data-message-id='" . $row["id"] . "'>Enviar WhatsApp</a>";


        } else {
            echo "<p class='enviado'>Mensagem já enviada</p>";
        }
        
        echo "</li>";
    }

    echo "</ul>";
} else {
    echo "Nenhum dado encontrado na tabela 'mensagem'.";
}

$conn->close();
?>
    </div>
</body>
</html>
