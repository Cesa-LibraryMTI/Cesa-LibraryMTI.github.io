
        // Get all elements with class 'submitForm' and add an event listener to each
        var submitForms = document.getElementsByClassName('submitForm');
        for (var i = 0; i < submitForms.length; i++) {
            submitForms[i].addEventListener('click', function (event) {
                event.preventDefault(); // prevent the default action of the anchor tag

                // Find the closest form element and submit it
                this.closest('.myForm').submit();
            });
        }
  
