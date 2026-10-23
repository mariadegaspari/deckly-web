<?php 

  # CONEXÃO COM BANCO DE DADOS #
  require_once __DIR__ . "/../../conexao/conecta.php";

   # INICIANDO UMA SESSÃO #
 if (!isset($_SESSION))
  {
    session_start();
  }

# CADASTRANDO UM NOVO FUNCIONÁRIO #
  if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_funcionario")
    {
      $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
      $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
      //$foto = mysqli_real_escape_string($conexao, $_POST['foto']);
      $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
      $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
      $estado_civil = mysqli_real_escape_string($conexao, $_POST['estado_civil']);
      $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
      $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
      $salario = str_replace(',', '.', $_POST['salario']);
      $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
      $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
      $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
      $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
      $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
      $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
      $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
      $tel_residencial = mysqli_real_escape_string($conexao, $_POST['tel_residencial']);
      $tel_celular = mysqli_real_escape_string($conexao, $_POST['tel_celular']);
      $email = mysqli_real_escape_string($conexao, $_POST['email']);
      $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
      $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
      $tipo_acesso = mysqli_real_escape_string($conexao, $_POST['tipo_acesso']);
      //$status = mysqli_real_escape_string($conexao, $_POST['status']);
      //$data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
      $cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);

      //ENVIANDO A FOTO PARA O SERVIDOR

      # PEGANDO O CAMINHO DA IMAGEM #
      $foto = basename($_FILES['foto']['name']);
      # SALVANDO UM CAMINHO TEMORÁRIO NA PASTA 'TMP' #
      $tmp = $_FILES['foto']['tmp_name'];
      # CRIANDO O CAMINHO PARA A PASTA FINAL #
      $final = "../../images/" . $foto;
      # MOVENDO A IMAGEM DA PASTA TMP PARA A PASTA IMAGES
      move_uploaded_file($tmp, $final);

      # INSERT #
      $sql = "INSERT INTO funcionario VALUES (0, '$nome', '$nome_social', '$foto', '$data_nascimento', '$sexo', '$estado_civil', '$cpf', '$rg', '$salario', '$tel_residencial', '$tel_celular', '$endereco', '$complemento', '$bairro', '$cidade', '$estado', '$cep', $numero, '$email', '$usuario', '$senha', $tipo_acesso, NOW(), 1, $cargo)";

     try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Funcionario cadastrado com sucesso!";

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

      header('Location: Inserir.php');
    }


# ATUALIZANDO UM FUNCIONÁRIO #
if (isset($_POST['editar']) && $_POST['editar'] == "editar_funcionario")
    {

      $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_funcionario']);

      $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
      $nome_social = mysqli_real_escape_string($conexao, $_POST['nome_social']);
      //$foto = mysqli_real_escape_string($conexao, $_POST['foto']);
      $data_nascimento = mysqli_real_escape_string($conexao, $_POST['data_nascimento']);
      $sexo = mysqli_real_escape_string($conexao, $_POST['sexo']);
      $estado_civil = mysqli_real_escape_string($conexao, $_POST['estado_civil']);
      $cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);
      $rg = mysqli_real_escape_string($conexao, $_POST['rg']);
      $salario = str_replace(',', '.', $_POST['salario']);
      $endereco = mysqli_real_escape_string($conexao, $_POST['endereco']);
      $numero = mysqli_real_escape_string($conexao, $_POST['numero']);
      $complemento = mysqli_real_escape_string($conexao, $_POST['complemento']);
      $bairro = mysqli_real_escape_string($conexao, $_POST['bairro']);
      $cidade = mysqli_real_escape_string($conexao, $_POST['cidade']);
      $estado = mysqli_real_escape_string($conexao, $_POST['estado']);
      $cep = mysqli_real_escape_string($conexao, $_POST['cep']);
      $tel_residencial = mysqli_real_escape_string($conexao, $_POST['tel_residencial']);
      $tel_celular = mysqli_real_escape_string($conexao, $_POST['tel_celular']);
      $email = mysqli_real_escape_string($conexao, $_POST['email']);
      $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
      $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
      $tipo_acesso = mysqli_real_escape_string($conexao, $_POST['tipo_acesso']);
      $status = mysqli_real_escape_string($conexao, $_POST['status']);
      //$data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
      $cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);

      //ENVIANDO A FOTO PARA O SERVIDOR

      # PEGANDO O CAMINHO DA IMAGEM #
      $foto = basename($_FILES['foto']['name']);
      # SALVANDO UM CAMINHO TEMORÁRIO NA PASTA 'TMP' #
      $tmp = $_FILES['foto']['tmp_name'];
      # CRIANDO O CAMINHO PARA A PASTA FINAL #
      $final = "../../images/" . $foto;
      # MOVENDO A IMAGEM DA PASTA TMP PARA A PASTA IMAGES
      move_uploaded_file($tmp, $final);

      # UPDATE #
      $sql = "UPDATE funcionario SET nome = '$nome', nome_social = '$nome_social', data_nascimento = '$data_nascimento', sexo = '$sexo', estado_civil = '$estado_civil', cpf = '$cpf', rg = '$rg', salario = '$salario', endereco = '$endereco', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep', telefone_residencial = '$tel_residencial', telefone_celular = '$tel_celular', email = '$email', usuario = '$usuario', senha = '$senha', tipo_acesso = $tipo_acesso, status = $status, codigo_cargo = $cargo";

      //VERIFICAR SE O CAMPO FOTO ESTÁ VAZIO OU NÃO PARA SUBSTITUIR FOTO EXISTENTE
      if(!empty($foto))
        {
          $sql .= ", foto = '$foto'";
        }

        //COMPLETANDO O UPDATE COM CLAUSULA WHERE
      $sql .= " WHERE codigo_funcionario = $codigo";

     try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Funcionário atualizado com sucesso!";

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
   if (isset($_POST['deletar_funcionario']))
  {
    
    $codigo = $_POST['deletar_funcionario'];

    try
    {
      $sql = "DELETE FROM funcionario WHERE codigo_funcionario = $codigo";
      if (!mysqli_query($conexao, $sql))
      {
        throw new Exception(mysqli_error($conexao), mysqli_errno($conexao));
      }
      
      $_SESSION['mensagem'] = "Funcionário excluído com sucesso";
      header("Location: index.php");
    }
    catch (Exception $e)
    {
        $_SESSION['mensagem'] = "Erro ao excluir funcionário";
        header("Location: index.php");
    }
  }
?>


