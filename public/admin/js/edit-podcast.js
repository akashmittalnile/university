// Get references to the radio buttons and their labels
const freeRadio = document.getElementById('flexRadioDefault1');
const priceRadio = document.getElementById('flexRadioDefault2');
const freeLabel = document.querySelector('label[for=flexRadioDefault1]');
const priceLabel = document.querySelector('label[for=flexRadioDefault2]');
const purchaseInput = document.getElementById('purchasePrice');
const trialAudioInput = document.getElementById('trialAudioMins');

// Function to disable input fields
function disableInputs() {
  purchaseInput.disabled = true;
  trialAudioInput.disabled = true;
}

// Function to enable input fields
function enableInputs() {
  purchaseInput.disabled = false;
  trialAudioInput.disabled = false;
}

// Initial state: Enable inputs for "Set price" when page loads
enableInputs();
priceLabel.classList.add('bold-label'); // Adding class to set "Set price" label as bold initially

// Add event listeners to radio buttons
freeRadio.addEventListener('change', function() {
  if (this.checked) {
    disableInputs();
    freeLabel.classList.add('bold-label');
    priceLabel.classList.remove('bold-label');
  }
});

priceRadio.addEventListener('change', function() {
  if (this.checked) {
    enableInputs();
    priceLabel.classList.add('bold-label');
    freeLabel.classList.remove('bold-label');
  }
});
