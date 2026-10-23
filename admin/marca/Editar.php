<?php 

# CONEXÃO COM BANCO DE DADOS #
  require_once __DIR__ . "/../../conexao/conecta.php";

//    # INICIANDO UMA SESSÃO #
//  if (!isset($_SESSION))
//   {
//     session_start();
//   }

# VERIFICANDO SE EXISTE USUÁRIO LOGADO PARA PERMITIR ACESSO #
  include_once __DIR__ . "/../Usuario_Comum.php";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>PAINEL ADMINISTRATIVO</title>

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- CUSTOMIZAÇÃO DO TEMPLATE -->
  <link rel="stylesheet" href="../../assets/css/dashboard.min.css">
  <link rel="stylesheet" href="../../assets/css/styles.min.css">

  <!-- FAVICON -->
  <link rel="shortcut icon" href="../../assets/img/favicon.ico" type="image/x-icon">


  <link rel="stylesheet" href="../../assets/css/deckly.css">
</head>

<body>

  <?php
  #Início TOPO
  include('../Topo.php');
  #Final TOPO
  ?>

  <div class="container-fluid">
    <div class="row">
      <?php
      #Início MENU
      include('../Navegacao.php');
      #Final MENU
      ?>

      <main class="ms-auto col-lg-10 px-md-4">
        <?php
        include('../Log.php');
        include('../Mensagem.php');

        //VERIFICANDO 
        if (isset($_GET['codigo_marca']) && $_GET['codigo_marca'] != '')
          {

          $codigo = $_GET['codigo_marca'];

          $sql = "SELECT * FROM marca WHERE codigo_marca = $codigo";
          $query = mysqli_query($conexao, $sql);
          $marca = mysqli_fetch_assoc($query);
        ?>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Editar marca</h4>
            <a href="Index.php" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left-short"></i>
              Voltar</a>
          </div>

          
          <div class="card-body">
           <form action="Acoes.php" method="post">
            <div class="row">
              <div class="col-6">
                <label for="marca"><strong class="text-danger">*</strong>marca: </label>
                <input type="text" name="marca" id="marca" class="form-control" maxlength="40" value="<?php echo $marca['nome_marca']?>" required>
              </div>

              <div class="col-2">
                <label for="datacadastro">Data de Cadastro:</label>
                  <input type="date" name="datacadastro" id="datacadastro" class="form-control" value="<?php echo date('Y-m-d', strtotime($marca['data_cadastro'])); ?>" disabled>
              </div>
              <div class="col-2">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control" >
                  <option value="1" <?php if($marca['status_marca'] == '1') echo 'selected'?>>Ativo</option>
                  <option value="0" <?php if($marca['status_marca'] == '0') echo 'selected'?>>Inativo</option>
                </select>
              </div>

            </div>

            <div class="row">
                <div class="col-12 mt-2">
                <label for="obervacao">Observação:</label>
                <textarea name="observacao" id="observacao" class="form-control" maxlength="100"><?php echo $marca['observacao_marca']?></textarea>

                  <input type="hidden" name="editar" value="editar_marca">
                  <input type="hidden" name="codigo_marca" value="<?php echo $codigo ?>">

                <input type="submit" value="Atualizar" class="btn btn-primary mt-3">
              </div>
              </div>

            
            </div>
           </form>
          </div>
          
          </div>
        </div>

        <?php 
        }
        echo 'Nenhuma marca encontrado';
        ?>

      </main>


    </div>
  </div>

  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>