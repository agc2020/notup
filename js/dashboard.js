document.getElementById('addNoteForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var title = document.getElementById('noteTitle').value;
    var content = document.getElementById('noteContent').value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/add_note.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Exibir a nota no frontend
            var notesList = document.getElementById('notesList');
            var newNote = document.createElement('div');
            newNote.innerHTML = `<h3>${title}</h3><p>${content}</p>`;
            notesList.appendChild(newNote);

            // Limpar campos do formulário
            document.getElementById('noteTitle').value = '';
            document.getElementById('noteContent').value = '';
        } else {
            alert('Erro ao adicionar nota!');
        }
    };
    xhr.send("titulo=" + encodeURIComponent(title) + "&conteudo=" + encodeURIComponent(content));
});

document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    var currentPassword = document.getElementById('currentPassword').value;
    var newPassword = document.getElementById('newPassword').value;
    // Aqui, você pode adicionar uma chamada AJAX para enviar as senhas para o servidor
    // e verificar se a senha atual está correta antes de alterar para a nova senha
});

document.getElementById('deleteAccountForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Aqui, você pode adicionar uma chamada AJAX para lidar com a exclusão da conta
});
