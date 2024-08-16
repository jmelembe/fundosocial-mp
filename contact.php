<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $assunto = $_POST["assunto"];
    $descricao = $_POST["descricao"];

    // Validação e verificação de dados (pode adicionar mais validações conforme necessário)
    if (empty($nome) || empty($email) || empty($assunto) || empty($descricao)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Constrói a mensagem de e-mail
        $to = "justinmelembe@gmail.com";
        $subject = "Novo formulário de contato";
        $message = "Nome: $nome\nEmail: $email\nAssunto: $assunto\nDescrição: $descricao";

        // Envia o e-mail
        $headers = "From: $email"; // Substitua pelo seu endereço de e-mail
        mail($to, $assunto, $message, $headers);

        // Exibe uma mensagem de sucesso
        echo "Formulário enviado com sucesso. Obrigado!";
    }
}
