<?php
include_once 'header.php';
?>
<div class="container">
    <div class="row col-lg-5 col-md-8 col-sm-12 m-auto">
        <section class="loginForm">
            <h2 class="formTitle text-center">Login</h2>
            <form action="includes/login.inc.php" method="post">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="username" placeholder="username">
                    <label for="username">Usuário</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="pwd" placeholder="Password">
                    <label for="pwd">Senha</label>
                </div>
                <button type="submit" name="submit" class="btnForm d-flex m-auto">Login</button>
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
                    }).then(()=>location.href='login.php');
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
        case "stmtfailed":
            echo "
                    Swal.fire({
                        icon: 'error',
                        title: 'Algo deu errado',
                        text: 'Por favor, tente novamente!',
                    }).then(()=>location.href='login.php');
                ";
        break;
        case "wronguser":
            echo "
                    Swal.fire({
                        icon: 'question',
                        title: 'Usuário não existe',
                        text: 'Deseja tentar novamente ou se cadastrar?',
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
        case "wrongpwd":
            echo "
                    Swal.fire({
                        icon: 'error',
                        title: 'Senha incorreta',
                        text: 'Por favor, tente novamente!',
                    }).then(()=>location.href='login.php');
                ";
        break;
    }
    echo "</script>";
    echo "</div>";
}
include_once 'footer.php';
?>