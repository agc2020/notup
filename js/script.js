document.getElementById("user_settings").addEventListener("click", toggleUserSettingsModal, false);

function toggleUserSettingsModal(){
  const user_modal = document.getElementById("user_modal");
  user_modal.style.display = user_modal.style.display == "flex" ? "none" : "flex";
}