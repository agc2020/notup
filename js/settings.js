document.getElementById("save").addEventListener("click", showConfirmModal, false);
document.getElementById("delete").addEventListener("click", deleteAccount, false);
document.getElementById("confirm").addEventListener("click", alterUserData, false);

function showConfirmModal(){
  const confirm_modal = document.getElementById("confirm_modal");
  confirm_modal.style.display = confirm_modal.style.display == "flex" ? "none" : "flex";
}

function alterUserData(){
  const email = document.getElementById('idMail');
  const newPassword = document.getElementById('idNewPass');
  const password = document.getElementById('idPass');

  if(!email || !newPassword || !password){
    return;
  }else {
    let formulario = document.getElementById("form_update")
    let novoCampoSenha = document.createElement("input");
    novoCampoSenha.type = "hidden";
    novoCampoSenha.name = "password";
    novoCampoSenha.value = document.getElementById("idPass").value;
    formulario.appendChild(novoCampoSenha);
    formulario.submit();
  }
}

function deleteAccount(){
  window.location.href = "../php/apagar_usuario.php";
}