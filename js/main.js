document.addEventListener("DOMContentLoaded", function () {
  let bigLogin = document.querySelector("#bigLogin");
  let smallLogin = document.querySelector("#smallLogin");
  let form = document.querySelector("#login");

  
    bigLogin.addEventListener("click", () => {
      form.classList.toggle("hide-login");
    });

    smallLogin.addEventListener("click", () => {
        form.classList.toggle("hide-login");
      });
});
