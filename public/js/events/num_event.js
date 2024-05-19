document.querySelectorAll("#eventos .lista a").forEach((elemento) => {
  elemento.addEventListener("click", () => {
    document
      .querySelector("#eventos .lista .activo")
      .classList.remove("activo");
    elemento.parentElement.classList.add("activo");
  });
});
