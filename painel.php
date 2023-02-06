<!doctype html>
<html lang="pt-BR">

<head>

<!--  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" /> -->

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />


  <!-- Meta tags Obrigatórias -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  
  <title>SEDUC Obras</title>

  <!-- Bootstrap CSS -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!-- HTML5Shiv -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->

  <!-- Estilo customizado -->
  <link rel="stylesheet" type="text/css" href="css/estilo.css">

  <title>Obras - Secretaria de Educação</title>
  <link rel="icon" href="imagens/favicon.ico">


  <title>SEDUC Obras</title>
  <style>
    @media print {

      .no-print,
      .no-print * {
        display: none !important;
        height: 0 !important;
      }
    }
  </style>
</head>

<body>

<header><!-- inicio Cabecalho -->
  <?php
  include('config.php');
  include('function-seduc.php');

  session_start();

  if (!isset($_SESSION['user'])) {
    header("location:index.php");
  }
  ?>






<nav class="navbar navbar-expand-md navbar-light fixed-top navbar-transparente">
      <div class="container">

        <a href="index.html" class="navbar-brand">
          <img src="imagens/logo-prefeitura.png" width="80">
        </a>

<!-- ======= Mobile nav toggle button ======= -->
<button class='navbar-toggler collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='true' aria-label='Toggle navigation'>
  <span class='icon-bar top-bar'></span>
    <span class='icon-bar middle-bar'></span>
    <span class='icon-bar bottom-bar'></span>
</button>

  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
    <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
    <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="painel.php">Home</a>
          </li>








          <?php

echo "<li class='nav-item dropdown'>
      <span class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Cadastrar</span>
      <ul class='dropdown-menu dropdown-menu-dark'>";


          //verifica autoridade
          if (liberaFuncaoParaAutoridade(3)) {
            echo "<li class='dropdown-item'>
            <a class='nav-link' href='?page=novousuario'>Novo Usuário</a>
            </li>";
          }

          if (liberaFuncaoParaAutoridade(3)) {
            echo "<li class='dropdown-item'>
            <a class='nav-link' href='?page=novaobra'>Nova Obra</a>
            </li>";
          }


          if (liberaFuncaoParaAutoridade(2)) {
            echo  "<li class='dropdown-item'>
                      <a class='nav-link' href='?page=novorelatorio'>Novo Relatório</a>
                  </li>";
          }


          if (liberaFuncaoParaAutoridade(3)) {
            echo "<li class='dropdown-item'>
                      <a class='nav-link' href='?page=novaescola'>Nova Escola</a>
                    </li>";
          }

          if (liberaFuncaoParaAutoridade(3)) {
            echo  "<li class='dropdown-item'>
                    <a class='nav-link' href='?page=novofornecedor'>Novo Fornecedor</a>
                  </li>";
          }

          if (liberaFuncaoParaAutoridade(3)) {
            echo  "<li class='dropdown-item'>
                    <a class='nav-link' href='?page=novocontrato'>Novo Contrato</a>
                  </li>";
          }


          echo "</ul>
                </li>";




                echo "<li class='nav-item dropdown'>
                <span class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Consultar</span>
                <ul class='dropdown-menu dropdown-menu-dark'>";


          if (liberaFuncaoParaAutoridade(3)) {
            echo "<li class='dropdown-item'>
                    <a class='nav-link' href='?page=listaobra'>Lista de Obras</a>
                  </li>";
          }

          try {
            $sql = $conn->prepare("SELECT COUNT(cd_Relatorio) AS qtdPendente FROM relatorioview
                                    WHERE nm_situacaoRelatorio = ?");
            $situacao = "Pendente";
            $sql->bind_param('s', $situacao);
            $sql->execute();
            $res = $sql->get_result();
            $row = $res->fetch_object();
          } catch (mysqli_sql_exception $e) {
            print "<script>alert('Ocorreu um erro interno ao buscar dados do relatório');
                          window.history.go(-1);</script>";
            criaLogErro($e);
          }

          if (liberaFuncaoParaAutoridade(3)) {
            echo "<div>
                    <li class='dropdown-item' style='display: flex;'>
                    <a class='nav-link' href='?page=listar_relatorio'>
                      Lista de Relatórios 
                    </a>
                    <a style='margin: auto; position: absolute; transform: translate(320%, 190%);' title='Nº de relatório pendente' class='btn btn-danger badge rounded-pill' href='?page=listar_relatorio&pendente'>
                    $row->qtdPendente
                    </a>
                  </li>
                  </div>";
          }

          if (liberaFuncaoParaAutoridade(3)) {
            echo "<li class='dropdown-item'>
                    <a class='nav-link' href='?page=listar_escolas'>Lista de Escolas</a>
                  </li>";
          }

          if (liberaFuncaoParaAutoridade(3)) {
            echo "<li class='dropdown-item'>
                    <a class='nav-link' href='?page=listar_fornecedores'>Lista de Fornecedores</a>
                  </li>";
          }

          if (liberaFuncaoParaAutoridade(3)) {
            echo "<li class='dropdown-item'>
                    <a class='nav-link' href='?page=listar_contratos'>Lista de Contratos</a>
                  </li>";
          }

          if (liberaFuncaoParaAutoridade(3)) {
            echo "<li class='dropdown-item'>
                    <a class='nav-link' href='?page=listar_usuario'>Lista de Usuários</a>
                  </li>";
          }

          echo "</ul>
                </li>";

          ?>

          <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="?page=logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  </header>
  
  <section id="" class="caixa">
  <div class="container">
    <div class="row">
      <div class="col mt-5">
        <?php
        switch (@$_REQUEST["page"]) {
          case "novaobra":
            include("obra/nova-obra.php");
            break;
          case "novorelatorio":
            include("relatorio/novo-relatorio.php");
            break;
          case "novorelatorio":
            include("relatorio/novo-relatorio2.php");
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
          case "ver_relatorio":
            include("relatorio/imprimir.php");
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
          case "logout":
            include("usuario/logout-usuario.php");
            break;
          case "formvalues":
            include("formvalues.php");
            break;
            default:
            if ($_SESSION["user"][1] != null)
              print "<h3>Bem vindo, {$_SESSION["user"][0]}!</h3>";
        }
        ?>

      </section>

    <section id="home" class="d-flex"><!--home -->
    <div class="container align-self-center"><!--container -->
      <div class="row"><!--row -->
        <div class="col-md-12 capa">

          <div id="carousel-spotify" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner"><!--Inner -->

              <div class="carousel-item active">
                <h1>Departamento de Obras</h1>
              </div>

              <div class="carousel-item">
                <h1>SEDUC - Secretaria de Educação</h1>
              </div>

            </div><!--/Inner -->



          </div>

        </div>
      </div><!--/row -->
    </div><!--/container -->
  </section><!--/home -->

 



  <section id="servicos" class="caixa">
    <div class="container">
      <div class="row">
        <div class="col-md-100">



          <section id="contato" class="contato">
            <div class="container">

              <div id="contato" class="secao-title">
                <h2>Contato</h2>
                <p>Em caso de dúvida, entrar em contato.</p>
              </div>

              <div class="row" data-aos="fade-in">

                <div class=" ">
                  <div class="info">
                    <div class="address">
                      <i class="bi bi-geo-alt"></i>
                      <h4>Localização:</h4>
                      <p>Av. Capitão-Mor Aguiar, 798 - Centro, São Vicente - SP</p>
                    </div>

                    <div class="email">
                      <i class="bi bi-envelope"></i>
                      <h4>Email:</h4>
                      <p>diego@gmail.com</p>
                    </div>

                    <div class="phone">
                      <i class="bi bi-phone"></i>
                      <h4>Telefone:</h4>
                      <p>13 90000 - 0000</p>
                    </div>

                    <iframe
                      src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14583.579211162101!2d-46.3913952!3d-23.9641598!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x58222b1c27ac4740!2sSecretaria%20Municipal%20da%20Educa%C3%A7%C3%A3o%20de%20S%C3%A3o%20Vicente%20-%20SEDUC!5e0!3m2!1spt-BR!2sbr!4v1670513246812!5m2!1spt-BR!2sbr"
                      frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen></iframe>
                  </div>
                </div>
              </div>
            </div>
        </div>
  </section>
  


  </div>
  </div>
  </div>
  </div>
  </section>
  
  <!-- <script scr="js/bootstrap.bundle.min.js"></script> -->
  <footer>
  <div class="container">
    <div class="row" align="center">
      <div class="col-md-50">
        <h3>Departamento de Tecnologia</h3>
        <h4>Produzido por Gabriel, Enzo, Laís, Renê e Thaís</h4>
      </div>
      </ul>
    </div>
  </div>
  </div>
</footer>
</div>
<script scr="js/bootstrap.bundle.min.js"></script>
<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
  crossorigin="anonymous"></script>

</body>

</html>