// adicionando eventos
document.getElementById("submit").addEventListener("click", handleLogin, false);
const toggle_buttons = document.getElementsByClassName("toggle_button");
for (button of toggle_buttons) button.addEventListener("click", toggle_form, false);  

// colentando cookies de erros
var errorCokie = decodeURIComponent(document.cookie).split("=")[1];
if(errorCokie){
  console.log("🚀 ~ file: auth2.js:9 ~ errorCokie:", errorCokie)
  showNotify(errorCokie)
}

function handleLogin(event) {
  let email = document.getElementById("idMail").value;
  let password = document.getElementById("idPass").value;
  let name = document.getElementById("idName").value;
  const form_title = document.getElementsByClassName("login_title")[0];
  
  if (!email || !password) {
    showNotify("some fields are null!", event);
  } else if(form_title.innerHTML == "SIGN UP" && !name){
    showNotify("some fields are null!", event);
  }else{
    document.getElementById("form").submit();
  }
}

function showNotify(errorMessage, event){
  if(event){event.preventDefault();}

  const notify = document.getElementById("error_notify");
  notify.innerHTML = errorMessage;
  let alert = document.getElementById("alert");
  alert.classList.add("visible");
  alert.classList.add("animate");
  
  setTimeout(() => {
    alert.classList.remove("animate");
  }, 500);
}


function toggle_form(){
  for (button of toggle_buttons){
    button.parentNode.classList.toggle("visible");
  }
  
  const form_title = document.getElementsByClassName("login_title")[0];
  const form_name = document.getElementsByClassName("form-name");

  if(form_title.innerHTML == "SIGN IN"){
    form_title.innerHTML = "SIGN UP";
    document.getElementById("form").action = "../php/criar_usuario.php"
    for (let element of form_name) {element.style.display = "flex"}
  }else{
    form_title.innerHTML = "SIGN IN";
    document.getElementById("form").action = "../php/verificar_login.php"
    for (let element of form_name) {element.style.display = "none"}
  }
}