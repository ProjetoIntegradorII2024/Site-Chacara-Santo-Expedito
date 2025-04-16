<?php
// Definir o endereço de email para onde será enviado
$email_destino = "deeptubiano@gmail.com";  // Substitua com o email real da empresa

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar e limpar os dados do formulário
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensagem = htmlspecialchars(trim($_POST["mensagem"]));
    $responsavel = htmlspecialchars(trim($_POST["responsavel"]));

    // Validar os dados
    if (empty($nome) || empty($email) || empty($mensagem) || empty($responsavel) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, preencha todos os campos corretamente.";
        exit;
    }

    // Assunto do email
    $assunto = "Nova dúvida do site - Responsável: $responsavel";

    // Corpo do email
    $corpo_email = "Você recebeu uma nova mensagem de contato do site.\n\n";
    $corpo_email .= "Nome: $nome\n";
    $corpo_email .= "Email: $email\n";
    $corpo_email .= "Responsável: $responsavel\n";
    $corpo_email .= "Mensagem:\n$mensagem\n";

    // Cabeçalhos do email
    $headers = "De: $nome <$email>";

    // Enviar o email
    if (mail($email_destino, $assunto, $corpo_email, $headers)) {
        echo "Mensagem enviada com sucesso! Em breve, entraremos em contato.";
    } else {
        echo "Erro ao enviar a mensagem. Tente novamente mais tarde.";
    }
} else {
    echo "Método de envio inválido.";
}
?>
"update"