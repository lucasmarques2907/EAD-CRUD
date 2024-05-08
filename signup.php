<?php
include_once 'header.php';
?>
<div class="container ">
  <div class="row col-lg-5 col-md-6 col-sm-12 m-auto">
    <section class="signupForm">
      <h2 class="formTitle text-center">Cadastro</h2>
      <form action="includes/signup.inc.php" method="post">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="username" placeholder="username">
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
        <button type="submit" name="submit" class="btnForm d-flex m-auto">Cadastrar</button>
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
            }).then(()=>location.href='signup.php');
          ";
    break;
    case "invalidusername":
      echo "
            Swal.fire({
              icon: 'error',
              title: 'Nome inválido',
              html: '<b>Número de caracteres aceitos:</b><br>De 2 à 30<br><b>Caracteres aceitos:</b><br>Letras maiúsculas ou minúsculas<br>Sem acentos<br>Números',
            }).then(()=>location.href='signup.php');
          ";
    break;
    case "differentpassword":
      echo "
            Swal.fire({
              icon: 'error',
              title: 'Senhas diferentes',
              text: 'Suas senhas não são iguais, tente novamente!',
            }).then(()=>location.href='signup.php');
          ";
    break;
    case "stmtfailed":
      echo "
            Swal.fire({
              icon: 'error',
              title: 'Algo deu errado',
              text: 'Por favor, tente novamente!',
            }).then(()=>location.href='signup.php');
          ";
    break;
    case "userexists":
      echo "
            Swal.fire({
              icon: 'question',
              title: 'Usuário já existe',
              text: 'Deseja fazer login ou cadastrar com outro nome de usuário?',
              showDenyButton: true,
              denyButtonColor: '#4887DF',
              confirmButtonText: 'Login',
              denyButtonText: 'Cadastrar'
            }).then((result) => {
              if (result.isConfirmed) {
              location.href='login.php';
            } else if (result.isDenied) {
              location.href='signup.php';
            }
            });
          ";
    break;
  }
  echo "</script>";
  echo "</div>";
}

include_once 'footer.php';
?>