function deleteUser(usersId) {
  Swal.fire({
    title: "Deseja encerrar sua conta?",
    html: "Esta ação é <b>irreversível</b>!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Sim",
    cancelButtonText: "Não",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Sua conta será encerrada.",
        icon: "success",
      }).then(() => (location.href = "includes/delete.inc.php"));
    }
  });
}

$('#dataTable').DataTable({
})