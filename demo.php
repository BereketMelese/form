<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include("db.php");

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if(isset($_POST['submit'])) {

            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $age = test_input($_POST["age"]);
            $pass = test_input($_POST["pass"]);
            $cpass = test_input($_POST["cpass"]);

            if ($_POST["pass"] !== $_POST["cpass"]){
                echo    '<div class="Emessage">
                            <p>The password do not match.</p>
                            <a href = "javascript:self.history.back()"><button class="Ebtn">Go Back</button>
                        </div><br />';
            } else {
                $verify_email = mysqli_query($conn, "SELECT email FROM demoform Where email = '$email'");
                if (mysqli_num_rows($verify_email) != 0) {
                    echo '<div class="Emessage">
                            <p>The email you entered is used, Try another one Please!</p>
                            <a href = "javascript:self.history.back()"><button class="Ebtn">Go Back</button>
                        </div><br />';
                } else {
                    mysqli_query($conn, "INSERT INTO demoform(name, email, age, pass) VALUES('$name', '$email', '$age', '$pass')") or die("Error Occured");
                    echo '<div class="message">
                            <p>Registration succesfull!</p>
                            <a href = "signIn.php"><button class="btn">Login Now</button>
                        </div><br />';
                }
            }
  
        } 
        
        else {
    ?>
    
    <form action="" method="post">
        <header>Register Now</header>
        <div class="inputs">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="inputs">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="inputs">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" required>
        </div>
        <div class="inputs">
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" required>
        </div>
        <div class="inputs">
            <label for="cpass">Confirm Password</label>
            <input type="password" name="cpass" id="cpass" required>
        </div>
        <div class="field">
            <input type="submit" value="Register" class="btn" name="submit">
        </div>
        <div class="links">
            Already a member? <a href="signIn.php">Sign In</a>
        </div>
    </form>

    <?php }?>
</body>
</html>