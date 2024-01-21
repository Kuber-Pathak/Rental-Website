function DoAnimation() {
  var targetaElement = document.getElementById("targeta");
  targetaElement.className = "animate1";

  var targetbElement = document.getElementById("targetb");
  targetbElement.className = "animate2";

  var targetcElement = document.getElementById("targetc");
  targetcElement.className = "animate3";

  var targetdElement = document.getElementById("targetd");
  targetdElement.className = "animate4";
}

function RevAnimation() {
  var targetaElement = document.getElementById("targeta");
  targetaElement.className = "animate5";

  var targetbElement = document.getElementById("targetb");
  targetbElement.className = "animate6";

  var targetcElement = document.getElementById("targetc");
  targetcElement.className = "animate7";

  var targetdElement = document.getElementById("targetd");
  targetdElement.className = "animate8";
}

function subanimation() {
  var targetaElement = document.getElementById("targeta");
  targetaElement.className = "animate9";

  var targetbElement = document.getElementById("targetb");
  targetbElement.className = "animate10";

  var targetcElement = document.getElementById("targetc");
  targetcElement.className = "animate11";

  var targetdElement = document.getElementById("targetd");
  targetdElement.className = "animate12";
}

function dubanimation() {
  var targetaElement = document.getElementById("targeta");
  targetaElement.className = "animate13";

  var targetbElement = document.getElementById("targetb");
  targetbElement.className = "animate14";

  var targetcElement = document.getElementById("targetc");
  targetcElement.className = "animate15";

  var targetdElement = document.getElementById("targetd");
  targetdElement.className = "animate16";
}

function CheckPassword(password) {
  // Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character:
  const pass_rgex =
    "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$";

  if (password.value.match(pass_rgex)) {
    return true;
  } else if (password.value == "") {
    document.querySelector("#format").innerHTML =
      " * Enter the credentials first.";
    return false;
  } else {
    document.querySelector("#format").innerHTML =
      " * Password must contain:<br> Minimum 8 characters<br> 1 uppercase<br> 1 lowercase<br> 1 number <br> 1special character.";

    document.getElementById("format").style.padding = "10px";
    return false;
  }
}

let show = document.getElementById("ishow");
let hide = document.getElementById("ihide");
hide.style.display = "none";
document.querySelector(".iicons").addEventListener("click", () => {
  let Password = document.getElementById("ipassword");
  if (Password.type == "password") {
    Password.type = "text";
    show.style.display = "none";
    hide.style.display = "block";
  } else {
    Password.type = "password";
    hide.style.display = "none";
    show.style.display = "block";
  }
});

let ishow = document.getElementById("show");
let ihide = document.getElementById("hide");
ihide.style.display = "none";
document.querySelector(".icons").addEventListener("click", () => {
  let iPassword = document.getElementById("password");
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
