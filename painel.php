<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <title>SEDUC Obras</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Obras</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="painel.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=novousuario">Registrar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=novaobra">Nova Obra</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=novorelatorio">Novo Relatório</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=novaescola">Nova Escola</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=novofornecedor">Novo Fornecedor</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=novocontrato">Novo Contrato</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=listaobra">Lista de Obras</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=listar_relatorio">Lista de Relatórios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=listar_escolas">Lista de Escolas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=listar_fornecedores">Lista de Fornecedores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=listar_contratos">Lista de Contratos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=listar_usuario">Lista de Usuários</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col mt-5">
        <?php
        include("config.php");
        switch (@$_REQUEST["page"]) {
          case "novaobra":
            include("obra/nova-obra.php");
            break;
          case "novorelatorio":
            include("relatorio/novo-relatorio.php");
            break;
          case "novaescola":
            include("escola/nova-escola.php");
            break;
          case "novofornecedor":
            include("fornecedor/novo-fornecedor.php");
            break;
          case "novocontrato":
            include("contrato/novo-contrato.php");
            break;
          case "novousuario":
            include("usuario/novo-usuario.php");
            break;
          case "listaobra":
            include("obra/listar-obras.php");
            break;
          case "listar_escolas":
            include("escola/listar-escolas.php");
            break;
          case "listar_relatorio":
            include("relatorio/listar-relatorio.php");
            break;
          case "listar_fornecedores":
            include("fornecedor/listar-fornecedores.php");
            break;
          case "listar_contratos":
            include("contrato/listar-contratos.php");
            break;
          case "listar_usuario":
            include("usuario/listar-usuario.php");
            break;
          case "salvarobra":
            include("obra/salvar-obra.php");
            break;
          case "salvarescola":
            include("escola/salvar-escola.php");
            break;
          case "salvarrelatorio":
            include("relatorio/salvar-relatorio.php");
            break;
          case "salvarfornecedor":
            include("fornecedor/salvar-fornecedor.php");
            break;
          case "salvarcontrato":
            include("contrato/salvar-contrato.php");
            break;
          case "salvarusuario":
            include("usuario/salvar-usuario.php");
            break;
          case "editarobra":
            include("obra/editar-obra.php");
            break;
          case "editarescola":
            include("escola/editar-escola.php");
            break;
          case "editarrelatorio":
            include("relatorio/editar-relatorio.php");
            break;
          case "editarfornecedor":
            include("fornecedor/editar-fornecedor.php");
            break;
          case "editarcontrato":
            include("contrato/editar-contrato.php");
            break;
          case "gerenciarusuario":
            include("usuario/gerenciar-usuario.php");
            break;
          default:
            print "<h1>Bem vindo!</h1>";
        }
        ?>
      </div>
    </div>
  </div>
  <script scr="js/bootstrap.bundle.min.js"></script>

</body>

</html>