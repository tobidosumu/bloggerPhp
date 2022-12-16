const [red, green, blue] = [242, 254, 255]
const header = document.querySelector('header')

window.addEventListener('scroll', () => {
  const y = 1 + (window.scrollY || window.pageYOffset) / 200
  const [r, g, b] = [red/y, green/y, blue/y].map(Math.ceil)
  header.style.boxShadow = `0 0px 4px rgb(${r}, ${g}, ${b})`
})

const textareas = document.querySelectorAll('#expandable-textarea');
const postBtnWrappers = document.querySelectorAll('#postBtnWrapper');

textareas.forEach((textarea, index) => {
  textarea.addEventListener('input', () => {
    if (textarea.scrollHeight <= 70) {
      textarea.style.height = '20px';
      textarea.style.height = textarea.scrollHeight + 'px';
    } else {
      textarea.style.height = '70px';
    }

    const postBtnWrapper = postBtnWrappers[index];
    if (textarea.value) {
      postBtnWrapper.style.color = '#eb253f';
      postBtnWrapper.style.background = '#f4f4f5';
    } else {
      postBtnWrapper.style.color = '#4fe3b7c4';
      postBtnWrapper.style.background = 'none';
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
document.addEventListener("click", function(event) {
  // Get the dropdown element
  var dropdown = document.querySelector(".profileDropdown");

  // Check if the target of the click event is not the dropdown or a descendant of the dropdown
  if (!event.target.closest(".profile")) {
    // If the target is not the dropdown or a descendant of the dropdown, hide the dropdown
    dropdown.style.display = "none";
  }
});