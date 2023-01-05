<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <title>SEDUC Obras</title>
</head>

<body>
<?php 
  session_start();

?>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Obras</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="painelsimples.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=novorelatorio">Novo Relatório</a>
          <li class="nav-item">
            <a class="nav-link" href="?page=listaobra">Lista de Obras</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=listar_relatorio">Lista de Relatórios</a>
          </li>

          <?php
         
          if($_SESSION["user"][1] > 3 && isset($_SESSION["user"][1])){
              echo "<li class='nav-item'>
              <a class='nav-link' href='?page=listar_escolas'>Lista de Escolas</a>
            </li>";
          }
          

          ?>
          <li class="nav-item">
            <a class="nav-link" href="?page=logout" >Logout</a>
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
          case "novorelatorio":
            include("relatorio/novo-relatorio.php");
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
          case "salvarobra":
            include("obra/salvar-obra.php");
            break;
          case "salvarrelatorio":
            include("relatorio/salvar-relatorio.php");
            break;
          case "editarrelatorio":
            include("relatorio/editar-relatorio.php");
            break;
          case "logout":
            include("usuario/logout-usuario.php");
            header("location: index.php");
            break;
          default:
            print "<h1>Bem vindo, {$_SESSION["user"][0]}!</h1>";
        }
        ?>
      </div>
    </div>
  </div>
  <script scr="js/bootstrap.bundle.min.js"></script>


</body>

</html>