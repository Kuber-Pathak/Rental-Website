window.addEventListener("scroll", function () {
  let header = document.querySelector("#navbar");
  header.classList.toggle("sticky", window.scrollY > 0);
});

let ishow = document.getElementById("ishow");
let ihide = document.getElementById("ihide");
ihide.style.display = "none";
document.querySelector(".icons").addEventListener("click", () => {
  let iPassword = document.getElementById("upwd");
  if (iPassword.type == "password") {
    iPassword.type = "text";
    ishow.style.display = "none";
    ihide.style.display = "block";
  } else {
    iPassword.type = "password";
    ihide.style.display = "none";
    ishow.style.display = "block";
  }
});
