
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector("form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting the default way

        var form = event.target;
        var formData = new FormData(form);  // Create a FormData object to handle the form data

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "register.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    alert("Registration successful!");
                } else {
                    alert("Error: " + xhr.statusText);
                }
            }
        };

        xhr.send(formData);  // Send the form data to the server
    });
});
