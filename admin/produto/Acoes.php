<?php

# CONEXÃO COM BANCO DE DADOS #
require_once __DIR__ . "/../../conexao/conecta.php";

# INICIANDO UMA SESSÃO #
if (!isset($_SESSION)) {
    session_start();
}

# CADASTRANDO UM NOVO PRODUTO #
if (isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar_produto") {

    $produto = mysqli_real_escape_string($conexao, $_POST['produto']);
    $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
    $raridade = mysqli_real_escape_string($conexao, $_POST['raridade']);
    $estoque = mysqli_real_escape_string($conexao, $_POST['estoque']);
    $custo = str_replace(',', '.', $_POST['custo']);
    $lucro = mysqli_real_escape_string($conexao, $_POST['lucro']);
    $venda = str_replace(',', '.', $_POST['venda']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $marca = mysqli_real_escape_string($conexao, $_POST['marca']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);

    # VERIFICANDO SE O PRODUTO POSSUI PROMOÇÃO #
    $status_pro = isset($_POST['promocao']) && $_POST['promocao'] !== '' ? 1 : 0;

    # SEM PROMOÇÃO, OS VALORES NUMÉRICOS SERÃO ZERO #
    $porcentagem = ($status_pro == 1 && isset($_POST['porcentagem']) && $_POST['porcentagem'] !== '')
        ? mysqli_real_escape_string($conexao, $_POST['porcentagem'])
        : 0;

    $valorPromocao = ($status_pro == 1 && isset($_POST['valorPromocao']) && $_POST['valorPromocao'] !== '')
        ? str_replace(',', '.', $_POST['valorPromocao'])
        : 0;

    # ENVIANDO A FOTO PARA O SERVIDOR #

    # PEGANDO O CAMINHO DA IMAGEM #
    $foto = basename($_FILES['foto']['name']);

    # SALVANDO O CAMINHO TEMPORÁRIO #
    $tmp = $_FILES['foto']['tmp_name'];

    # CRIANDO O CAMINHO PARA A PASTA FINAL #
    $final = "../../images/" . $foto;

    # MOVENDO A IMAGEM PARA A PASTA IMAGES #
    if (!empty($foto) && is_uploaded_file($tmp)) {
        move_uploaded_file($tmp, $final);
    }

    $sql = "INSERT INTO produto VALUES (
        0,
        '$produto',
        '$descricao',
        '$raridade',
        '$estoque',
        '$custo',
        '$lucro',
        '$venda',
        $status_pro,
        $porcentagem,
        $valorPromocao,
        '$foto',
        '',
        NOW(),
        1,
        $categoria,
        $marca
    )";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Produto cadastrado com sucesso!";
        $_SESSION['tipo_mensagem'] = "success";
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar: " . mysqli_error($conexao);
        $_SESSION['tipo_mensagem'] = "danger";
    }

    header("Location: Inserir.php");
    exit;
}


# ATUALIZANDO UM PRODUTO #
if (isset($_POST['editar']) && $_POST['editar'] == "editar_produto") {

    $codigo = mysqli_real_escape_string($conexao, $_POST['codigo_produto']);

    $produto = mysqli_real_escape_string($conexao, $_POST['produto']);
    $data_cadastro = mysqli_real_escape_string($conexao, $_POST['data_cadastro']);
    $raridade = mysqli_real_escape_string($conexao, $_POST['raridade']);
    $estoque = mysqli_real_escape_string($conexao, $_POST['estoque']);
    $custo = str_replace(',', '.', $_POST['custo']);
    $lucro = mysqli_real_escape_string($conexao, $_POST['lucro']);
    $venda = str_replace(',', '.', $_POST['venda']);

    # TRATANDO OS CAMPOS DE PROMOÇÃO #
    $promocao = isset($_POST['promocao']) && $_POST['promocao'] !== '' ? 1 : 0;

    $porcentagem = ($promocao == 1 && isset($_POST['porcentagem']) && $_POST['porcentagem'] !== '')
        ? mysqli_real_escape_string($conexao, $_POST['porcentagem'])
        : 0;

    $valorPromocao = ($promocao == 1 && isset($_POST['valorPromocao']) && $_POST['valorPromocao'] !== '')
        ? str_replace(',', '.', $_POST['valorPromocao'])
        : 0;

    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $marca = mysqli_real_escape_string($conexao, $_POST['marca']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);
    $status = mysqli_real_escape_string($conexao, $_POST['status']);

    # ENVIANDO A FOTO PARA O SERVIDOR #

    # PEGANDO O CAMINHO DA IMAGEM #
    $foto = basename($_FILES['foto']['name']);

    # SALVANDO O CAMINHO TEMPORÁRIO #
    $tmp = $_FILES['foto']['tmp_name'];

    # CRIANDO O CAMINHO PARA A PASTA FINAL #
    $final = "../../images/" . $foto;

    # MOVENDO A IMAGEM PARA A PASTA IMAGES #
    if (!empty($foto) && is_uploaded_file($tmp)) {
        move_uploaded_file($tmp, $final);
    }

    $sql = "UPDATE produto SET
        nome_produto = '$produto',
        descricao_produto = '$descricao',
        raridade_produto = '$raridade',
        quantidade_estoque = '$estoque',
        preco_custo = '$custo',
        lucro = '$lucro',
        preco_venda = '$venda',
        status_promocao = '$promocao',
        desconto_promocao = '$porcentagem',
        preco_promocao = '$valorPromocao',
        status_produto = $status,
        codigo_marca = '$marca',
        codigo_categoria = '$categoria'";

    # VERIFICANDO SE UMA NOVA FOTO FOI ENVIADA #
    if (!empty($foto)) {
        $sql .= ", foto_produto1 = '$foto'";
    }

    # COMPLETANDO O UPDATE COM A CLÁUSULA WHERE #
    $sql .= " WHERE codigo_produto = $codigo";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['mensagem'] = "Produto atualizado com sucesso!";
        $_SESSION['tipo_mensagem'] = "success";
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar: " . mysqli_error($conexao);
        $_SESSION['tipo_mensagem'] = "danger";
    }

    header("Location: Index.php");
    exit;
}


# EXCLUINDO UM PRODUTO #
if (isset($_POST['deletar_produto'])) {

    $codigo = mysqli_real_escape_string($conexao, $_POST['deletar_produto']);

    try {

        $sql = "DELETE FROM produto WHERE codigo_produto = $codigo";

        if (!mysqli_query($conexao, $sql)) {
            throw new Exception(mysqli_error($conexao), mysqli_errno($conexao));
        }

        $_SESSION['mensagem'] = "Produto excluído com sucesso";

    } catch (Exception $e) {

        $_SESSION['mensagem'] = "Erro ao excluir produto";
    }

    header("Location: index.php");
    exit;
}

?>