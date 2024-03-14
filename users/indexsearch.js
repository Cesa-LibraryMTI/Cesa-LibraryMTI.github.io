function searchDivs() {
    var input, filter, divs, div, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    divs = document.getElementsByClassName("myDiv"); // Assuming divs have class "myDiv"
  
    for (i = 0; i < divs.length; i++) {
      div = divs[i];
      txtValue = div.textContent || div.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        div.style.display = ""; // Display the div if it matches the search
      } else {
        div.style.display = "none"; // Hide the div if it doesn't match the search
      }
    }
  }
  