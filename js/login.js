document.getElementById("submit").addEventListener("click", handleLogin, false);

function handleLogin(e) {
  let email = document.getElementById("idMail").value;
  let password = document.getElementById("idPass").value;
  
  if (!email || !password) {
    e.preventDefault();
    let alert = document.getElementById("alert");
    alert.classList.add("visible");
    setTimeout(() => {
      alert.classList.remove("visible");
    }, 3000);
  } else {
    console.log("Passou na validação");
  }
}