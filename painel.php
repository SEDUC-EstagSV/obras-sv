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


  <title>SEDUC - Obras</title>

  <!-- Bootstrap CSS -->

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!-- HTML5Shiv -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->

  <!-- Estilo customizado -->
  <link rel="stylesheet" type="text/css" href="css/estilo.css">

  <link rel="icon" href="imagens/favicon.ico">

  <style>
    body {
      font-family: Helvetica, Arial, sans-serif !important;
    }

    h1,
    h2,
    h3 {
      color: #000 !important;
    }

    .h3,
    h3 {
      font-size: calc(1.3rem + .6vw) !important;
      color: #000 !important;
      font-weight: 700 !important;
      text-align: start !important;
    }

    @media print {

      .no-print,
      .no-print * {
        display: none !important;
        height: 0 !important;
      }
    }

    .dropdown-menu-dark {
      background-color: #343a40 !important;
    }

    .dropdown-item.painel:hover {
      background-color: rgba(255, 255, 255, 0.15) !important;
    }

    a.nav-link.text-light:hover {
      color: #fff !important;
    }

    .collapse.navbar-collapse {
      text-align: start !important;
    }

    .nav-container {
      padding: 0 15px !important;
      margin: 0 60px !important;
    }

    .container-body {
      margin: 0 !important;
    }

    .container,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl,
    .container-xxl {
      max-width: 1320px !important;
    }

    #servicos {
      margin: 12px !important;
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


    <nav class="navbar navbar-expand-md navbar-light fixed-top navbar-transparente no-print">
      <div class="container nav-container">

        <a href="painel.php" class="navbar-brand">
          <img src="imagens/logo-prefeitura.png" width="80">
        </a>

        <!-- ======= Mobile nav toggle button ======= -->
        <button class='navbar-toggler collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='true' aria-label='Toggle navigation'>
          <span class='icon-bar top-bar bg-light'></span>
          <span class='icon-bar middle-bar bg-light'></span>
          <span class='icon-bar bottom-bar bg-light'></span>
        </button>

        <div class='collapse navbar-collapse' id='navbarSupportedContent'>
          <ul class='navbar-nav me-auto mb-2 mb-lg-0'>
            <li class="nav-item">
              <a class="nav-link active text-light" aria-current="page" href="painel.php">Home</a>
            </li>

            <?php
            echo "<li class='nav-item dropdown text-light'>";

            if (liberaFuncaoApenasParaAutoridade(2) || liberaFuncaoApenasParaAutoridade(4)) {
              echo "<span class='nav-link dropdown-toggle text-light' href='#' role='button' 
              data-bs-toggle='dropdown' aria-expanded='false'>Cadastrar</span>";
            }
            echo "<ul class='dropdown-menu dropdown-menu-dark'>";


            //verifica autoridade
            if (liberaFuncaoParaAutoridade(4)) {
              echo "<li class='dropdown-item painel'>
            <a class='nav-link text-light' href='?page=novousuario'>Novo Usuário</a>
            </li>";
            }

            if (liberaFuncaoParaAutoridade(4)) {
              echo "<li class='dropdown-item painel'>
            <a class='nav-link text-light' href='?page=novaobra'>Nova Obra</a>
            </li>";
            }


            if (liberaFuncaoApenasParaAutoridade(2)) {
              echo  "<li class='dropdown-item painel'>
                      <a class='nav-link text-light' href='?page=novorelatorio'>Novo Relatório</a>
                  </li>";
            }


            if (liberaFuncaoParaAutoridade(4)) {
              echo "<li class='dropdown-item painel'>
                      <a class='nav-link text-light' href='?page=novaescola'>Nova Escola</a>
                    </li>";
            }

            if (liberaFuncaoParaAutoridade(4)) {
              echo  "<li class='dropdown-item painel'>
                    <a class='nav-link text-light' href='?page=novofornecedor'>Novo Fornecedor</a>
                  </li>";
            }

            if (liberaFuncaoParaAutoridade(4)) {
              echo  "<li class='dropdown-item painel'>
                    <a class='nav-link text-light' href='?page=novocontrato'>Novo Contrato</a>
                  </li>";
            }


            echo "</ul>
                </li>";


            if (liberaFuncaoParaAutoridade(3)) {
              echo "<li class='nav-item dropdown'>
                <span class='nav-link dropdown-toggle text-light' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Consultar</span>
                <ul class='dropdown-menu dropdown-menu-dark'>";


              echo "<li class='dropdown-item painel'>
                    <a class='nav-link text-light' href='?page=listaobra'>Lista de Obras</a>
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
                    <li class='dropdown-item painel' style='display: flex;'>
                    <a class='nav-link text-light' href='?page=listar_relatorio'>
                      Lista de Relatórios 
                    </a>
                <!--    <a style='margin: auto; position: absolute; transform: translate(630%);' title='Nº de relatório pendente' class='btn btn-danger badge rounded-pill' href='?page=listar_relatorio&pendente'>
                    $row->qtdPendente
                    </a> -->
                  </li>
                  </div>";
            }

            if (liberaFuncaoParaAutoridade(3)) {
              echo "<li class='dropdown-item painel'>
                    <a class='nav-link text-light' href='?page=listar_grafico'>Lista de Gráficos</a>
                  </li>";
            }

            if (liberaFuncaoParaAutoridade(3)) {
              echo "<li class='dropdown-item painel'>
                    <a class='nav-link text-light' href='?page=listar_escolas'>Lista de Escolas</a>
                  </li>";
            }

            if (liberaFuncaoParaAutoridade(3)) {
              echo "<li class='dropdown-item painel'>
                    <a class='nav-link text-light' href='?page=listar_fornecedores'>Lista de Fornecedores</a>
                  </li>";
            }

            if (liberaFuncaoParaAutoridade(3)) {
              echo "<li class='dropdown-item painel'>
                    <a class='nav-link text-light' href='?page=listar_contratos'>Lista de Contratos</a>
                  </li>";
            }

            if (liberaFuncaoParaAutoridade(3)) {
              echo "<li class='dropdown-item painel'>
                    <a class='nav-link text-light' href='?page=listar_usuario'>Lista de Usuários</a>
                  </li>";


              echo "</ul>";
            }
            ?>

            <li class="nav-item">
              <a class="nav-link text-light" href="?page=contato">Contato</a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-light" href="?page=sobre">Sobre o App</a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-light" href="?page=logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>


  </header>



  <div id="space">

    <section id="" class="caixa">
      <div class="container container-body">
        <div class="row">
          <div class="col">
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
              case "listar_grafico":
                include("grafico/listar-grafico.php");
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
              case "contato":
                include("contato.php");
                break;
              case "sobre":
                include("sobre.php");
                break;

              default:
                if ($_SESSION["user"][1] != null)

                  print "<h3 class='text-light'>Bem vindo, {$_SESSION["user"][0]}!</h3>";


                print '</section>

              <section id="home" class="d-flex"><!--home -->
    <div class="container align-self-center"><!--container -->
      <div class="row"><!--row -->
        <div class="col-md-12 capa">
<div class="titleHome">
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
        </div>
      </div><!--/row -->
    </div><!--/container -->
  </section><!--/home -->

          
          
          
                    </div>
          
                  </div>
                </div><!--/row -->
              </div><!--/container -->
            </section><!--/home -->';
            }
            ?>





          </div>
        </div>
      </div>
  </div>
  </section>

  <!-- <script scr="js/bootstrap.bundle.min.js"></script> -->




  </div>





  <script scr="js/bootstrap.bundle.min.js"></script>
  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
  crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <!-- esse import afeta o import stackpath da funcionalidade de select do bootstrap 
o import do outro afeta o css do dropdown deixando branco
uma possível solução é sobrescrever o css fazendo a estilização do painel
manualmente e colocando !important --
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
crossorigin="anonymous"></script>
      -->

</html>