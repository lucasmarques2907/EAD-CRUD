<?php
include_once 'header.php';

if (isset($_SESSION["userId"])) {
    echo ("<h1 class='text-center mb-3'>Olá, <span class='usuario'>" . $aux["username"] . "</span>! &#x1F44B</h1>");
}
?>
<div class="container sobre text-center">
    <div class="row col-lg-9 col-md-10 col-sm-12 m-auto">
        <h2 class="mt-3">Sobre este site:</h2>
        <p class="mb-3">Este site é sobre uma atividade EAD onde cada aluno deve desenvolver um <b>Sistema de
                Gerenciamento de Usuários</b>.</p>
        <h2>Funções do sistema:</h2>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Banco de dados MySQL</p>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Registro de novos usuários</p>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Login</p>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Atualização de perfil</p>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Exclusão de conta</p>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Login único</p>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Após a exclusão de uma conta, o login excluído será liberado
            para cadastro de novos usuário</p>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Campo de senha censurado</p>
        <p class="mb-1"><i class="fa-solid fa-check"></i> Criptografia de senhas</p>
        <p class="mb-1"><i class="fa-solid fa-x"></i></i> Utilização de HTTPS</p>
        <p class="mb-3"><i class="fa-solid fa-x"></i> Automatização de testes por meio de um framework</p>
    </div>
</div>
<?php
include_once 'footer.php';
?>