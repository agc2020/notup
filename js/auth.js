document.getElementById("submit").addEventListener("click", handleLogin, false);

const toggle_buttons = document.getElementsByClassName("toggle_button");
for (button of toggle_buttons) button.addEventListener("click", toggle_form, false);  

function handleLogin(e) {
  let email = document.getElementById("idMail").value;
  let password = document.getElementById("idPass").value;
  
  if (!email || !password) {
    e.preventDefault();
    let alert = document.getElementById("alert");
    alert.classList.add("visible");
    alert.classList.add("animate");
    setTimeout(() => {
      alert.classList.remove("animate");
    }, 500);
  } else {
    document.getElementById("form").submit();
  }
}

function toggle_form(){
  for (button of toggle_buttons){
    button.parentNode.classList.toggle("visible");
  }
  const form_title = document.getElementsByClassName("login_title")[0];
  if(form_title.innerHTML == "SIGN IN"){
    form_title.innerHTML = "SIGN UP";
    document.getElementById("form").action = "../php/verificar_login.php"
  }else{
    form_title.innerHTML = "SIGN IN";
    document.getElementById("form").action = "../php/criar_usuario.php"
  }
}