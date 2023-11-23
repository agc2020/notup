document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("submit").addEventListener("click", handleCadastro, false);
});

function handleCadastro(e) {
    e.preventDefault(); 

    let email = document.getElementById("email").value;
    let senha = document.getElementById("senha").value;

    let alerta = document.getElementById("alert");
    if (!email || !senha) {
        alerta.style.display = "block";
        alerta.textContent = "Todos os campos são obrigatórios!";
        return;
    }

    document.getElementById("formCadastro").submit();
}

document.querySelectorAll(".form-control").forEach(item => {
    item.addEventListener("input", () => {
        document.getElementById("alert").style.display = "none";
    });
});
