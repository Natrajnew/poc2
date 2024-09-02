<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registration Form</div>
    <div class="content">
      <form method="POST" action="controller.php">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name:</span>
            <input type="text" id="firstName" name="firstName" required>
          </div>
          <div class="input-box">
            <span class="details">Middle Name</span>
            <input type="text" id="middleName" name="middleName" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" id="lastName" name="lastName" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" id="email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="number" id="mobile" name="mobile" maxlength="10" required />
          </div>
          <div class="input-box">
            <span class="details">Social Security Number:</span>
            <input type="number" id="socialSecurityNumber" name="socialSecurityNumber" required>
          </div>
          <div class="input-box">
            <span class="details">Birthdate:</span>
            <input type="date" id="birthDate" name="birthDate" required>
          </div>
          <div class="input-box">
            <span class="details">Account Number:</span>
            <input type="text" id="accountNumber" name="accountNumber" required>
          </div>
          <div class="input-box">
            <span class="details">Type:</span>
            <select class="input-box" id="accType" name="accType">
                <option value="Checking">Checking</option>
                <option value="Savings">Savings</option>
                <option value="Loan">Loan</option>
                <option value="CD">CD</option>
                </select>
          </div>
          <div class="input-box">
            <span class="details">Enter Password</span>
            <input type="password" id="newPassword" name="newPassword" required
                   pattern="^(?=.*\d)(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9])\S{8,}$" 
                   title="Password must contain at least one number, 
                           one alphabet, one symbol, and be at 
                           least 8 characters long" required />
          </div>
          <div class="input-box">
            <span class="details">Re-enter password</span>
            <input type="password" id="confirmPassword" name="confirmPassword" required />
          </div>
        </div>
        
        <div class="button">
          <input type="submit" name="register_user" value="Register">
        </div>
        <p>Already have an account?<a href="login.php"> Login</a></p>
      </form>
    </div>
  </div>

</body>
<script>
        document.getElementById('passwordForm').addEventListener('submit', function(event) {
            var password = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault(); // Prevent form submission
            }
        });
        
         
    </script>
</html>