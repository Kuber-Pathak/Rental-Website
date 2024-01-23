window.addEventListener("scroll", function () {
  let header = document.querySelector("#navbar");
  header.classList.toggle("sticky", window.scrollY > 0);
});

let Dropdown = document.querySelector(".dropdown");
Dropdown.classList.toggle("hide");
document.querySelector(".left-side").addEventListener("click", () => {
  if (Dropdown.classList.contains("hide")) {
    Dropdown.classList.toggle("hide");
  } else {
    Dropdown.classList.toggle("hide");
  }
});

//validation code
function validateForm(location) {
  const pass_rgex = "/^[A-Za-z]+$/";
  if (location.value.match(pass_rgex)) {
    return true;
  } else {
    document.querySelector("#format").innerHTML =
      " * Location must be in alphabets";
    return false;
  }
}