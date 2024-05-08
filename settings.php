<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
include_once 'header.php';

if (!isset($_SESSION["userId"])) {
  echo "
    <div class='container'>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Você não está logado!',
                text: 'Tente novamente após realizar login!',
            }).then(()=>location.href='login.php');
        </script>
    </div>
    ";
  exit();
}
require_once 'config/connection.php';

$sql = mysqli_query($conn, "SELECT * FROM users WHERE usersId = '" . $_SESSION["userId"] . "';");
$aux = mysqli_fetch_assoc($sql);

echo $aux["usersId"];
echo $aux["username"];
echo $aux["created_at"];
echo $aux["edited_at"];
?>

<div class="container">
  <div class="row col-lg-5 col-md-6 col-sm-12 m-auto">
    <section class="updateForm">
      <h2 class="formTitle text-center">Atualizar perfil</h2>
      <form action="includes/update.inc.php" method="post">
        <input type="hidden" name="id" value="<?= $aux["usersId"] ?>">
        <input type="hidden" name="currentUsername" value="<?= $aux["username"] ?>">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="username" placeholder="username"
            value="<?= $aux["username"] ?>">
          <label for="username">Usuário</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="pwd" placeholder="Password">
          <label for="pwd">Senha</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="pwdRepeat" placeholder="Password">
          <label for="pwdRepeat">Repetir senha</label>
        </div>
        <div class="settingsBtn">
          <button type="submit" name="submit" class="btnForm">Atualizar</button>
          <div class="delBtn text-center">
            <a onClick="deleteUser(<?= $aux["usersId"] ?>)">Excluir</a>
          </div>
        </div>
      </form>
    </section>
  </div>
</div>

<?php
if (isset($_GET["error"])) {
  echo "<div class='container'>";
  echo "<script>";
  switch ($_GET["error"]) {
    case "emptyinput":
      echo "
            Swal.fire({
              icon: 'error',
              title: 'Campo vazio',
              text: 'Você precisa preencher todos os campos!',
            }).then(()=>location.href='settings.php');
          ";
      break;
    case "invalidusername":
      echo "
            Swal.fire({
              icon: 'error',
              title: 'Nome inválido',
              html: '<b>Número de caracteres aceitos:</b><br>De 2 à 30<br><b>Caracteres aceitos:</b><br>Letras maiúsculas ou minúsculas<br>Sem acentos<br>Números',
            }).then(()=>location.href='settings.php');
          ";
      break;
    case "differentpassword":
      echo "
            Swal.fire({
              icon: 'error',
              title: 'Senhas diferentes',
              text: 'Suas senhas não são iguais, tente novamente!',
            }).then(()=>location.href='settings.php');
          ";
      break;
    case "stmtfailed":
      echo "
            Swal.fire({
              icon: 'error',
              title: 'Algo deu errado',
              text: 'Por favor, tente novamente!',
            }).then(()=>location.href='settings.php');
          ";
      break;
    case "userexists":
      echo "
            Swal.fire({
              icon: 'error',
              title: 'Usuário já existe',
              text: 'Tente escolher outro nome',
            }).then(()=>location.href='settings.php');
          ";
      break;
    case "none":
      echo "
            Swal.fire({
              icon: 'success',
              title: 'Sucesso!',
              text: 'Seu perfil foi atualizado!',
            }).then(()=>location.href='settings.php');
          ";
      break;
  }
  echo "</script>";
  echo "</div>";
}

include_once 'footer.php';
?>