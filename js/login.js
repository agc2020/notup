document.getElementById("submit").addEventListener("click", handleLogin, false);

function handleLogin(e){
  e.preventDefault();
  let email = document.getElementById("exampleFormControlInput1").value;
  let password = document.getElementById("exampleFormControlInput2").value;
  
  if(!email || !password){
    let alert = document.getElementById("alert");
    alert.classList.add("visible");
    alert.classList.remove("animate")
    setTimeout(() => {
      alert.classList.add("animate")
    }, 10)
  }else{
    console.log("passou na validação")
  }
}