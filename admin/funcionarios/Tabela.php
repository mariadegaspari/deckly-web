<?php

# CONEXÃO COM O BANCO DE DADOS #
require_once __DIR__ . "/../../conexao/conecta.php";

?>

<?php

//FILTROS
$sexo = $_POST['sexo'];
$status = $_POST['status'];
$cargo = $_POST['cargo'];
$cidade = $_POST['cidade'];

//CAMPO DE BSUCA
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);



//SQL
$sql = "SELECT funcionario.codigo_funcionario, funcionario.foto, funcionario.nome, funcionario.nome_social, funcionario.sexo, cargo.nome 'cargo', funcionario.cidade, funcionario.status, funcionario.data_cadastro FROM funcionario JOIN cargo ON funcionario.codigo_cargo = cargo.codigo_cargo WHERE 1=1";

//FILTRO POR SEXO
if(!empty($sexo))
  {
    $sql .= " AND funcionario.sexo = '$sexo'";
  }

  //FILTRO POR STATUS
  if($status != '')
    {
      $sql .= " AND funcionario.status = $status";
    }

  //FILTRO POR CARGO
  if($cargo != '')
    {
      $sql .= " AND funcionario.codigo_cargo = $cargo";
    }

  //FILTRO POR CIDADE
  if(!empty($cidade))
    {
      $sql .= " AND funcionario.cidade = '$cidade'";
    }  

    if(!empty($nome))
      {
        $sql .= " AND (IF(funcionario.nome_social != '', funcionario.nome_social, funcionario.nome)) LIKE '%$nome%'";
      }

// A FUNÇÃO mysqli_query() REALIZA A CONEXÃO COM O BANCO DE DADOS E EXECUTA O COMANDO SQL
$query = mysqli_query($conexao, $sql);

if (mysqli_num_rows($query) > 0) {



?>

  <!-- TABELA -->
  <table class="table">
    <!-- CABEÇALHO DA TABELA -->
    <thead class="table-dark">

      <!-- TABLE ROW: LINHA DA TABELA -->
      <tr>

        <!-- TABLE HEAD: TÍTULO DA COLUNA -->
        <th>Código</th>
        <th>Foto</th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Cargo</th>
        <th>Cidade</th>
        <th>Data Cadastro</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>

    <!-- CORPO DA TABELA -->
    <tbody>
      <?php foreach ($query as $funcionario) { ?>
        <!-- LINHA DA TABELA -->
        <tr>
          <!-- TABLE DATA: DADOS DA TABELA -->
          <td><?php echo $funcionario['codigo_funcionario'] ?></td>

          <td>
            <div class="foto_fun" style="width: 50px;">
              <?php
              if ($funcionario['foto'] != '') {
                echo '<img src="../../images/' . $funcionario['foto'] . '" alt="' . $funcionario['nome'] . '" class="rounded-circle img-fluid">';
              } else {
                echo '<img src="../../assets/img/placeholder-funcionario.png' . $funcionario['foto'] . '" alt="' . $funcionario['nome'] . '" class="rounded-circle img-fluid">';
              }
              ?>
            </div>
          </td>

          <!-- MOSTRAR O NOME SOCIAL, CASO EXISTA ESSE DADO NO BANCO -->
          <td>
            <?php

            if ($funcionario['nome_social'] != "") {
              echo $funcionario['nome_social'];
            } else {
              echo $funcionario['nome'];
            }
            ?>
          </td>

          <td><?php echo $funcionario['sexo'] ?></td>
          <td><?php echo $funcionario['cargo'] ?></td>
          <td><?php echo $funcionario['cidade'] ?></td>
          <td><?php echo date('d/m/Y', strtotime($funcionario['data_cadastro'])) ?></td>
          <td>
            <?php
            if ($funcionario['status'] == 1) {
              echo '<span class="badge text-bg-success">Ativo</span>';
            } else {
              echo '<span class="badge text-bg-danger">Inativo</span>';
            }
            ?>
          </td>

          <td>
            <a href="Editar.php?codigo_funcionario=<?php echo $funcionario['codigo_funcionario']?>" class="btn btn-outline-success btn-sm" title="editar">
              <i class="bi bi-pencil"></i>
            </a>

            <form action="acoes.php" method="post" class="d-inline">
                      <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_funcionario" value="<?php echo $funcionario['codigo_funcionario'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>

          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

<?php
} 
else 
{
  echo '<div class="alert alert-warning" role="alert">Nenhum registro encontrado!</div>';
}
?>