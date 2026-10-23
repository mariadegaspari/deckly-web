<?php 

# CONEXÃO COM BANCO DE DADOS #
  require_once __DIR__ . "/../../conexao/conecta.php";


 # INICIANDO UMA SESSÃO #
//  if (!isset($_SESSION))
//   {
//     session_start();
//   }


  include_once __DIR__ . "/../Usuario_Admin.php";
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
        ?>

        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4 class="m-0">Novo Funcionário</h4>
            <a href="Index.php" class="btn btn-primary btn-sm">
              <i class="bi bi-arrow-left-short"></i>
              Voltar</a>
          </div>

          <div class="linha"></div>

          <div class="card-body">
            <form action="Acoes.php" method="post" enctype="multipart/form-data">
              <div class="row">

                <h5>Dados pessoais:</h5>
                <div class="col-10">
                  <div class="row">

                    <div class="col-5">
                      <label for="nome"><strong class="text-danger">*</strong>Nome: </label>
                      <input type="text" name="nome" id="nome" class="form-control" maxlength="60" required>
                    </div>

                    <div class="col-5">
                      <label for="nome_social">Nome social: </label>
                      <input type="text" name="nome_social" id="nome_social" class="form-control" maxlength="60">
                    </div>


                    <div class="col-5 mt-3">
                      <label for="foto">Coloque sua foto aqui:</label>
                      <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                    </div>

                    <div class="col-5 mt-3">
                <label for="sexo"><strong class="text-danger required" >*</strong>Sexo:</label>
                <select name="sexo" id="sexo" class="form-control">
                  <option value="F">Feminino</option>
                  <option value="M">Masculino</option>
                  <option value="N">Não informado</option>
                </select>
              </div>

              <div class="col-2 mt-3">
                <label for="datanascimento"><strong class="text-danger">*</strong>Data de Nascimento:</label>
                <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" maxlength="60" required>
              </div>

              
              <div class="col-2 mt-3">
                <label for="rg"><strong class="text-danger">*</strong>CPF:</label>
                <input type="text" name="cpf" id="cpf" class="form-control" maxlength="14" data-mask="000.000.000-00" required>
              </div>

              <div class="col-2 mt-3">
                <label for="rg">RG:</label>
                <input type="text" name="rg" id="rg" class="form-control" maxlength="12" data-mask="00.000.000-A">
              </div>

              <div class="col-4 mt-3">
                <label for="estado_civil">Estado civil</label>
                <select name="estado_civil" id="estado_civil" class="form-control" required>
                  <option value="Solteiro(a)">Solteiro(a)</option>
                  <option value="Casado(a)">Casado(a)</option>
                  <option value="Divorciado(a)">Divorciado(a)</option>
                  <option value="Viúvo(a)">Viúvo(a)</option>
                  <option value="Separado(a) judicialmente">Separado(a) judicialmente</option>
                  <option value="União estável">União estável</option>
                </select>
              </div>

              <div class="col-2 mt-3">
                <label for="cargo"><strong class="text-danger">*</strong>Cargo:</label>
                <select name="cargo" id="cargo" class="form-control" required>
                  <option value="">Selecione </option>

                  <?php

                  $sql_cargo = "SELECT codigo_cargo, nome FROM cargo WHERE status = 1";

                  $query_cargo = mysqli_query($conexao, $sql_cargo);

                  foreach ($query_cargo as $cargo) {

                    echo '<option value="' . $cargo['codigo_cargo'] . '">' . $cargo['nome'] . '</option>';
                  }

                  ?>

                </select>

              </div>

              <div class="col-2 mt-3">
                <label for="salario">Salário:</label>
                <input type="text" name="salario" id="salario" class="form-control" maxlength="9" data-mask="00000,00" data-mask-reverse="true" required>
              </div>

                  </div>
                </div>

                

                <div class="col-2 d-flex justify-content-center">
                  <img src="../../assets/img/placeholder-funcionario.png" alt="" class="img-fluid">
                </div>


                <h5 class="mt-4">Endereço:</h5>

                <div class="col-3">
                <label for="cep"><strong class="text-danger">*</strong>CEP:</label>
                <input type="text" name="cep" id="cep" class="form-control" maxlength="9" data-mask="00000-000" required>
              </div>

              <div class="col-3">
                <label for="endereco"><strong class="text-danger">*</strong>Rua:</label>
                <input type="text" name="endereco" id="endereco" class="form-control" maxlength="70" required>
              </div>

              <div class="col-3">
                <label for="bairro"><strong class="text-danger">*</strong>Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control" maxlength="30" required>
              </div>


              <div class="col-3">
                <label for="cidade"><strong class="text-danger">*</strong>Cidade:</label>
                <input type="text" name="cidade" id="cidade" class="form-control" maxlength="40" required>

              </div>
              

              <div class="col-3 mt-3">
                <label for="estado"><strong class="text-danger">*</strong>Estado:</label>
                <select name="estado" id="estado" class="form-control" required>
                  <option value="">Selecione seu estado:</option>
                  <option value="AC">AC</option>
                  <option value="AL">AL</option>
                  <option value="AP">AP</option>
                  <option value="AM">AM</option>
                  <option value="BA">BA</option>
                  <option value="CE">CE</option>
                  <option value="DF">DF</option>
                  <option value="ES">ES</option>
                  <option value="GO">GO</option>
                  <option value="MA">MA</option>
                  <option value="MT">MT</option>
                  <option value="MS">MS</option>
                  <option value="MG">MG</option>
                  <option value="PA">PA</option>
                  <option value="PB">PB</option>
                  <option value="PR">PR</option>
                  <option value="PE">PE</option>
                  <option value="PI">PI</option>
                  <option value="RJ">RJ</option>
                  <option value="RN">RN</option>
                  <option value="RS">RS</option>
                  <option value="RO">RO</option>
                  <option value="RR">RR</option>
                  <option value="SC">SC</option>
                  <option value="SP">SP</option>
                  <option value="SE">SE</option>
                  <option value="TO">TO</option>
                </select>

              </div>

              <div class="col-3 mt-3">
                <label for="numero"><strong class="text-danger">*</strong>Número:</label>
                <input type="text" name="numero" id="numero" class="form-control" maxlength="4" required>
              </div>

              <div class="col-6 mt-3">
                <label for="complemento">Complemento:</label>
                <input type="text" name="complemento" id="complemento" class="form-control" maxlength="40">
              </div>

              

              <h5 class="mt-4">Contato:</h5>
              <div class="col-6">
                <label for="tel_residencial">Tel. Residencial:</label>
                <input type="tel" name="tel_residencial" id="tel_residencial" class="form-control" maxlength="13" data-mask="(00)0000-0000">
              </div>

              <div class="col-6">
                <label for="tel_celular">Tel. Celular:</label>
                <input type="tel" name="tel_celular" id="tel_celular" class="form-control" maxlength="14" data-mask="(00)00000-0000">
              </div>
              
              <h5 class="mt-4">Acesso:</h5>
              <div class="col-3">
                <label for="email"><strong class="text-danger">*</strong>Email:</label>
                <input type="tel" name="email" id="email" class="form-control" maxlength="40" required>
              </div>


              <div class="col-3">
                <label for="usuario"><strong class="text-danger">*</strong>Usuário:</label>
                <input type="tel" name="usuario" id="usuario" class="form-control" maxlength="13" required>
              </div>


              <div class="col-3">
                <label for="tipoacesso"><strong class="text-danger">*</strong>Tipo de acesso:</label>
                <select name="tipo_acesso" id="tipo_acesso" class="form-control" required>
                  <option value="">Selecione o tipo de acesso</option>
                  <option value="0">Comum</option>
                  <option value="1">Administrador</option>
                </select>
              </div>

              <div class="col-3">
                  <label for="senha"><strong class="text-danger">*</strong>Senha:</label>
                  <input type="password" name="senha" id="senha" class="form-control" maxlength="9" required>
                </div>

              </div>

              <input type="hidden" name="cadastrar" value="cadastrar_funcionario">

          <input type="submit" value="Cadastrar" class="btn btn-primary btn-sm mt-3">
          
            </form>
          </div>

            </div>
          </div>
        </div>


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