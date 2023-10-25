<?php include("processar.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="style.css">
    <script>
    // Função para redirecionar após 10 segundos e encerrar a sessão
    function redirecionarParaIndex() {
        setTimeout(function () {
            // Encerra a sessão PHP
            <?php session_destroy(); ?>

            // Redireciona para index.html
            window.location.href = "index.html";
        }, 10000); // 10000 milissegundos = 10 segundos
    }

    // Chame a função quando a página carregar
    window.onload = redirecionarParaIndex;
</script>
    <title>Enviados | 3° Infonet</title>
    <link rel="shortcut icon" href="https://i.imgur.com/81C14qg.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class='box'>
        <div class='box-form'>
            <div class='box-login-tab'></div>
            <div class='box-login-title'>
                <div class='i i-login'></div>
                <h2>DADOS ENVIADOS</h2>
            </div>
            <div class='box-login'>
                <div class='fieldset-body' id='login_form'>
                    <p class='field'>
                        <label for='user'>TEXTO</label>
                        <input type='text' id='user' name='texto' title='Username' value="<?php echo $_SESSION['texto1']; ?>" readonly />
                    </p>
                    <p class='field'>
                        <label for='pass'>DESTINATÁRIO</label>
                        <input type='tel' id='pass' name='destinatario' title='Password' value="<?php echo $_SESSION['destinatario']; ?>" readonly />
                    </p>
                    <p class='field'>
                        <label for='result'>MENSAGEM CRIPTOGRAFADA</label>
                        <input type='text' id='result' name='result' title='Resultado' value="<?php echo $_SESSION['texto']; ?>" readonly />
                    </p>
                    <input id='enviada' value='MENSAGEM ENVIADA' title='MENSAGEM ENVIADA' /> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>
