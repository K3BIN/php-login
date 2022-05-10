<?php
session_start();
require 'bd.php';

if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="es">

<body>

    <?php require 'partials/navbar.php' ?>
    <div class="container py-5">
        <!--Inicio sesión formulario-->
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <?php if (!empty($user)) : ?>
                    <br>Bienvenido. <?= $user['email'] ?>
                    <br>Inicio de sesión exitoso.
                    <a href="logout.php">Cerrar Sesión</a>

                <?php else : ?>
                    <h1>Porfavor inicia sesión o regístrate</h1>
                    <a href="login.php">Iniciar sesión</a>
                    <a href="registro.php">Regístrate</a>
                <?php endif; ?>

            </div>
            <div class="col-md-4"></div>
        </div>
    </div>

</body>

</html>