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

        if(isset($_GET['codigo_cliente']) && $_GET['codigo_cliente'] != '')
          {

        $codigo = $_GET['codigo_cliente'];
        $sql = "SELECT * FROM cliente WHERE codigo_cliente = $codigo";
        $query = mysqli_query($conexao, $sql);
        $cliente = mysqli_fetch_assoc($query);
        ?>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Editar Cliente</h4>
            <a href="Index.php" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left-short"></i>
              Voltar</a>
          </div>


          <div class="card-body">
            <form action="Acoes.php" method="post" enctype="multipart/form-data">
              <div class="row">

                <h5>Dados pessoais:</h5>
                <div class="col-10">
                  <div class="row">

                    <div class="col-4">
                      <label for="nome"><strong class="text-danger">*</strong>Nome: </label>
                      <input type="text" name="nome" id="nome" class="form-control" maxlength="60" value="<?php echo $cliente['nome']?>" required>
                    </div>

                    <div class="col-4">
                      <label for="nome_social">Nome social: </label>
                      <input type="text" name="nome_social" id="nome_social" class="form-control" value="<?php echo $cliente['nome_social']?>" maxlength="60">
                    </div>

                    <div class="col-2">
                <label for="datanascimento"><strong class="text-danger">*</strong>Data de Nascimento:</label>
                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" maxlength="60" value="<?php echo $cliente['data_nascimento']?>"required>
              </div>

                    <div class="col-2">
                      <label for="status">Status:</label>
                      <select name="status" id="status" class="form-control">
                        <option value="1" <?php if($cliente['status'] == '1') echo 'selected'?>>Ativo</option>
                        <option value="0" <?php if($cliente['status'] == '0') echo 'selected'?>>Inativo</option>
                      </select>
                    </div>


                    <div class="col-4 mt-3">
                <label for="sexo"><strong class="text-danger required" >*</strong>Sexo:</label>
                <select name="sexo" id="sexo" class="form-control">
                  <option value="F" <?php if($cliente['sexo'] == 'F') echo 'selected'?>>Feminino</option>
                  <option value="M" <?php if($cliente['sexo'] == 'M') echo 'selected'?>>Masculino</option>
                  <option value="N" <?php if($cliente['sexo'] == 'N') echo 'selected'?>>Não informado</option>
                </select>
              </div>

              

              
              <div class="col-4 mt-3">
                <label for="rg"><strong class="text-danger">*</strong>CPF:</label>
                <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" data-mask="000.000.000-00" value="<?php echo $cliente['cpf']?>" required>
              </div>

              <div class="col-4 mt-3">
                <label for="rg">RG:</label>
                <input type="text" name="rg" id="rg" class="form-control" maxlength="12" data-mask="00.000.000-A" value="<?php echo $cliente['rg']?>">
              </div>

                  </div>
                </div>


                <h5 class="mt-4">Endereço:</h5>

                <div class="col-3">
                <label for="cep"><strong class="text-danger">*</strong>CEP:</label>
                <input type="text" name="cep" id="cep" class="form-control" maxlength="9" data-mask="00000-000" value="<?php echo $cliente['cep']?>" required>
              </div>

              <div class="col-3">
                <label for="endereco"><strong class="text-danger">*</strong>Rua:</label>
                <input type="text" name="endereco" id="endereco" class="form-control" maxlength="70" value="<?php echo $cliente['endereco']?>" required>
              </div>

              <div class="col-3">
                <label for="bairro"><strong class="text-danger">*</strong>Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" maxlength="30" value="<?php echo $cliente['bairro']?>" required>
              </div>


              <div class="col-3">
                <label for="cidade"><strong class="text-danger">*</strong>Cidade:</label>
                <input type="text" name="cidade" id="cidade" class="form-control" maxlength="40" value="<?php echo $cliente['cidade']?>" required>

              </div>
              

              <div class="col-3 mt-3">
                <label for="estado"><strong class="text-danger">*</strong>Estado:</label>
                <select name="estado" id="estado" class="form-control" required>
                  <option value="">Selecione seu estado:</option>
                  <option value="AC" <?php if($cliente['estado'] == 'AC') echo 'selected'?>>AC</option>
                  <option value="AL" <?php if($cliente['estado'] == 'AL') echo 'selected'?>>AL</option>
                  <option value="AP" <?php if($cliente['estado'] == 'AP') echo 'selected'?>>AP</option>
                  <option value="AM" <?php if($cliente['estado'] == 'AM') echo 'selected'?>>AM</option>
                  <option value="BA" <?php if($cliente['estado'] == 'BA') echo 'selected'?>>BA</option>
                  <option value="CE" <?php if($cliente['estado'] == 'CE') echo 'selected'?>>CE</option>
                  <option value="DF" <?php if($cliente['estado'] == 'DF') echo 'selected'?>>DF</option>
                  <option value="ES" <?php if($cliente['estado'] == 'ES') echo 'selected'?>>ES</option>
                  <option value="GO" <?php if($cliente['estado'] == 'GO') echo 'selected'?>>GO</option>
                  <option value="MA" <?php if($cliente['estado'] == 'MA') echo 'selected'?>>MA</option>
                  <option value="MT" <?php if($cliente['estado'] == 'MT') echo 'selected'?>>MT</option>
                  <option value="MS" <?php if($cliente['estado'] == 'MS') echo 'selected'?>>MS</option>
                  <option value="MG" <?php if($cliente['estado'] == 'MG') echo 'selected'?>>MG</option>
                  <option value="PA" <?php if($cliente['estado'] == 'PA') echo 'selected'?>>PA</option>
                  <option value="PB" <?php if($cliente['estado'] == 'PB') echo 'selected'?>>PB</option>
                  <option value="PR" <?php if($cliente['estado'] == 'PR') echo 'selected'?>>PR</option>
                  <option value="PE" <?php if($cliente['estado'] == 'PE') echo 'selected'?>>PE</option>
                  <option value="PI" <?php if($cliente['estado'] == 'PI') echo 'selected'?>>PI</option>
                  <option value="RJ" <?php if($cliente['estado'] == 'RJ') echo 'selected'?>>RJ</option>
                  <option value="RN" <?php if($cliente['estado'] == 'RN') echo 'selected'?>>RN</option>
                  <option value="RS" <?php if($cliente['estado'] == 'RS') echo 'selected'?>>RS</option>
                  <option value="RO" <?php if($cliente['estado'] == 'RO') echo 'selected'?>>RO</option>
                  <option value="RR" <?php if($cliente['estado'] == 'RR') echo 'selected'?>>RR</option>
                  <option value="SC" <?php if($cliente['estado'] == 'SC') echo 'selected'?>>SC</option>
                  <option value="SP" <?php if($cliente['estado'] == 'SP') echo 'selected'?>>SP</option>
                  <option value="SE" <?php if($cliente['estado'] == 'SE') echo 'selected'?>>SE</option>
                  <option value="TO" <?php if($cliente['estado'] == 'TO') echo 'selected'?>>TO</option>
                </select>

              </div>

              <div class="col-3 mt-3">
                <label for="numero"><strong class="text-danger">*</strong>Número:</label>
                <input type="text" name="numero" id="numero" class="form-control" maxlength="4" value="<?php echo $cliente['numero']?>" required>
              </div>

              <div class="col-6 mt-3">
                <label for="complemento">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="form-control" maxlength="40" value="<?php echo $cliente['complemento']?>">
              </div>

              

              <h5 class="mt-4">Contato:</h5>

              <div class="col-6">
                <label for="tel_celular">Tel. Celular:</label>
                <input type="tel" name="tel_celular" id="tel_celular" class="form-control" maxlength="14" data-mask="(00)00000-0000" value="<?php echo $cliente['telefone_celular']?>">
              </div>
              
              <h5 class="mt-4">Acesso:</h5>
              <div class="col-3">
                <label for="email"><strong class="text-danger">*</strong>Email:</label>
                <input type="tel" name="email" id="email" class="form-control" maxlength="40" value="<?php echo $cliente['email']?>" required>
              </div>

              </div>

              <input type="hidden" name="editar" value="editar_cliente">
              <input type="hidden" name="codigo_cliente" value="<?php echo $codigo?>">

          <input type="submit" value="Atualizar" class="btn btn-primary btn-sm mt-3">
          
            </form>
          </div>

            </div>
          </div>
        </div>


        <?php 
        }
        else
          {
            echo 'Nenhum cliente encontrado';
          }
        ?>

      </main>
    



  <!-- JQUERY CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <!-- JQUERY MASK -->
  <script src="../../assets/js/jquery.mask.min.js"></script>


  <!-- Adicionando JQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>

  <!-- Adicionando Javascript BUSCA CEP-->
  <script>
    $(document).ready(function() {

      function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#endereco").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
        $("#ibge").val("");
      }

      //Quando o campo cep perde o foco.
      $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

          //Expressão regular para validar o CEP.
          var validacep = /^[0-9]{8}$/;

          //Valida o formato do CEP.
          if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#endereco").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#estado").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

              if (!("erro" in dados)) {
                //Atualiza os campos com os valores da consulta.
                $("#endereco").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#estado").val(dados.uf);
              } //end if.
              else {
                //CEP pesquisado não foi encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
              }
            });
          } //end if.
          else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
          }
        } //end if.
        else {
          //cep sem valor, limpa formulário.
          limpa_formulário_cep();
        }
      });
    });
  </script>

</body>

</html>