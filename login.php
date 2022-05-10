<?php
session_start();

require 'bd.php';
if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
}

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message= '';

    if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
        $_SESSION['user_id'] = $results['id'];
        header('Location: /php-login');
    }else{
        $message = 'Credenciales incorrectas'; 
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

                <?php if(!empty($message)):?>
                <p><?= $message ?></p>
                <?php endif; ?>

                <h1 style="text-align:center">Iniciar sesión</h1>
                <div class="d-flex justify-content-center">
                    <span>o <a href="registro.php">Registrarse</a></span>
                </div>
                <form class="form-floating" action="login.php" method="post">
                    <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" name='email'>
                    <label for="floatingInputValue">Correo</label><br>
                    <div class="form-floating mb-3 ">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name='password'>
                        <label for="floatingPassword">Contraseña</label>
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