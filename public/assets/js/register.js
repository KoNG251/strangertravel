document.addEventListener('DOMContentLoaded', function () {
  const inputElement = document.getElementById('citizenID');

  inputElement.addEventListener('input', function (event) {
    let inputValue = event.target.value;

    // Remove non-alphanumeric characters
    inputValue = inputValue.replace(/[^A-Za-z0-9]/g, '');

    // Enforce the pattern
    inputValue = inputValue.replace(/(\w{1})(\w{4})(\w{5})(\w{2})(\w{1})/, '$1-$2-$3-$4-$5');

    // Set the formatted value back to the input
    event.target.value = inputValue;
  });
});