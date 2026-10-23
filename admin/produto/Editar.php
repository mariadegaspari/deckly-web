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

  <!-- CSS -->
   <link rel="stylesheet" href="../../custom/css/style.css">

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

        if(isset($_GET['codigo_produto']) && $_GET['codigo_produto'] != '')
          
          {

        $codigo = $_GET['codigo_produto'];
        $sql = "SELECT * FROM produto WHERE codigo_produto = $codigo";
        $query = mysqli_query($conexao, $sql);
        $produto = mysqli_fetch_assoc($query);
        ?>
        

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Novo produto</h4>
            <a href="Index.php" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left-short"></i>
              Voltar</a>
          </div>


          <div class="card-body">
            <form action="Acoes.php" method="post" enctype="multipart/form-data">
              <div class="row">

                <div class="col-2 d-flex justify-content-center">
                  <img src="<?php echo !empty($produto['foto_produto1']) ? '../../images/' . htmlspecialchars($produto['foto_produto1']) : '../../assets/img/placeholder-produto.jpg'; ?>" alt="" id="image_preview" class="img-fluid" onerror="this.onerror=null;this.src='../../assets/img/placeholder-produto.jpg'">
                </div>

                <div class="col-10">
                  <div class="row">

                    <div class="col-6">
                      <label for="produto"><strong class="text-danger">*</strong>Produto: </label>
                      <input type="text" name="produto" id="produto" class="form-control" maxlength="40" value="<?php echo $produto['nome_produto']?>" required>
                    </div>

                    <div class="col-3">
                      <label for="datacadastro">Data de Cadastro:</label>
                      <input type="date" name="datacadastro" id="datacadastro" class="form-control" value="<?php echo date('Y-m-d', strtotime($produto['data_cadastro'])); ?>" disabled>
                    </div>
                    <div class="col-3">
                      <label for="status">Status:</label>
                      <select name="status" id="status" class="form-control">
                        <option value="1" <?php if($produto['status_produto'] == '1') echo 'selected'?>>Ativo</option>
                        <option value="0" <?php if($produto['status_produto'] == '0') echo 'selected'?>>Inativo</option>
                      </select>
                    </div>

                    <div class="col-6 mt-2">
                      <label for="foto">Foto do produto:</label>
                      <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    </div>

                    <div class="col-3 mt-2">
                      <label for="raridade"><strong class="text-danger">*</strong>Raridade:</label>
                      <select name="raridade" id="raridade" class="form-control">
                        <option value="Comum" <?php if($produto['raridade_produto'] == 'Comum') echo 'selected'?>>Comum</option>
                        <option value="Incomum" <?php if($produto['raridade_produto'] == 'Incomum') echo 'selected'?>>Incomum</option>
                        <option value="Rara" <?php if($produto['raridade_produto'] == 'Rara') echo 'selected'?>>Rara</option>
                        <option value="Super rara" <?php if($produto['raridade_produto'] == 'Super rara') echo 'selected'?>>Super rara</option>
                        <option value="Mangá" <?php if($produto['raridade_produto'] == 'Mangá') echo 'selected'?>>Mangá</option>
                      </select>
                    </div>

                    <div class="col-3 mt-2">
                      <label for="estoque"><strong class="text-danger">*</strong>Quantidade em estoque: </label>
                      <input type="number" name="estoque" id="estoque" class="form-control" maxlength="40" value="<?php echo $produto['quantidade_estoque']?>" required>
                    </div>

                    <div class="col-2 mt-2">
                      <label for="custo">
                        <strong class="text-danger">*</strong>Preço custo:
                      </label>

                      <input type="number" name="custo" id="custo" class="form-control" step="0.01" min="0" data-mask= "00000.00" data-mask-reverse="true" value="<?php echo $produto['preco_custo']?>" required >
                    </div>

                    <div class="col-2 mt-2">
                      <label for="lucro">
                        <strong class="text-danger">*</strong>Lucro (%):
                      </label>

                      <input type="number" name="lucro" id="lucro" class="form-control" step="0.01" min="0" value="<?php echo $produto['lucro']?>" required>
                    </div>

                    <div class="col-2 mt-2">
                      <label for="venda">
                        <strong class="text-danger">*</strong>Preço venda:
                      </label>

                      <input type="text" name="venda" id="venda" class="form-control" step="0.01" readonly data-mask= "00000.00" data-mask-reverse="true" value="<?php echo $produto['preco_venda']?>" required>
                    </div>

                    <div class="col-3 mt-2">
                      <input class="form-check-input" type="checkbox" name="promocao" id="promocao" <?php if($produto['status_promocao'] == '1') echo 'checked'?>>

                      <label class="form-check-label" for="promocao">
                        Promoção ativa
                      </label>

                    <div class="input-group">
                      <input type="text" name="porcentagem" class="form-control" id="porcentagem" min="0" step="0.01" value="<?php echo $produto['desconto_promocao']?>" disabled required>
                      <span class="input-group-text">%</span>
                    </div>
                    </div>

                    <div class="col-3">
                  <label for="valorPromocao" class="mt-2">Valor com promoção</label>

                  <input type="text" name="valorPromocao" class="form-control" id="valorPromocao" value="<?php echo $produto['preco_promocao']?>" step="0.01" readonly disabled>
                </div>

                <div class="col-2 mt-3">
                <label for="marca"><strong class="text-danger">*</strong>Marca:</label>
                <select name="marca" id="marca" class="form-control" required>

                  <?php

                  $sql_marca = "SELECT codigo_marca, nome_marca FROM marca WHERE status_marca = 1";


                  $query_marca = mysqli_query($conexao, $sql_marca);

                  foreach ($query_marca as $marca) {
                    
                  ?>

                  <option value="<?php echo $marca['codigo_marca'] ?>" <?php if($produto['codigo_marca'] == $marca['codigo_marca']) echo 'selected'?>><?php echo $marca['nome_marca']?></option>;
                  <?php 
                  }
                  ?>
                </select>

              </div>

              <div class="col-2 mt-3">
                <label for="categoria"><strong class="text-danger">*</strong>Categoria:</label>
                <select name="categoria" id="categoria" class="form-control" required>

                  <?php

                  $sql_categoria = "SELECT codigo_categoria, nome_categoria FROM categoria WHERE status_categoria = 1";

                  $query_categoria = mysqli_query($conexao, $sql_categoria);

                  foreach ($query_categoria as $categoria) {

                  ?>

                    <option value="<?php echo $categoria['codigo_categoria'] ?>" <?php if($produto['codigo_categoria'] == $categoria['codigo_categoria']) echo 'selected'?>><?php echo $categoria['nome_categoria'] ?></option>;
                  <?php 
                  }
                  ?>
                </select>

              </div>

                <div id="avisoPromocao" class="alert alert-danger mt-2" role="alert" style="display: none;">
                    <strong>Atenção!</strong>
                    A promoção não pode eliminar o lucro do produto.
                </div>

                <div class="col-12 mt-2">
                <label for="descricao">Descrição do produto:</label>
                <textarea name="descricao" id="descricao" class="form-control" maxlength="100"><?php echo $produto['descricao_produto']?></textarea>
              </div>
                  </div>
                </div>

                

              </div>

              <input type="hidden" name="editar" value="editar_produto">
              <input type="hidden" name="codigo_produto" value="<?php echo $codigo?>">

              <input type="submit" value="Atualizar" class="btn btn-primary mt-3">


          </div>
          </form>
        </div>

    </div>
  </div>

  <?php 
        }

        else
          {
            echo 'Nenhum produto encontrado';
          }
        ?>
  </main>


  </div>
  </div>


  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <!-- JQUERY MASK -->
  <script src="../../assets/js/jquery.mask.min.js"></script>



  <script>

    // CAMPOS DO PRODUTO

    const custo = document.getElementById("custo");
    const lucro = document.getElementById("lucro");
    const venda = document.getElementById("venda");


    // CAMPOS DA PROMOÇÃO

    const promocao = document.getElementById("promocao");
    const porcentagem = document.getElementById("porcentagem");
    const valorPromocao = document.getElementById("valorPromocao");


    // CALCULAR PREÇO DE VENDA

    function calcularVenda() {

        const valorCusto = parseFloat(custo.value);
        const percentualLucro = parseFloat(lucro.value);

        if (!isNaN(valorCusto) && !isNaN(percentualLucro)) {

            const valorLucro =
                valorCusto * (percentualLucro / 100);

            const precoVenda =
                valorCusto + valorLucro;

            venda.value = precoVenda.toFixed(2);

        } else {

            venda.value = "";
        }

        calcularPromocao();
    }


    // CALCULAR PROMOÇÃO

    function calcularPromocao() {

        // Se promoção estiver desativada
        if (!promocao.checked) {

            porcentagem.disabled = true;
            valorPromocao.disabled = true;

            porcentagem.value = "";
            valorPromocao.value = "";

            return;
        }


        // Ativa os campos
        porcentagem.disabled = false;
        valorPromocao.disabled = false;


        const valorCusto = parseFloat(custo.value);
        const precoVenda = parseFloat(venda.value);
        let desconto = parseFloat(porcentagem.value);


        // Verifica se os valores existem
        if (isNaN(valorCusto) || isNaN(precoVenda)) {

            valorPromocao.value = "";

            return;
        }


        if (isNaN(desconto)) {

            valorPromocao.value = "";

            return;
        }


        // CALCULA O DESCONTO MÁXIMO

        const descontoMaximo =
            ((precoVenda - valorCusto - 0.01) / precoVenda) * 100;


        // BLOQUEIA DESCONTO MAIOR QUE O LUCRO

        if (desconto > descontoMaximo) {

            alert("Valor promocional maior que percentual de lucro");


            desconto = descontoMaximo;

            porcentagem.value =
                descontoMaximo.toFixed(2);
        }


        // CALCULA O VALOR PROMOCIONAL

        const valorDesconto =
            precoVenda * (desconto / 100);

        const precoFinal =
            precoVenda - valorDesconto;


        valorPromocao.value =
            precoFinal.toFixed(2);
    }


    // EVENTOS

    custo.addEventListener("input", calcularVenda);
    lucro.addEventListener("input", calcularVenda);
    promocao.addEventListener("change", function() {
      atualizarCamposPromocao();
      calcularPromocao();
    });
    porcentagem.addEventListener("input", calcularPromocao);

    // INICIALIZAÇÃO
    // Mantém os campos de promoção bloqueados enquanto a promoção estiver inativa.
    function atualizarCamposPromocao() {
      const ativa = promocao.checked;
      porcentagem.disabled = !ativa;
      valorPromocao.disabled = !ativa;

      if (!ativa) {
        porcentagem.value = "";
        valorPromocao.value = "";
      }
    }

    atualizarCamposPromocao();
    calcularVenda();
    </script>

    <script>
    const inputImagem = document.getElementById('foto');
    const previewImagem = document.getElementById('image_preview');

    inputImagem.addEventListener('change', function () {
      const arquivo = this.files[0];

      if (!arquivo) {
        return;
      }

      const leitor = new FileReader();

      leitor.onload = function (e) {
        previewImagem.src = e.target.result;
      };

      leitor.readAsDataURL(arquivo);
    });
    </script>

</body>
</html>