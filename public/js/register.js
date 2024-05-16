document.addEventListener("DOMContentLoaded", function() {
    function validateForm(event) {
        var valid = true;

        // Get form values
        var full_name = document.getElementById("full_name").value;
        var user_name = document.getElementById("user_name").value;
        var birthdate = document.getElementById("birthdate").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("password_confirmation").value;
        var email = document.getElementById("email").value;
        var user_image = document.getElementById("user_image").value;

        // Get error elements
        var full_name_error = document.getElementById("full_name_error");
        var user_name_error = document.getElementById("user_name_error");
        var birthdate_error = document.getElementById("birthdate_error");
        var phone_error = document.getElementById("phone_error");
        var address_error = document.getElementById("address_error");
        var password_error = document.getElementById("password_error");
        var confirm_password_error = document.getElementById("confirm_password_error");
        var email_error = document.getElementById("email_error");
        var user_image_error = document.getElementById("user_image_error");

        // Clear previous errors
        full_name_error.textContent = "";
        user_name_error.textContent = "";
        birthdate_error.textContent = "";
        phone_error.textContent = "";
        address_error.textContent = "";
        password_error.textContent = "";
        confirm_password_error.textContent = "";
        email_error.textContent = "";
        user_image_error.textContent = "";

        // Full Name Validation
        if (full_name.trim() === "") {
            full_name_error.textContent = "Full name is required";
            valid = false;
        }

        // Username Validation
        if (user_name.trim() === "") {
            user_name_error.textContent = "Username is required";
            valid = false;
        }

        // Birthdate Validation
        if (birthdate === "") {
            birthdate_error.textContent = "Birthdate is required";
            valid = false;
        } else {
            var today = new Date();
            var selectedDate = new Date(birthdate);
            var age = today.getFullYear() - selectedDate.getFullYear();
            if (age < 18) {
                birthdate_error.textContent = "You must be at least 18 years old";
                valid = false;
            }
        }

        // Phone Validation
        if (phone.trim() === "") {
            phone_error.textContent = "Phone number is required";
            valid = false;
        } else if (!/^(?:\d{2}([-.])\d{3}\1\d{3}\1\d{3}|\d{11})$/.test(phone.trim())) {
            phone_error.textContent = "Please enter a valid phone number!";
            valid = false;
        }
  


        // Address Validation
        if (address.trim() === "") {
            address_error.textContent = "Address is required";
            valid = false;
        }

        // Password Validation
        if (password.length < 8) {
            password_error.textContent = "Password must be at least 8 characters long";
            valid = false;
        } else if (!/\d/.test(password)) {
            password_error.textContent = "Password must contain at least one digit";
            valid = false;
        } else if (!/[a-zA-Z]/.test(password)) {
            password_error.textContent = "Password must contain at least one letter";
            valid = false;
        } else if (!/[!@#$%^&*]/.test(password)) {
            password_error.textContent = "Password must contain at least one special character";
            valid = false;
        }

        // Confirm Password Validation
        if (confirm_password !== password) {
            confirm_password_error.textContent = "Passwords do not match";
            valid = false;
        }

        // Email Validation
        if (!/^\S+@\S+\.\S+$/.test(email)) {
            email_error.textContent = "Invalid email address";
            valid = false;
        }

        // User Image Validation
        if (user_image.trim() === "") {
            user_image_error.textContent = "User image is required";
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }

        return valid;
    }

    // Attach validateForm function to the form submission event
    document.getElementById("myForm").addEventListener("submit", validateForm);
} );





        function showMessages(messages, color) {
    // Create or retrieve the message container
    let messageContainer = document.getElementById('messageContainer');
    if (!messageContainer) {
        messageContainer = document.createElement('div');
        messageContainer.id = 'messageContainer';
        messageContainer.className = 'modal-dialog';
        messageContainer.setAttribute('role', 'document');
        document.body.insertBefore(messageContainer, document.body.firstChild); // Insert at the top of the body
    }else{
        document.getElementById("messageContainer").style.visibility = "visible";
    }

    // Set the HTML content of the modal
    messageContainer.innerHTML = `
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Actors born on the same day</h5>
            </div>
            <div class='modal-body'>
                <ul>${messages.length ? messages.map(message => `<li style='color:${color}'>${message}</li>`).join('') : `<li style='color:${color}'>No actors were found born on the same day.</li>`}</ul>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' id='toggleMessageBtn'>Hide Message</button>
            </div>
        </div>`;

    // Styling for the message container to appear at the top
    messageContainer.style.position = 'absolute';
    messageContainer.style.top = '0';
    messageContainer.style.left = '0';
    messageContainer.style.width = '100%';
    messageContainer.style.zIndex = '1000'; // High z-index to ensure it appears above other content

    // Event listener for toggle button
    document.getElementById('toggleMessageBtn').addEventListener('click', function() {
        if(document.getElementById("messageContainer").style.visibility === "hidden"){
            document.getElementById("messageContainer").style.visibility = "visible"
        }else{
            document.getElementById("messageContainer").style.visibility = "hidden"
        }
        
        let btnText = document.getElementById("messageContainer").style.visibility == "hidden"? 'Show Message' : 'Hide Message';
        this.textContent = btnText;
    });
}
        function checkBornToday() {
            var birthdate = document.getElementById('birthdate').value;
            if (birthdate) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/actors/born-today?birthdate=' + encodeURIComponent(birthdate), true);
                showMessages(["Please wait..."], "green");
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Assuming the response is a list of actor names
                        if(xhr.responseText.length === 0){
                            
                            showMessages(["No Actors born on this date"], "black");
                        }else{
                            showMessages(xhr.responseText.split(','), "black");
                        }
                        
                        // alert('Actors born on this date: ' + xhr.responseText);
                    } else {
                        alert('Error: ' + xhr.status);
                    }
                };
                xhr.onerror = function() {
                    alert('Request failed');
                };
                xhr.send();
            } else {
                alert("Please enter a birthdate.");
            }
        }
   