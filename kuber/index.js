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
