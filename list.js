//for navbar
window.addEventListener("scroll", function () {
  let header = document.querySelector("#navbar");
  header.classList.toggle("sticky", window.scrollY > 0);
});

//for dropdwon
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

//for options
function updatePropertyOptions() {
  var propoertyRadios = document.getElementsByName("Property");
  var categoryTypeSelect = document.getElementById("Category");
  // var submitButton = document.querySelector('input[type="submit"]');

  // Find the selected category
  var selectedProperty;
  for (var i = 0; i < propoertyRadios.length; i++) {
    if (propoertyRadios[i].checked) {
      selectedProperty = propoertyRadios[i].value;
      break;
    }
  }

  // Enable or disable Property Type based on the selected category
  categoryTypeSelect.disabled = !selectedProperty;

  // Clear existing options
  categoryTypeSelect.innerHTML = "";

  // Add options based on the selected category
  if (selectedProperty === "residental") {
    addOption(categoryTypeSelect, "", "Select Option", true, true);
    addOption(categoryTypeSelect, "5", "1BHK");
    addOption(categoryTypeSelect, "6", "2BHK");
    addOption(categoryTypeSelect, "7", "3BHK");
    addOption(categoryTypeSelect, "8", "Flat");
    addOption(categoryTypeSelect, "9", "Singlse room");
    addOption(categoryTypeSelect, "10", "Two rooms");
  } else if (selectedProperty === "commercial") {
    addOption(categoryTypeSelect, "", "Select Option", true, true);
    addOption(categoryTypeSelect, "11", "Shutter");
    addOption(categoryTypeSelect, "12", "Shop");
    addOption(categoryTypeSelect, "13", "Office space");
    addOption(categoryTypeSelect, "14", "Warehouse/Godown");
  }

  // Enable or disable the submit button based on category selection
  // submitButton.disabled = !selectedProperty || !propertyTypeSelect.value;
}

function addOption(selectElement, value, text, disabled, selected) {
  var option = document.createElement("option");
  option.value = value;
  option.text = text;
  option.disabled = disabled;
  option.selected = selected;
  selectElement.add(option);
}

//For Location finder
