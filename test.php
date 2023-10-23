<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/6.0.7/imask.min.js"></script>
</head>
<body>
    <div class='box'>
        <div class='box-form'>
            <div class='box-login-tab'></div>
            <div class='box-login-title'>
                <div class='i i-login'></div>
                <h2>CRIPTOGRAFAR</h2>
            </div>
            <div class='box-login'>
                <div class='fieldset-body' id='login_form'>
                    <button onclick="openLoginInfo();" class='b b-form i i-more' title=''></button>
                    <p class='field'>
                        <label for='user'>TEXTO</label>
                        <input type='text' id='user' name='user' title='Username' placeholder="Digite seu texto..." />
                        <span id='valida' class='i i-warning'></span>
                    </p>
                    <p class='field'>
                        <label for='pass'>DESTINATÁRIO</label>
                        <input type='tel' id='pass' name='pass' title='Password' placeholder="(XX) XXXXX-XXXX" />
                        <span id='valida' class='i i-close'></span>
                    </p>
                    <div>
                        <p class='field'>
                            <label for='result'>MENSAGEM CRIPTOGRAFADA</label>
                            <input type='text' id='result' name='result' title='Resultado' placeholder="" readonly />
                        </p>
                    </div>
                    <input type='submit' id='do_login' value='CRIPTOGRAFAR MENSAGEM' title='GET STARTED' onclick="enviarMensagem(this)" />
                </div>
            </div>
        </div>
    </div>

    <script>
        const phoneInput = document.getElementById('pass');
        const phoneMask = IMask(phoneInput, {
            mask: '(00) 00000-0000'
        });

        function enviarMensagem(button) {
            const textInput = document.getElementById('user');
            const resultInput = document.getElementById('result');
            const text = textInput.value;
            // Converte o texto em código binário
            const binaryText = text.split('').map(char => char.charCodeAt(0).toString(2)).join(' ');
            resultInput.value = binaryText;

            // Verifique se o texto foi criptografado e altere o texto do botão e desabilite conforme necessário
            if (binaryText) {
                button.value = 'MENSAGEM ENVIADA';
                button.disabled = true;
                
                // Redefinir a página após um minuto
                setTimeout(() => {
                    location.reload();
                }, 08000); // 60 segundos (1 minuto)
            }
        }
    </script>
</body>
</html>
