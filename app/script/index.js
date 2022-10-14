

let form_modify_article = document.querySelectorAll(".modifyForm");
form_modify_article.forEach(form => {
  form.style.display = "none";
})

let open_modify_article = document.querySelectorAll(".modify");
open_modify_article.forEach(button => {
  let isVisible = false;
  button.addEventListener("click", e => {
    const target = e.target;
    const toDisplay = target.nextElementSibling;
    isVisible = !isVisible;
    toDisplay.style.display = isVisible ? "block" : "none";
    target.innerHTML = isVisible ? "Annuler" : "Modifier"
  })
})