<?php
namespace controller;

use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/../vendor/autoload.php';

class RegistrarController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function mostrarPantallaRegistrar($camposVacios = false, $usuarioExistente = false, $contraseñaInvalida = false)
    {
        $data = [
            "usuario" => $_POST["username"] ?? "",
            "password" => $_POST["pass"] ?? "",
            "r_password" => $_POST["r_pass"] ?? "",
            "ubicacion" => $_POST["ubicacion"] ?? "",
            "nombre" => $_POST["nombre"] ?? "",
            "fecha" => $_POST["fecha"] ?? "",
            "sexo" => $_POST["sexo"] ?? "",
            "mail" => $_POST["email"] ?? "",
            "sexoInvalido" => !isset($_POST["sexo"]),
            "esMasculino" => (isset($_POST["sexo"]) && $_POST["sexo"] == "Masculino"),
            "esFemenino" => (isset($_POST["sexo"]) && $_POST["sexo"] == "Femenino"),
            "esNoDice" => (isset($_POST["sexo"]) && $_POST["sexo"] == "Prefiero no decirlo"),
            "camposVacios" => $camposVacios,
            "usuarioExistente" => $usuarioExistente,
            "contraseñaInvalida" => $contraseñaInvalida
        ];
        $this->presenter->render("view/registrarView.mustache", $data);
    }

    public function procesarFormulario()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST["username"];
            $password = $_POST["pass"];
            $r_password = $_POST["r_pass"];
            $ubicacion = $_POST["ubicacion"];
            $nombre = $_POST["nombre"];
            $fecha = $_POST["fecha"];
            $sexo = isset($_POST["sexo"]) ? $_POST["sexo"] : null;
            $email = $_POST["email"];
            $imagen = "";

            if (empty($usuario) || empty($password) || empty($r_password) ||  empty($ubicacion) || empty($nombre) || empty($fecha) || empty($sexo) || empty($email)) {
                return $this->mostrarPantallaRegistrar(true);
            } else {
                if (!$this->model->usuarioDisponible($usuario)) {
                    return $this->mostrarPantallaRegistrar(false, true);
                } elseif (!$this->model->contraseñaValida($password, $r_password)) {
                    return $this->mostrarPantallaRegistrar(false, false, true);
                }

                if (isset($_FILES["file"])) {
                    $nombreArchivo = $_FILES["file"]["name"];
                    $rutaTemporal = $_FILES["file"]["tmp_name"];
                    $directorioDestino = "public/imagenesPerfil/" . $nombreArchivo;

                    if (move_uploaded_file($rutaTemporal, $directorioDestino)) {
                        $imagen = "/preguntados/" . $directorioDestino;
                    }
                }

                $hash = $this->model->registrarUsuario($usuario, $password, $nombre, $fecha, $sexo, $ubicacion, $email, $imagen);

                $this->enviarCorreoConfirmacion($email, $nombre, $hash);
                header('Location: /preguntados/admin/mensajeDeExitoMail');
                exit();
            }
        }
    }

    public function enviarCorreoConfirmacion($correoDestinatario, $nombreDestinatario, $hash)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp-mail.outlook.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'misteryQuiz1@outlook.com';
            $mail->Password = 'misteryQuiz';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('misteryQuiz1@outlook.com', 'MisteryQuiz');
            $mail->addAddress($correoDestinatario, $nombreDestinatario);

            $mail->isHTML(true);
            $mail->Subject = 'Registro exitoso';
            $mail->Body = '<h1>Registro exitoso</h1>
                       <p>¡Hola ' . $nombreDestinatario . '!</p>
                       <p>Gracias por registrarte en MysteryQuiz. Haz clic en el siguiente enlace para confirmar tu registro:</p>
                       <p><a href="http://localhost/preguntados/iniciarSesion/validarHash?hash=' . $hash . '">Confirmar registro</a></p>
                       <p>Una vez que hayas confirmado tu registro, sigue estos pasos:</p>
                       <ol>
                           <li>Accede a tu cuenta en MysteryQuiz.</li>
                           <li>Explora las preguntas sin resolver disponibles.</li>
                           <li>¡Diviertete resolviendo los misterios y ganando puntos!</li>
                       </ol>
                       <p>- Los Detectives Lucas, Mariel y Celes :)</p>';

            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo "El mensaje no se pudo enviar. Error de PHPMailer: {$mail->ErrorInfo}";
        }
    }
}