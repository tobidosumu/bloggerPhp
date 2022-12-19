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

// Get the slider container and the images
const slider = document.querySelector('.topBloggersSlider');
const images = Array.from(topBloggersSlider.children);

// Set the starting index to 0 (first image)
let currentIndex = 0;

// Add a click event listener to the left arrow button
document.querySelector('#left-arrow').addEventListener('click', function() {
  // Decrement the current index
  currentIndex--;

  // If the current index is negative, set it to the last image
  if (currentIndex < 0) {
    currentIndex = images.length - 1;
  }

  // Slide the images to the left
  slideImages();
});

// Add a click event listener to the right arrow button
document.querySelector('#right-arrow').addEventListener('click', function() {
  // Increment the current index
  currentIndex++;

  // If the current index is greater than the number of images, set it to the first image
  if (currentIndex > images.length - 1) {
    currentIndex = 0;
  }

  // Slide the images to the right
  slideImages();
});

function slideImages() {
  // Set the left position of the images based on the current index
  images.forEach((image, index) => {
    image.style.left = `${index - currentIndex}00%`;
  });
}

