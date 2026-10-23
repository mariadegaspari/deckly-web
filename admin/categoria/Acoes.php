<?php 

  # CONEXÃO COM BANCO DE DADOS #
  require_once __DIR__ . "/../../conexao/conecta.php";

   # INICIANDO UMA SESSÃO #
 if (!isset($_SESSION))
  {
    session_start();
  }


  # CADASTRANDO UMA NOVA CATEGORIA #
  if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_categoria")
    {

      $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
      $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);

      $sql = "INSERT INTO categoria VALUES (0, '$categoria', '$observacao', NOW(), 1)";

     try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Categoria cadastrada com sucesso!";

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

    # ATUALIZANDO UMA NOVA CATEGORIA #
  if (isset($_POST['editar']) && $_POST['editar'] == "editar_categoria")
    {

      $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_categoria']);


      $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
      $observacao = mysqli_real_escape_string($conexao, $_POST['observacao']);
      $status = mysqli_real_escape_string($conexao, $_POST['status']);

      $sql = "UPDATE categoria SET nome_categoria = '$categoria', observacao = '$observacao', status_categoria = $status WHERE codigo_categoria = '$codigo'";

     try
     {
       if (mysqli_query($conexao, $sql))
        {
          //header('Location: Index.php');
          $_SESSION['mensagem'] = "Categoria atualizada com sucesso!";

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

     # EXCLUINDO UM CATEGORIA #
   if (isset($_POST['deletar_categoria']))
  {
    
    $codigo = $_POST['deletar_categoria'];

    try
    {
      $sql = "DELETE FROM categoria WHERE codigo_categoria = $codigo";
      if (!mysqli_query($conexao, $sql))
      {
        throw new Exception(mysqli_error($conexao), mysqli_errno($conexao));
      }
      
      $_SESSION['mensagem'] = "Categoria excluída com sucesso";
      header("Location: index.php");
    }
    catch (Exception $e)
    {
      if ($e->getCode() == 1451)
      {
        $sql = "SELECT COUNT(produto.codigo_categoria), categoria.nome_categoria FROM produto JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria WHERE produto.codigo_categoria = $codigo";
        $query = mysqli_query($conexao, $sql);
        $consulta = mysqli_fetch_row($query);
        $_SESSION['mensagem'] = "Categoria \"$consulta[1]\" não pode ser excluído pois está relacionado a $consulta[0] produto(s)";
        header("Location: index.php");
      }
      else
      {
        $_SESSION['mensagem'] = "Erro ao excluir categoria";
        header("Location: index.php");
      }
    }
  }
?>
