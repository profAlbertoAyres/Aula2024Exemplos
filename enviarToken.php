<?php
require_once 'classes/Database.class.php';
require_once 'classes/Auth.class.php';
require_once 'libs/PHPMailer-master/src/Exception.php';
require_once 'libs/PHPMailer-master/src/PHPMailer.php';
require_once 'libs/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer;

#confurando o email de envio 



// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    // Inicializa a classe Auth
    $auth = new Auth;
    // Gera o token e salva no banco
    if ($auth->validarEmail($email)) {
        $auth->setEmail($email);
        // Monta o link de redefinição de senha
        $resetLink = "http://example.com/reset_password.php?token=" . $auth->gerarToken();


        try {

            $mail->isSMTP();

            $mail->SMTPDebug = false;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Port = 465;

            $mail->Username = 'bettojogar@gmail.com'; // Seu endereço Gmail
            $mail->Password = 'Jogar@2019'; // Senha do Gmail ou senha de aplicativo
            // Remetente e destinatário
            $mail->setFrom('bettojogar@gmail.com', 'Alberto'); // Remetente
            $mail->addAddress($email,'Redefinição de Senha'); // Destinatário

            $mail->Subject = 'Redefinição de senha';
            $mail->msgHTML("Olá,\n\nRecebemos um pedido para redefinir sua senha. Clique no link abaixo para criar uma nova senha:\n\n$resetLink\n\nSe você não solicitou essa alteração, ignore este e-mail.");

            // Enviar o e-mail
            $mail->send();
            echo 'E-mail enviado com sucesso!';
        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('E-mail não encontrado no sistema.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Redefinir Senha</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Solicitar redefinição de senha</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Link</button>
        </form>
    </div>
</body>

</html>