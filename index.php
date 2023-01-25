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
            <a class="nav-link active" aria-current="page" href="index.php">Login</a>
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
          case "novousuario":
            include("usuario/novo-usuario.php");
            break;
          case "salvarusuario":
            include("usuario/salvar-usuario.php");
            break;
          case "recuperarusuario":
            include("usuario/recuperar-usuario.php");
            break;
          default:
            include("usuario/login-usuario.php");
        }
        ?>
      </div>
    </div>
  </div>
  <script scr="js/bootstrap.bundle.min.js"></script>
</body>

</html>