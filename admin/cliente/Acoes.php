<?php

  # CONEXÃO COM O BANCO DE DADOS #
  require_once __DIR__ . "/../../conexao/conecta.php";

    # INICIANDO UMA SESSÃO #
 if (!isset($_SESSION))
  {
    session_start();
  }

  # CADASTRANDO UM NOVO CLIENTE#
  if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_cliente")
    {
      $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
      $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
      $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
      $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
      $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
      $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
      $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
      $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
      $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
      $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
      $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
      $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
      $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
      $tel_celular = mysqli_real_escape_string($conexao, $_POST['tel_celular']);
      $email = mysqli_real_escape_string($conexao, $_POST['email']);
      //$status = mysqli_real_escape_string($conexao, $_POST['status']);
      //$data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);


      # INSERT #
      $sql = "INSERT INTO cliente VALUES(0, '$nome', '$nome_social', '$data_nascimento', '$sexo', '$cpf', '$rg', '$endereco', '$numero','$complemento', '$bairro', '$cidade', '$estado', '$cep', '$tel_celular', '$email', NOW(), 1)";

      
      if (mysqli_query($conexao, $sql))
        {
          header('Location: Index.php');
        }

      else
        {
          die("Erro: " .$sql ."<br>" .mysqli_error($conexao));
        }

        
    }

    # ATUALIZANDO UM CLIENTE #
  if (isset($_POST['editar']) && $_POST['editar'] == "editar_cliente")
    {
      $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_cliente']);

      $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
      $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
      $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
      $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
      $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
      $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
      $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
      $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
      $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
      $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
      $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
      $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
      $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
      $tel_celular = mysqli_real_escape_string($conexao, $_POST['tel_celular']);
      $email = mysqli_real_escape_string($conexao, $_POST['email']);
      $status = mysqli_real_escape_string($conexao, $_POST['status']);
      //$data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);


      # INSERT #
      $sql = "UPDATE cliente SET nome = '$nome', nome_social = '$nome_social', data_nascimento = '$data_nascimento', sexo = '$sexo', cpf ='$cpf', rg ='$rg', endereco = '$endereco', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep', telefone_celular = '$tel_celular', email = '$email', status = $status WHERE codigo_cliente = '$codigo'";

      try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Cliente atualizado com sucesso!";

        }

        else 
          {
            //die("Erro: " .$sql . "<br>" .mysqli_error($conexao));
            $_SESSION['mensagem'] = "Erro ao atualizar";

          }
     }
      catch (mysqli_sql_exception)
      {
        $_SESSION['mensagem'] = "Erro ao atualizar";
      }

      header('Location: Index.php');
    }
    
    # EXCLUINDO UM FUNCIONÁRIO #
   if (isset($_POST['deletar_cliente']))
  {
    
    $codigo = $_POST['deletar_cliente'];

    try
    {
      $sql = "DELETE FROM cliente WHERE codigo_cliente = $codigo";
      if (!mysqli_query($conexao, $sql))
      {
        throw new Exception(mysqli_error($conexao), mysqli_errno($conexao));
      }
      
      $_SESSION['mensagem'] = "Cliente excluído com sucesso";
      header("Location: index.php");
    }
    catch (Exception $e)
    {
        $_SESSION['mensagem'] = "Erro ao excluir cliente";
        header("Location: index.php");
    }
  }

?>