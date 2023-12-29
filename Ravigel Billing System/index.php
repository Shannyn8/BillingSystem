<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="signIn()">Sign In</button>
                <button type="button" class="toggle-btn" onclick="signUp()">Sign Up</button>
            </div>
            <form action="signInProcess.php" id="signInForm" class="input-group" method="post"
                onsubmit="return validateSignIn()">
                <input type="text" name="signInUsername" class="input-field" placeholder="Enter Username" required>
                <input type="password" name="signInPassword" class="input-field" placeholder="Enter Password"
                    required>
                <button type="submit" class="submit-btn">Log In</button>
                <a href="forgot-pass.php" style="color: #ff4500 !important; text-decoration: none; font-size: 14px; margin-top: 10px; display: inline-block;">Forgot Password</a>

            </form>
            <form action="signUpProcess.php" id="signUpForm" class="input-group" method="post"
                onsubmit="return validateSignUp()">
                <input type="text" name="signUpUsername" class="input-field" placeholder="Enter Username" required>
                <input type="password" name="signUpPassword" class="input-field" placeholder="Enter Password"
                    required>
                <input type="password" name="confirmPassword" class="input-field" placeholder="Confirm Password"
                    required>
                <input type="text" name="signUpFirstName" class="input-field" placeholder="Enter First Name"
                    required>
                <input type="text" name="signUpLastName" class="input-field" placeholder="Enter Last Name"
                    required>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="male" name="signUpGender" value="M">
                        <label for="male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="female" name="signUpGender" value="F">
                        <label for="female">Female</label>
                    </div>
                </div>
                <input type="text" name="signUpPhone" class="input-field" placeholder="Enter Phone Number"
                 onkeypress="validatePhoneNumber(event)">
                <input type="email" name="signUpEmail" class="input-field" placeholder="Enter Email" required>
                <button type="submit" class="submit-btn">Sign Up</button>
                <div id="errorMessages"></div>
            </form>
        </div>
    </div>
    <script>
    function signIn() {
        document.getElementById("signInForm").style.left = "50px";
        document.getElementById("signUpForm").style.left = "450px";
        document.getElementById("btn").style.left = "0px";
    }

    function signUp() {
        document.getElementById("signInForm").style.left = "-400px";
        document.getElementById("signUpForm").style.left = "50px";
        document.getElementById("btn").style.left = "110px";
    }

    function validateSignIn() {
    var signInUsername = document.forms["signInForm"]["signInUsername"].value;
    var signInPassword = document.forms["signInForm"]["signInPassword"].value;
    var validUsername = $username; 
    var validPassword = $password; 

    if (signInUsername !== validUsername) {
        alert("Invalid username or password");
        return false;
    }

    if (signInPassword !== validPassword) {
        alert("Invalid username or password");
        return false;
    }

    return true;
}


    function validatePhoneNumber(event) {
        var inputChar = String.fromCharCode(event.charCode);
        if (!/^\d+$/.test(inputChar)) {
            event.preventDefault();
            var phoneNumber = event.target.value + inputChar;
            if (phoneNumber.length > 11) {
                event.preventDefault();
            }
        }
    }

    function validateSignUp() {
    var signUpEmail = document.forms["signUpForm"]["signUpEmail"].value;
    var signUpPhone = document.forms["signUpForm"]["signUpPhone"].value;
    var signUpPassword = document.forms["signUpForm"]["signUpPassword"].value;
    var confirmPassword = document.forms["signUpForm"]["confirmPassword"].value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var phoneRegex = /^\d+$/;
    var errorMessages = "";

    if (!emailRegex.test(signUpEmail)) {
        errorMessages += "Invalid email format\n";
        alert("Invalid email format");
    }

    if (!phoneRegex.test(signUpPhone) || signUpPhone.length !== 11) {
        errorMessages += "Invalid phone number format (must be 11 digits)\n";
        alert("Invalid phone number format (must be 11 digits)");
    }

    if (signUpPassword.length < 8) {
        errorMessages += "Password should be at least 8 characters long\n";
        alert("Password should be at least 8 characters long");
    }

    if (signUpPassword !== confirmPassword) {
        errorMessages += "Passwords do not match\n";
        alert("Passwords do not match");
    }

    if (containsScript(signUpPassword)) {
        errorMessages += "Invalid characters in the password\n";
        alert("Invalid characters in the password");
    }

    if (errorMessages !== "") {
        return false;
    }

    return true;
}

function containsScript(input) {
    var scriptRegex = /<\s*script[^>]*>|<\/\s*script\s*>|javascript:/gi;
    return scriptRegex.test(input);
}


</script>


</body>

</html>
