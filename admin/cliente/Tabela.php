<?php

# CONEXÃO COM O BANCO DE DADOS #
require_once __DIR__ . "/../../conexao/conecta.php";

?>

<?php

//FILTROS
$sexo = $_POST['sexo'];
$status = $_POST['status'];
$cidade = $_POST['cidade'];

//CAMPO DE BUSCA
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$cpf = mysqli_real_escape_string($conexao, $_POST['cpf']);


$sql = "SELECT cliente.codigo_cliente, cliente.nome, cliente.nome_social, cliente.sexo, cliente.telefone_celular, cliente.cidade, cliente.cpf, cliente.status, cliente.data_cadastro FROM cliente WHERE 1=1";

//FILTRO POR SEXO
if(!empty($sexo))
  {
    $sql .= " AND cliente.sexo = '$sexo'";
  }

  //FILTRO POR STATUS
  if($status != '')
    {
      $sql .= " AND cliente.status = $status";
    }

  //FILTRO POR CIDADE
  if(!empty($cidade))
    {
      $sql .= " AND cliente.cidade = '$cidade'";
    }  

    if(!empty($nome))
      {
        $sql .= " AND (IF(cliente.nome_social != '', cliente.nome_social, cliente.nome)) LIKE '%$nome%'";
      }

      if(!empty($cpf))
      {
        $sql .= " AND cliente.cpf LIKE '%$cpf%'";
      }

// A FUNÇÃO mysqli_query() REALIZA A CONEXÃO COM O BANCO DE DADOS E EXECUTA O COMANDO SQL
$query = mysqli_query($conexao, $sql);

if (mysqli_num_rows($query) > 0) {



?>

  <!-- TABELA -->
  <table class="table" id="tabela">
    <!-- CABEÇALHO DA TABELA -->
    <thead class="table-dark">

      <!-- TABLE ROW: LINHA DA TABELA -->
      <tr>

        <!-- TABLE HEAD: TÍTULO DA COLUNA -->
        <th>Código</th>
        <th>Nome</th>
        <th>Sexo</th>
        <th>Cidade</th>
        <th>Telefone</th>
        <th>CPF</th>
        <th>Status</th>
        <th>Data Cadastro</th>
        <th>Ações</th>
      </tr>
    </thead>
    

    <!-- CORPO DA TABELA -->
    <tbody>
      <?php foreach ($query as $cliente) { ?>
        <!-- LINHA DA TABELA -->
        <tr>
          <!-- TABLE DATA: DADOS DA TABELA -->
          <td><?php echo $cliente['codigo_cliente'] ?></td>

          <!-- MOSTRAR O NOME SOCIAL, CASO EXISTA ESSE DADO NO BANCO -->
          <td>
            <?php

            if ($cliente['nome_social'] != null) {
              echo $cliente['nome_social'];
            } else {
              echo $cliente['nome'];
            }
            ?>
          </td>

          <td><?php echo $cliente['sexo'] ?></td>
          <td><?php echo $cliente['cidade'] ?></td>
          <td><?php echo $cliente['telefone_celular'] ?></td>
          <td><?php echo $cliente['cpf'] ?></td>
          <td>
            <?php
            if ($cliente['status'] == 1) {
              echo '<span class="badge text-bg-success">Ativo</span>';
            } else {
              echo '<span class="badge text-bg-danger">Inativo</span>';
            }
            ?>
          </td>
          <td><?php echo date('d/m/Y', strtotime($cliente['data_cadastro'])) ?></td>

          <td>
            <a href="Editar.php?codigo_cliente=<?php echo $cliente['codigo_cliente']?>" class="btn btn-outline-success btn-sm" title="editar">
              <i class="bi bi-pencil"></i>
            </a>

            <form action="acoes.php" method="post" class="d-inline">
                      <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_cliente" value="<?php echo $cliente['codigo_cliente'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>

          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

<?php
} else {
  echo '<div class="alert alert-danger" role="alert">Nenhum registro encontrado!</div>';
}
?>