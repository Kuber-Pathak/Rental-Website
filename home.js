window.addEventListener("scroll", function () {
  let header = document.querySelector("#navbar");
  header.classList.toggle("sticky", window.scrollY > 0);
});

let option_labels = document.querySelectorAll(".option-label");

option_labels.forEach((option_label) => {
  option_label.addEventListener("click", () => {
    // document.querySelector(".active")?.classList.remove("active");
    option_label.classList.toggle("active");
  });
});

let Dropdown = document.querySelector(".dropdown");
Dropdown.classList.toggle("hide");
let user = document.querySelector(".user-content");
document.querySelector(".left-side").addEventListener("click", () => {
  if (Dropdown.classList.contains("hide")) {
    Dropdown.classList.toggle("hide");
    user.style["boxShadow"] =
      "rgba(50, 50, 93, 0.25) 0px 8px 8px -4px, rgba(0, 0, 0, 0.3) 0px 4px 8px -8px";
  } else {
    user.style["boxShadow"] = "";
    Dropdown.classList.toggle("hide");
  }
});
