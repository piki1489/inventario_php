<?php

require_once "main.php";


//almacendnado datos 

$nombre = limpiar_cadena($_POST['usuario_nombre']);
$apellido = limpiar_cadena($_POST['usuario_apellido']);
$usuario = limpiar_cadena($_POST['usuario_usuario']);
$email = limpiar_cadena($_POST['usuario_email']);
$calve_1 = limpiar_cadena($_POST['usuario_clave_1']);
$calve_2 = limpiar_cadena($_POST['usuario_clave_2']);

// verificar campos obligatorios

if ($nombre == "" || $apellido == "" || $usuario == "" || $calve_1 == ""  || $calve_2 == "") {
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    No has llenado todos los campos que son obligatorios
        </div>';
    exit();
}


//verificando integridad de los datos

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)) {
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    El nombre no coincide con el formato solicitado
        </div>';
    exit();
}
if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)) {
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    El apellido no coincide con el formato solicitado
        </div>';
    exit();
}
if (verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)) {
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    El usuario no coincide con el formato solicitado
        </div>';
    exit();
}
if (verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $calve_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $calve_2)) {
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    La contraseña no coincide con el formato solicitado
        </div>';
    exit();
}

//verificando email
if ($email != "") {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $check_email = conexion();
        $check_email = $check_email->query("SELECT usuario_email FROM usuarios WHERE usuario_email = '$email'");
        if ($check_email->rowCount() > 0) {
            echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El email ya existe en la base de datos
                </div>';
            exit();
        }
        $check_email = null;
    } else {
        echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    El email no coincide con el formato solicitado
        </div>';
        exit();
    }
}
