<?php 

  # CONEXÃO COM BANCO DE DADOS #
  require_once __DIR__ . "/../../conexao/conecta.php";

   # INICIANDO UMA SESSÃO #
 if (!isset($_SESSION))
  {
    session_start();
  }


  # CADASTRANDO UM  NOVO CARGO #
  if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_cargo")


    {

      $cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);
      $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);

      $sql = "INSERT INTO cargo VALUES (0, '$cargo', '$observacao', NOW(), 1)";

     try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Cargo cadastrado com sucesso!";

        }

        else 
          {
            //die("Erro: " .$sql . "<br>" .mysqli_error($conexao));
            $_SESSION['mensagem'] = "Erro ao cadastrar";

          }
     }
      catch (mysqli_sql_exception)
      {
        $_SESSION['mensagem'] = "Erro ao cadastrar";
      }

      header('Location: Inserir.php');
    }

  
  # ATUALIZANDO UM  NOVO CARGO #
  if (isset($_POST['editar']) && $_POST['editar'] == "editar_cargo")

    {
      $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_cargo']);
      
      $cargo = mysqli_real_escape_string($conexao, $_POST['cargo']);
      $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
      $status = mysqli_real_escape_string($conexao, $_POST['status']);

      $sql = "UPDATE cargo SET nome ='$cargo', observacao ='$observacao', status = $status WHERE codigo_cargo = $codigo";

     try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Cargo atualizado com sucesso!";

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

    # EXCLUINDO UM CARGO #
   if (isset($_POST['deletar_cargo']))
  {
    
    $codigo = $_POST['deletar_cargo'];

    try
    {
      $sql = "DELETE FROM cargo WHERE codigo_cargo = $codigo";
      if (!mysqli_query($conexao, $sql))
      {
        throw new Exception(mysqli_error($conexao), mysqli_errno($conexao));
      }
      
      $_SESSION['mensagem'] = "Cargo excluído com sucesso";
      header("Location: index.php");
    }
    catch (Exception $e)
    {
      if ($e->getCode() == 1451)
      {
        $sql = "SELECT COUNT(funcionario.codigo_cargo), cargo.nome FROM funcionario JOIN cargo ON funcionario.codigo_cargo = cargo.codigo_cargo WHERE funcionario.codigo_cargo = $codigo";
        $query = mysqli_query($conexao, $sql);
        $consulta = mysqli_fetch_row($query);
        $_SESSION['mensagem'] = "Cargo \"$consulta[1]\" não pode ser excluído pois está relacionado a $consulta[0] funcionários";
        header("Location: index.php");
      }
      else
      {
        $_SESSION['mensagem'] = "Erro ao excluir cargo";
        header("Location: index.php");
      }
    }
  }
?>
