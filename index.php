<!doctype html>
<html lang="pt-br">

<head>


  <!-- Estilo customizado -->
  <link rel="stylesheet" type="text/css" href="css/estilo.css">


  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />



  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SEDUC Obras</title>


  <!-- Bootstrap CSS -->


  <!-- Font Awesome -->

  <!-- HTML5Shiv -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <![endif]-->



  <link rel="icon" href="imagens/favicon.ico">

  <style>
    body {
      padding-top: 150px;
      padding-right: 50px;
      padding-bottom: 50px;
      padding-left: 50px;
    }
  </style>




</head>

<body>

  <!--
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Obras</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
-->

  <header><!-- inicio Cabecalho -->
    <nav class="navbar navbar-expand-md navbar-light light fixed-top navbar-transparente">
      <div class="container">

        <span href="index.html" class="navbar-brand">
          <img src="imagens/logo-prefeitura.png" width="80">
          <span class="text-light text-center">Obras - SEDUC</span>
        </span>



        <!-- ======= Mobile nav toggle button ======= 
<button class='navbar-toggler collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='true' aria-label='Toggle navigation'>
  <span class='icon-bar top-bar'></span>
    <span class='icon-bar middle-bar'></span>
    <span class='icon-bar bottom-bar'></span>
</button>

  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
    <ul class='navbar-nav me-auto mb-2 mb-lg-0'> -->



        <!--  ===================   Login  ============================== 
	  <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Login</a>
          </li>
 -->



        </ul>
      </div>
      </div>
    </nav>


    <!--  ===================  FIM MENU ==============================  -->



  </header><!--/fim Cabecalho -->



  <?php
  include("config.php");
  switch (@$_REQUEST["page"]) {
    case "novousuario":
      include("usuario/novo-usuario.php");
      break;
    case "salvarusuario":
      include("usuario/salvar-usuario.php");
      break;
    case "pedidorecuperacao":
      include("usuario/pedidoRecuperacao-usuario.php");
      break;
    case "recuperarusuario":
      include("usuario/recuperar-usuario.php");
      break;

    case "validarcodigo":
      include("usuario/validarCodigoRecuperacao-usuario.php");
      break;

    case "recuperarsenha":
      include("usuario/recuperarSenha-usuario.php");
      break;
    default:
      include("usuario/login-usuario.php");
  }
  ?>





  <script scr="js/bootstrap.bundle.min.js"></script>

  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>