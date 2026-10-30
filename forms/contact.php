<?php
// ==========================================
// CONFIGURA AQUÍ TU CORREO RECIBIDOR
// ==========================================
$receiving_email_address = 'luiscarlos.jimenez@consultoreconomico.com.co';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = strip_tags($_POST['name']);
    $email   = strip_tags($_POST['email']);
    $subject = strip_tags($_POST['subject']);
    $message = strip_tags($_POST['message']);

    // Validar campos básicos
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo 'Por favor completa todos los campos.';
        exit;
    }

    // Construir el correo
    $to      = $receiving_email_address;
    $email_subject = "Nuevo mensaje desde tu portafolio: $subject";
    $email_body = "Has recibido un nuevo mensaje desde tu portafolio.\n\n";
    $email_body .= "Nombre: $name\n";
    $email_body .= "Correo: $email\n";
    $email_body .= "Asunto: $subject\n";
    $email_body .= "Mensaje:\n$message\n";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar correo
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo 'OK';
    } else {
        http_response_code(500);
        echo 'Lo sentimos, hubo un error al enviar el mensaje. Intenta nuevamente.';
    }
} else {
    http_response_code(405);
    echo 'Método no permitido.';
}
?>