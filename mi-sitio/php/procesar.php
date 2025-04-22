<?php
// filepath: c:\xampp\htdocs\DesarrolloWeb22-04\mi-sitio\php\procesar.php

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Validar el formato del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido.";
        exit;
    }

    // Configurar el correo electrónico
    $destinatario = "tu_correo@ejemplo.com"; // Cambia esto por tu correo
    $asunto = "Nuevo mensaje de contacto";
    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo: $email\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    // Enviar el correo
    $headers = "From: $email\r\n";
    if (mail($destinatario, $asunto, $contenido, $headers)) {
        echo "Gracias por contactarnos, $nombre. Tu mensaje ha sido enviado.";
    } else {
        echo "Lo sentimos, ocurrió un error al enviar tu mensaje. Inténtalo nuevamente.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>