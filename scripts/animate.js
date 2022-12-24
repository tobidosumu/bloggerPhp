const [red, green, blue] = [242, 254, 255];
const header = document.querySelector("header");

window.addEventListener("scroll", () => {
  const y = 1 + (window.scrollY || window.pageYOffset) / 200;
  const [r, g, b] = [red / y, green / y, blue / y].map(Math.ceil);
  header.style.boxShadow = `0 0px 4px rgb(${r}, ${g}, ${b})`;
});

const textareas = document.querySelectorAll("#expandable-textarea");
const postBtnWrappers = document.querySelectorAll("#postBtnWrapper");

textareas.forEach((textarea, index) => {
  textarea.addEventListener("input", () => {
    if (textarea.scrollHeight <= 70) {
      textarea.style.height = "20px";
      textarea.style.height = textarea.scrollHeight + "px";
    } else {
      textarea.style.height = "70px";
    }

    const postBtnWrapper = postBtnWrappers[index];
    if (textarea.value) {
      postBtnWrapper.style.color = "#eb253f";
      postBtnWrapper.style.background = "#f4f4f5";
    } else {
      postBtnWrapper.style.color = "#4fe3b7c4";
      postBtnWrapper.style.background = "none";
    }
  });
});

function revealDropdown() {
  // Get the dropdown element
  var dropdown = document.querySelector(".profileDropdown");

  // Toggle the "display" style of the dropdown element
  if (dropdown.style.display === "block") {
    dropdown.style.display = "none";
  } else {
    dropdown.style.display = "block";
  }
}

// Add a click event listener to the document
document.addEventListener("click", function (event) {
  // Get the dropdown element
  var dropdown = document.querySelector(".profileDropdown");

  // Check if the target of the click event is not the dropdown or a descendant of the dropdown
  if (!event.target.closest(".profile")) {
    // If the target is not the dropdown or a descendant of the dropdown, hide the dropdown
    dropdown.style.display = "none";
  }
});

function revealCategoryDropdown() {
  // Get the dropdown element
  var dropdown = document.querySelector(".categoryDropdown");

  // Get the icon element
  var icon = document.querySelector(".chevronDownIcon");

  // Toggle the "show" class on the dropdown element
  dropdown.classList.toggle("show");

  // Toggle the "bi-chevron-down" and "bi-chevron-up" classes on the icon element
  icon.classList.toggle("bi-chevron-down");
  icon.classList.toggle("bi-chevron-up");
}

// Get the modal element
var modal = document.querySelector(".modal");

// Get the form element
var form = document.querySelector("#savePostData");

// Add an event listener for the submit event
form.addEventListener("submit", function (event) {
  console.log("Submit event triggered");
  // Get all the input fields
  var inputs = form.querySelectorAll("input, select, textarea");

  // Loop through the input fields
  for (var i = 0; i < inputs.length; i++) {
    // Get the current input field
    var input = inputs[i];
    // Check if the input field has a validation error
    if (input.classList.contains("error")) {
      // Prevent the form from submitting
      event.preventDefault();

      // Return to exit the loop
      return;
    }
  }
});

// Add an event listener for the click event on the modal
modal.addEventListener("click", function (event) { // For post form
  // Get all the input fields
  var inputs = form.querySelectorAll("input, select, textarea");

  // Loop through the input fields
  for (var i = 0; i < inputs.length; i++) {
    // Get the current input field
    var input = inputs[i];
    // Check if the input field has a validation error
    if (input.classList.contains("error")) {
      // Prevent the modal from closing
      event.stopPropagation();

      // Return to exit the loop
      return;
    }
  }
});

// Add an event listener for the click event on the close button
var closeButton = modal.querySelector(".btn-close");
closeButton.addEventListener("click", function (event) {
  // Get all the input fields
  var inputs = form.querySelectorAll("input, select, textarea");

  // Loop through the input fields
  for (var i = 0; i < inputs.length; i++) {
    // Get the current input field
    var input = inputs[i];
    // Check if the input field has a validation error
    if (input.classList.contains("error")) {
      // Prevent the modal from closing
      event.stopPropagation();

      // Return to exit the loop
      return;
    }
  }
}); // end of POST FORM

var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

