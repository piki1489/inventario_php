const formularios_ajax = document.querySelectorAll(".FormularioAjax");

function enviar_formulario_ajax(e) {
  e.preventDefault();

  let enviar = confirm("��Está seguro que desea enviar el formulario?");

  if (enviar == true) {
    let data = new FormData(this);
    let method = this.getAttribute("method");
    let action = this.getAttribute("action");

    let encabezados = new Headers();

    let config = {
      method: method,
      headers: encabezados,
      mode: "cors",
      cache: "no-cache",
      body: data,
    };
    fetch(action, config)
      .then((response) => response.text())
      .then((response) => {
        let contenedor = document.querySelector(".form-rest");
        contenedor.innerHTML = response;
      });
  }
}

formularios_ajax.forEach((formularios) => {
  formularios.addEventListener("submit", enviar_formulario_ajax);
});
