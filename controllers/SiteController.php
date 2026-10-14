<?php

require_once 'models/ContactoModel.php';

class SiteController
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function manejarPeticion()
    {
        // Identificar la sección solicitada.
        $seccion_actual = isset($_GET['url'])
        ? trim($_GET['url'], '/')
        : 'inicio';

        if ($seccion_actual === '') {
        $seccion_actual = 'inicio';
        }

        // Variable que utilizará la vista para mostrar mensajes.
        $mensaje_db = '';

        // Procesar el formulario de contacto.
        if (
            $seccion_actual === 'contacto' &&
            $_SERVER['REQUEST_METHOD'] === 'POST'
        ) {
            $nombre = trim($_POST['nombre'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $comentario = trim($_POST['comentario'] ?? '');
            if (
                $nombre !== '' &&
                $email !== '' &&
                $comentario !== '' &&
                filter_var($email, FILTER_VALIDATE_EMAIL)
            ) {
                $modelo = new ContactoModel($this->conexion);

                $exito = $modelo->guardarContacto(
                    $nombre,
                    $email,
                    $comentario
                );
                if ($exito) {
                    $mensaje_db =
                        '¡Gracias, ' .
                        htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') .
                        '! Tu opinión fue guardada correctamente.';
                } else {
                    $mensaje_db =
                        'No fue posible guardar tu comentario. Inténtalo nuevamente.';
                }
            } else {
                $mensaje_db =
                    'Por favor, completa todos los campos con información válida.';
            }
        }

        // Mostrar el encabezado común.
        require 'views/header.php';

        // Mostrar la vista solicitada.
        switch ($seccion_actual) {
            case 'inicio':
                require 'views/inicio.php';
                break;

            case 'modelos':
                require 'views/modelos.php';
                break;

            case 'comparativa':
                require 'views/comparativa.php';
                break;

            case 'contacto':
                require 'views/contacto.php';
                break;

            default:
                http_response_code(404);
                require 'views/404.php';
                break;
        }
        // Mostrar el pie de página común.
        require 'views/footer.php';
    }
}