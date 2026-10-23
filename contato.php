<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PYO</title>
  <meta name="author" content="Maria Fernanda">

  <!-- GOOGLE FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Judson:ital,wght@0,400;0,700;1,400&display=swap"
    rel="stylesheet">
  <!-- !!! -->

  <!-- FONT AWESOME (ÍCONES) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- !!! -->

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">


  <!-- CHAMANDO O CSS -->
  <link rel="stylesheet" href="custom/css/style.css">
  <!-- !!! -->

</head>

<body>

  <?php include('Topo.php'); ?>


  <section class="contato">
    <div class="container">

        <h2>Entre em Contato</h2>
        <p class="texto-contato">
            Tem alguma dúvida, sugestão ou problema com seu pedido?
            Envie uma mensagem para nossa equipe.
        </p>

        <form class="form-contato">

            <input type="text" placeholder="Seu nome" required>

            <input type="email" placeholder="Seu e-mail" required>

            <textarea placeholder="Digite sua mensagem..." rows="6" required></textarea>

            <button type="submit">Enviar Mensagem</button>

        </form>

    </div>
</section>

  <?php include("Rodape.php"); ?>



  <!-- BOOTSTRAP JAVASCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>