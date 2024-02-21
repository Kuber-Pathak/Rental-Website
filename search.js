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

//for dropdown
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

// let selectMenu = document.querySelector("#order");
// let wrapper = document.querySelector("#product-wrapper");

// selectMenu.addEventListener("change", function () {
//   let optionName = this.value;

//   // starting a AJAX http request
//   let http = new XMLHttpRequest();

//   //send the data to sort.php using post method
//   http.open("POST", "sort.php");

//   //set the content-type header to store the value in key value format
//   http.setRequestHeader("content-type", "application/x-www-form-urlenode");

//   //send the reques
//   http.send("option=" + optionName);
// });

// function submitForm() {
//   var select = document.querySelector("#searchForm");
//   select.submit();
// }

function sortProduct() {
  var select = document.querySelector("#sortOrder");
  var selectedValue = select.options[select.selectedIndex].value;
  // for (var i = 0; i < select.options.length; i++) {
  //   option = select.options[i];
  //   if ((option.value = selectedValue)) {
  //     option.setAttribute("selected", true);
  //   }
  // }
  if (window.location.href.includes("order=")) {
    newURL = window.location.href.split("order")[0] + "order";
    window.history.replaceState({}, document.title, newURL);
    window.location.href = newURL + "=" + selectedValue;
  } else if (
    window.location.href.includes("?") &&
    !window.location.href.includes("#")
  ) {
    window.location.href = window.location.href + "&order=" + selectedValue;
  } else if (window.location.href.includes("#")) {
    const urlWithoutHash = window.location.href.split("#")[0];
    const separator = urlWithoutHash.includes("?") ? "&" : "?"; // Determine if we need to start a query string or append
    window.location.href =
      urlWithoutHash + separator + "order=" + selectedValue;
  } else {
    window.location.href = window.location.href + "?order=" + selectedValue;
  }
}
