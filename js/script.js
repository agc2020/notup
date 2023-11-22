(function getParameters() {

  var params = new Array();
  var paramsRet = new Array();
  var url = window.location.href;     // Obtém a URL
  var paramsStart = url.indexOf("?"); // Procura ? na URL
  if (paramsStart != -1) {
    var paramString = url.substring(paramsStart + 1); // Retorna parte da URL após ?
    paramString = decodeURIComponent(paramString);    // Decodifica código de URI da URL
    var params = paramString.split("&"); // Retorna trechos da String separados por &
    for (var i = 0; i < params.length; i++) {
      var pairArray = params[i].split("="); // Retorna trechos da String separados por =
      if (pairArray.length == 2) {
        paramsRet[pairArray[0]] = pairArray[1];
      }
    }
    let element = window.document.getElementById("modal_title");
    element.innerHTML = `Seja muito bem vindo à comunidade ${paramsRet["name"]}`
    handleModal()
  }
}())