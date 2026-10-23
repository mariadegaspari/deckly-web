<?php 

  # CONEXÃO COM BANCO DE DADOS #
  require_once __DIR__ . "/../../conexao/conecta.php";

   # INICIANDO UMA SESSÃO #
 if (!isset($_SESSION))
  {
    session_start();
  }


  # CADASTRANDO UMA NOVA MARCA #
  if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_marca")
    {

      $marca = mysqli_real_escape_string($conexao, $_POST['marca']);
      $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);

      $sql = "INSERT INTO marca VALUES (0, '$marca', '$observacao', NOW(), 1)";

     try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Marca cadastrada com sucesso!";

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

    # ATUALIZANDO UMA NOVA MARCA #
  if (isset($_POST['editar']) && $_POST['editar'] == "editar_marca")
    {

      $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_marca']);


      $marca = mysqli_real_escape_string($conexao, $_POST['marca']);
      $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
      $status = mysqli_real_escape_string($conexao, $_POST['status']);

      $sql = "UPDATE marca SET nome_marca = '$marca', observacao = '$observacao', status_marca = $status WHERE codigo_marca = '$codigo'";

     try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Marca atualizada com sucesso!";

        }

        else 
          {
            //die("Erro: " .$sql . "<br>" .mysqli_error($conexao));
            $_SESSION['mensagem'] = "Erro ao atualizar";

          }
     }
      catch (mysqli_sql_exception)
      {
        $_SESSION['mensagem'] = "Erro ao cadastrar";
      }

      header('Location: Index.php');
    }

    # EXCLUINDO UM MARCA #
   if (isset($_POST['deletar_marca']))
  {
    
    $codigo = $_POST['deletar_marca'];

    try
    {
      $sql = "DELETE FROM marca WHERE codigo_marca = $codigo";
      if (!mysqli_query($conexao, $sql))
      {
        throw new Exception(mysqli_error($conexao), mysqli_errno($conexao));
      }
      
      $_SESSION['mensagem'] = "Marca excluída com sucesso";
      header("Location: index.php");
    }
    catch (Exception $e)
    {
      if ($e->getCode() == 1451)
      {
        $sql = "SELECT COUNT(produto.codigo_marca), marca.nome_marca FROM produto JOIN marca ON produto.codigo_marca = marca.codigo_marca WHERE produto.codigo_marca = $codigo";
        $query = mysqli_query($conexao, $sql);
        $consulta = mysqli_fetch_row($query);
        $_SESSION['mensagem'] = "Marca \"$consulta[1]\" não pode ser excluído pois está relacionado a $consulta[0] produto(s)";
        header("Location: index.php");
      }
      else
      {
        $_SESSION['mensagem'] = "Erro ao excluir marca";
        header("Location: index.php");
      }
    }
  }
?>
