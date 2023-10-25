$(document).ready(function() {
    $("#do_login").click(function() { 
       closeLoginInfo();
       $(this).parent().find('span').css("display","none");
       $(this).parent().find('span').removeClass("i-save");
       $(this).parent().find('span').removeClass("i-warning");
       $(this).parent().find('span').removeClass("i-close");
       
        var proceed = true;
        $("#login_form input").each(function(){
            
            if(!$.trim($(this).val())){
                $(this).parent().find('span').addClass("i-warning");
            	$(this).parent().find('span').css("display","block");  
                proceed = false;
            }
        });
       
        if(proceed) //everything looks good! proceed...
        {
            $(this).parent().find('span').addClass("i-save");
            $(this).parent().find('span').css("display","block");
        }
    });
    
    //reset previously results and hide all message on .keyup()
    $("#login_form input").keyup(function() { 
        $(this).parent().find('span').css("display","none");
    });
 
  openLoginInfo();
  setTimeout(closeLoginInfo, 1000);
});

function enviarMensagem(event, button) {
    event.preventDefault(); // Evita o comportamento padrão de envio do formulário

    const textInput = document.getElementById('user');
    const resultInput = document.getElementById('result');
    const text = textInput.value;
    const destinatarioInput = document.getElementById('pass');
    const destinatario = destinatarioInput.value;

    // Converte o texto em código binário
    const binaryText = text.split('').map(char => char.charCodeAt(0).toString(2)).join(' ');
    resultInput.value = binaryText;

    // Verifique se o texto foi criptografado e altere o texto do botão e desabilite conforme necessário
    if (binaryText) {
        button.value = 'Enviando Mensagem...';
        button.disabled = true;

        // Resto do código AJAX permanece inalterado
    }
}

function openLoginInfo() {
    $(document).ready(function(){ 
    	$('.b-form').css("opacity","0.01");
      $('.box-form').css("left","-37%");
      $('.box-info').css("right","-37%");
    });
}

function closeLoginInfo() {
    $(document).ready(function(){ 
    	$('.b-form').css("opacity","1");
    	$('.box-form').css("left","0px");
      $('.box-info').css("right","-5px"); 
    });
}
function enviarMensagem(button) {
    const textInput = document.getElementById('user');
    const resultInput = document.getElementById('result');
    const text = textInput.value;
    const destinatarioInput = document.getElementById('pass');
    const destinatario = destinatarioInput.value;

    // Converte o texto em código binário
    const binaryText = text.split('').map(char => char.charCodeAt(0).toString(2)).join(' ');
    resultInput.value = binaryText;

    // Verifique se o texto foi criptografado e altere o texto do botão e desabilite conforme necessário
    if (binaryText) {
        button.value = 'Enviando Mensagem...';
        button.disabled = true;

        // Crie um objeto XMLHttpRequest
        const xhr = new XMLHttpRequest();
        
        // Defina o método e a URL para a requisição AJAX
        xhr.open('POST', 'processar.php', true);
        
        // Defina o cabeçalho para indicar que estamos enviando dados de formulário
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        
        // Defina a função de retorno de chamada que será chamada quando a requisição for concluída
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // A requisição foi concluída com sucesso, você pode fazer algo com a resposta se necessário
                // Por exemplo, você pode exibir uma mensagem de confirmação na página
                button.value = 'MENSAGEM ENVIADA';
                alert('Mensagem enviada com sucesso!');

                // Limpe o formulário (opcional)
                textInput.value = '';
                destinatarioInput.value = '';
                resultInput.value = '';

                // Reative o botão
                button.disabled = false;
            }
        };
        
        // Prepare os dados a serem enviados (neste caso, os campos do formulário)
        const dados = new FormData(document.getElementById('meuFormulario'));
        
        // Envie a requisição
        xhr.send(dados);
    }
}

$(window).on('resize', function(){
      closeLoginInfo();
});