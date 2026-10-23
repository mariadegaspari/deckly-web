<?php 
 #INICIANDO UMA SESSÃO#
 if(!isset($_SESSION))
  {
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PAINEL ADMINISTRATIVO — LOGIN</title>

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- CUSTOMIZAÇÃO DO TEMPLATE -->
  <link rel="stylesheet" href="../assets/css/signin.min.css">
  <link rel="stylesheet" href="../assets/css/styles.min.css">

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">


  <link rel="stylesheet" href="../assets/css/deckly.css">
</head>
<body>

  <main class="form-signin text-center">
    <form action="Login.php" method="POST">
      <img src="../assets/img/LOGO.png" alt="Deckly" class="deckly-login-logo">
      <h2 class="h3 mb-3">Faça seu Login</h2>

      <input type="text" class="form-control mb-2" name="usuario" placeholder="Usuário" required>

      <input type="password" class="form-control" name="senha" placeholder="Senha" required>

      <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>

    </form>

    <div class="pt-2">
      <?php

if (isset($_SESSION['loginVazio'])) 
  {

  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';

  echo $_SESSION['loginVazio'];

  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

      unset($_SESSION['loginVazio']);
}

if (isset($_SESSION['loginErro'])) 
  {

  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';

  echo $_SESSION['loginErro'];

  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

      unset($_SESSION['loginErro']);
     
}

if (isset($_SESSION['naoAutorizado'])) 
  {

  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';

  echo $_SESSION['naoAutorizado'];

  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

      unset($_SESSION['naoAutorizado']);
     
}

if (isset($_SESSION['logOff'])) 
  {

  echo '<div class="alert alert-sucess alert-dismissible fade show" role="alert">';

  echo $_SESSION['logOff'];

  echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

      unset($_SESSION['logOff']);
     
}

?>
    </div>

    <p class="mt-5 text-muted">&copy; <?= date('Y') ?></p>
  </main>
  
  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>