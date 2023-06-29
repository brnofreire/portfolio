<?php

//PARA QUANDO FOR UTIZILIZAR O SITE EM HOSPEDAGEM FORA DO GITHUB!!!!!!!
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Função para limpar e validar os dados
    function limparEntrada($dados) {
        $dados = trim($dados);
        $dados = htmlspecialchars($dados);
        return $dados;
    }

    // Validação e limpeza dos campos
    $nome = limparEntrada($_POST['nome']);
    $email = limparEntrada($_POST['email']);
    $mensagem = limparEntrada($_POST['mensagem']);

    // Verificação dos campos obrigatórios
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo 'Por favor, preencha todos os campos obrigatórios.';
        exit;
    }

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Por favor, insira um endereço de e-mail válido.';
        exit;
    }

    // Constrói o cabeçalho do e-mail
    $headers = "From: $nome <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

    // Informações do destinatário (você)
    $seuEmail = 'brnwedev@gmail.com'; // Substitua pelo seu endereço de e-mail

    // Assunto e mensagem do e-mail
    $assunto = 'Novo contato pelo formulário';
    $corpo = "Nome: $nome<br>";
    $corpo .= "E-mail: $email<br>";
    $corpo .= "Mensagem: $mensagem<br>";

    // Envio do e-mail
    $enviado = mail($seuEmail, $assunto, $corpo, $headers);

    // Verifica se o e-mail foi enviado com sucesso
    if ($enviado) {
        echo 'Obrigado por entrar em contato! Seu e-mail foi enviado com sucesso.';
    } else {
        echo 'Desculpe, ocorreu um erro ao enviar o e-mail. Por favor, tente novamente mais tarde.';
    }
}
?>


