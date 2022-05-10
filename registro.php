<?php
require 'bd.php';
$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email,:password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        $message = 'Usuario creado exitosamente';
    } else {
        $message = 'Hubo un problema, no se pudo crear el usuario, intentelo de nuevo';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<body>

    <?php require 'partials/navbar.php' ?>
    <div class="container py-5">
        <!--Registro formulario-->
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php if (!empty($message)) : ?>
                    <p><?= $message ?></p>
                <?php endif; ?>

                <h1 style="text-align:center">Registrarse</h1>
                <div class="d-flex justify-content-center">
                    <span>o <a href="login.php">Iniciar sesión</a></span>
                </div>
                <form class="form-floating" action="registro.php" method="post">
                    <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" name="email">
                    <label for="floatingInputValue">Correo</label><br>
                    <div class="form-floating mb-3 ">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                        <label for="floatingPassword">Contraseña</label><br>

                        <div class="form-floating mb-3 ">
                            <input type="password" class="form-control" id="floatingPasswordC" placeholder="Password">
                            <label for="floatingPassword">Confirmar contraseña</label>
                        </div>

                        <div class="d-grid gap-2 col-6 mx-auto py-3">
                            <input class="btn btn-outline-info btn-lg" type="submit" value="Send">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>