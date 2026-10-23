<?php

# CONEXÃO COM O BANCO DE DADOS #

require_once __DIR__ . "/../../conexao/conecta.php";

# INICIANDO UMA SESSÃO #

if (!isset($_SESSION)) {

    session_start();
}

?>

<?php

//raridade, status, categoria, marca, nome

//FILTROS

$raridade = $_POST['raridade'] ?? '';

$status = $_POST['status'] ?? '';

$categoria = $_POST['categoria'] ?? '';

$marca = $_POST['marca'] ?? '';

//CAMPO DE BSUCA

$nome = mysqli_real_escape_string($conexao, $_POST['nome'] ?? '');



//SQL

$sql = "SELECT 
produto.codigo_produto,
produto.foto_produto1,
produto.nome_produto,
produto.raridade_produto,
produto.quantidade_estoque,
produto.data_cadastro,
produto.status_produto
FROM produto
JOIN categoria ON produto.codigo_categoria = categoria.codigo_categoria
JOIN marca ON produto.codigo_marca = marca.codigo_marca
WHERE 1=1";

//FILTRO POR raridade

if (!empty($raridade)) {

    $raridade = mysqli_real_escape_string($conexao, $raridade);

    $sql .= " AND produto.raridade_produto = '$raridade'";
}

//FILTRO POR STATUS

if ($status != '') {

    $sql .= " AND produto.status_produto = $status";
}

//FILTRO POR categoria

if ($categoria != '') {

    $sql .= " AND produto.codigo_categoria = $categoria";
}

//FILTRO POR CIDADE

if ($marca != '') {

    $sql .= " AND produto.codigo_marca = $marca";
}

if (!empty($nome)) {
    $sql .= " AND produto.nome_produto LIKE '%$nome%'";
}

// A FUNÇÃO mysqli_query() REALIZA A CONEXÃO COM O BANCO DE DADOS E EXECUTA O COMANDO SQL

$query = mysqli_query($conexao, $sql);

if (!$query) {

    die(mysqli_error($conexao));
}

if (mysqli_num_rows($query) > 0) {

?>

    <table class="table">

        <!-- CABEÇALHO DA TABELA -->

        <thead class="table-dark">

            <!-- TABLE ROW: LINHA DA TABELA -->

            <tr>

                <!-- TABLE HEAD: TÍTULO DA COLUNA -->

                <th>Codigo Produto</th>

                <th>Foto</th>

                <th>Nome</th>

                <th>Raridade</th>

                <th>Estoque</th>

                <th>Data Cadastro</th>

                <th>Status</th>

                <th>Ações</th>

            </tr>

        </thead>

        <!-- CORPO DA TABELA -->

        <tbody>

            <?php foreach ($query as $produto) { ?>

                <!-- LINHA DA TABELA -->

                <tr>

                    <!-- TABLE DATA: DADOS DA TABELA -->

                    <td><?php echo $produto['codigo_produto'] ?></td>

                    <td>

                        <div class="foto_pro">

                            <?php

                            if ($produto['foto_produto1'] != '') {

                                echo '<img src="../../images/' . $produto['foto_produto1'] . '" alt="' . $produto['nome_produto'] . '" class="obj-cover">';
                            } else {

                                echo '<img src="../../assets/img/placeholder-produto.png" alt="' . $produto['nome_produto'] . '" class="rounded-circle obj-cover">';
                            }

                            ?>

                        </div>

                    </td>

                    <td><?php echo $produto['nome_produto'] ?></td>

                    <td><?php echo $produto['raridade_produto'] ?></td>

                    <td><?php echo $produto['quantidade_estoque'] ?></td>

                    <td><?php echo date('d/m/Y', strtotime($produto['data_cadastro'])) ?></td>

                    <td>

                        <?php

                        if ($produto['status_produto'] == 1) {

                            echo '<span class="badge text-bg-success">Ativo</span>';
                        } else {

                            echo '<span class="badge text-bg-danger">Inativo</span>';
                        }

                        ?>

                    </td>

                    <td>

                        <a href="Editar.php?codigo_produto=<?php echo $produto['codigo_produto']?>" class="btn btn-outline-success btn-sm" title="editar">

                            <i class="bi bi-pencil"></i>

                        </a>

                        <form action="acoes.php" method="post" class="d-inline">
                      <button type="submit" class="btn btn-outline-danger btn-sm" title="Excluir" name="deletar_produto" value="<?php echo $produto['codigo_produto'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">
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

    echo '<div class="alert alert-warning" role="alert">Nenhum registro encontrado!</div>';
}

?>