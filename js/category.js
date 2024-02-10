function showInputBox() {
    var dropdown = document.getElementById('myDropdown');
    var selectedOption = dropdown.options[dropdown.selectedIndex].value;

    // Check if the selected option requires displaying the input box
    if (selectedOption === 'other') {
      document.getElementById('inputBoxContainer').style.display = 'table-row';
      document.getElementById('inputBox').disabled = false;
      
    } else {
      document.getElementById('inputBoxContainer').style.display = 'none';
      document.getElementById('inputBox').disabled = true;
    }
}