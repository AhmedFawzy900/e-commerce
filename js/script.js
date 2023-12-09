// Get all input fields within their respective father divs
const inputFields = document.querySelectorAll('.form-field input');

// Loop through each input field and add event listeners
inputFields.forEach(function(inputField) {
  const fatherDiv = inputField.closest('.form-field');

  inputField.addEventListener('focus', function() {
    fatherDiv.style.borderColor = '#03A9F4';
  });

  inputField.addEventListener('blur', function() {
    fatherDiv.style.borderColor = '#888';
  });
});

// swiper
$(document).ready(function() {
  $('#myCarousel').carousel({
    interval: 5000
  });
});