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
  var propoertyRadios = document.getElementsByName("property");
  var categoryTypeSelect = document.getElementById("category");
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
    addOption(categoryTypeSelect, "1BHK", "1BHK");
    addOption(categoryTypeSelect, "2BHK", "2BHK");
    addOption(categoryTypeSelect, "3BHK", "3BHK");
    addOption(categoryTypeSelect, "Flat", "Flat");
    addOption(categoryTypeSelect, "Single room", "Single room");
    addOption(categoryTypeSelect, "Two rooms", "Two rooms");
  } else if (selectedProperty === "commercial") {
    addOption(categoryTypeSelect, "", "Select Option", true, true);
    addOption(categoryTypeSelect, "Shutter", "Shutter");
    addOption(categoryTypeSelect, "Shop", "Shop");
    addOption(categoryTypeSelect, "Office space", "Office space");
    addOption(categoryTypeSelect, "Warehouse/Godown", "Warehouse/Godown");
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

//For Date of build
var currentDate = new Date();
var selectDate = document.getElementById("date_of_build");
var previouslySelectedDate = new Date(
  document.getElementById("previously_selected_date").value
);

// Add the "Select Date" option
var selectDateOption = document.createElement("option");
selectDateOption.value = "";
selectDateOption.text = "Select Date";
selectDateOption.selected = !previouslySelectedDate; // Set selected if no date was previously selected
selectDateOption.disabled = true;
selectDate.add(selectDateOption);

for (var i = 0; i <= 20; i++) {
  var yearOption = currentDate.getFullYear() - i;
  var option = document.createElement("option");
  option.value = yearOption;
  option.text = yearOption;

  // Check if the current option's value matches the previously selected date
  if (yearOption === previouslySelectedDate.getFullYear()) {
    option.selected = true;
  }

  selectDate.add(option);
}
//For confirmation
function showConfirmation() {
  return confirm("Are you sure you want to submit?");
}

function showCheck() {
  var form_location = document.querySelector("#search_input").value;
  var form_contact = document.querySelector("#contact").value;

  var contact_regx = /^\d{10}$/;
  var location_regx = /^[A-Za-z\s]+$/;
  if (contact_regx.test(form_contact) && location_regx.test(form_location)) {
    return true;
  } else if (
    !contact_regx.test(form_contact) &&
    !location_regx.test(form_location)
  ) {
    document.querySelector(".contact-error").innerHTML =
      "**Contact must be of 10 digits";
    document.querySelector(".location-error").innerHTML =
      "**Incorrect location format";
    return false;
  } else if (!location_regx.test(form_location)) {
    document.querySelector(".contact-error").innerHTML = "";
    document.querySelector(".location-error").innerHTML =
      "**Incorrect location format";
    return false;
  } else {
    document.querySelector(".location-error").innerHTML = "";
    document.querySelector(".contact-error").innerHTML =
      "**Contact must be of 10 digits";
    return false;
  }
}
