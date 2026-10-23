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
                include('../Mensagem.php')
                ?>

                <div class="card">

                    <div class="card-header d-flex justify-content-between">

                        <h4 class="m-0">Produtos</h4>

                        <a href="Inserir.php" class="btn btn-primary btn-sm">

                            <i class="bi bi-plus"></i>

                            Adicionar

                        </a>

                    </div>

                    <div class="linha"></div>
                    <?php 

                    $sql = "SELECT codigo_produto FROM produto";

                    $query = mysqli_query($conexao, $sql);

                    if (mysqli_num_rows($query) > 0)
                    {

                    ?>

                    <div class="card-body">

                        <div class="row">

                            <!-- FILTRO DE STATUS -->

                            <div class="col-2">

                                <form action="">

                                    <select name="status" id="status" class="form-control" onchange="buscar()">

                                        <option value="">Status</option>

                                        <option value="1">Ativo</option>

                                        <option value="0">Inativo</option>

                                    </select>

                                </form>

                            </div>

                            <div class="col-2">

                                <select name="raridade" id="raridade" class="form-control" onchange="buscar()">

                                    <option value="">Raridade</option>

                                    <option value="Comum">Comum</option>

                                    <option value="Incomum">Incomum</option>

                                    <option value="Rara">Rara</option>

                                    <option value="Super rara">Super rara</option>

                                    <option value="Mangá">Mangá</option>

                                </select>

                            </div>

                            <div class="col-2">

                                <form action="">

                                    <select name="marca" id="marca" class="form-control" onchange="buscar()">

                                        <option value="">Marca</option>

                                        <?php 

                                        $sql_marca = "SELECT codigo_marca, nome_marca FROM marca";

                                        $query_marca = mysqli_query($conexao, $sql_marca);

                                        if ($query_marca)
                                        {

                                            foreach ($query_marca as $marca)
                                            {

                                                echo '<option value="' . $marca['codigo_marca'] . '">' . $marca['nome_marca'] . '</option>';

                                            }

                                        }

                                        ?>

                                    </select>

                                </form>

                            </div>

                            <div class="col-2">

                                <form action="">

                                    <select name="categoria" id="categoria" class="form-control" onchange="buscar()">

                                        <option value="">Categoria</option>

                                        <?php 

                                        $sql_categoria = "SELECT codigo_categoria, nome_categoria FROM categoria";

                                        $query_categoria = mysqli_query($conexao, $sql_categoria);

                                        if ($query_categoria)
                                        {

                                            foreach ($query_categoria as $categoria)
                                            {

                                                echo '<option value="' . $categoria['codigo_categoria'] . '">' . $categoria['nome_categoria'] . '</option>';

                                            }

                                        }

                                        ?>

                                    </select>

                                </form>

                            </div>

                            <!-- CAMPO DE BUSCA POR NOME DO PRODUTO -->

                            <div class="col-4">

                                <form action="">

                                    <input type="search" name="pesquisa" id="pesquisa" class="form-control" placeholder="Pesquise por produto...">

                                </form>

                            </div>

                            <div class="linha-ruim"></div>
                        </div>

                    </div>

                    
                    <div class="card-body p-0">

                        <!-- TABELA -->

                        <div id="tabela"></div>

                    </div>

                    <?php 

                    }

                    else

                    {

                        echo '<div class="alert alert-danger" role="alert">Nenhum registro encontrado!</div>';

                    }

                    ?>

                </div>

            </main>

        </div>

    </div>

    <!-- FECHANDO A CONEXÃO COM O BANCO DE DADOS -->

    <?php mysqli_close($conexao) ?>

    <!-- JQUERY CDN -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- BOOTSTRAP JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwxHj09JcYn3nv7wiPVlz7YYJwRjWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- FILTROS -->

    <script>

        //FUNÇÃO PARA LISTAR OS FUNCIONÁRIOS

        function listar(raridade = '', status = '', categoria = '', marca = '', nome = '')
        {

            $('#tabela').text('Carregando...');

            $.ajax({

                url: "Tabela.php",

                method: "POST",

                data:
                {
                    raridade: raridade,
                    status: status,
                    categoria: categoria,
                    marca: marca,
                    nome: nome
                },

                dataType: "html",

                success: function(resultado)
                {

                    $('#tabela').html(resultado);

                },

                error: function(xhr)
                {

                    $('#tabela').html('<div class="alert alert-danger" role="alert">' + xhr.responseText + '</div>');

                }

            })

        }

        //EXECUTAR AS FUNÇÕES AO CARREGAR A PÁGINA

        $(document).ready(function(){

            listar(); //CARREGAR A TABELA 

            //FUNÇÃO PARA PESQUISAR PELO NOME

            $('#pesquisa').keyup(function(){

                let pesquisa = $(this).val();

                listar('', '', '', '', pesquisa);

            })

        })

        // FUNÇÃO PARA REALIZAR A BUSCA PELOS FILTROS

        function buscar()

        {

            let raridade = $('#raridade').val();

            let status = $('#status').val();

            let categoria = $('#categoria').val();

            let marca = $('#marca').val();

            listar(raridade, status, categoria, marca, '');

        }

    </script>

</body>

</html>