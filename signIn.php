<?php 
    session_start();
    // $cookie_name = "user";
    // $cookie_value = "Bereket Meles";
    // setcookie($cookie_name, $cookie_value,time() + (86400 * 30), "/");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            $email = mysqli_real_escape_string($conn, test_input($_POST["email"]));
            $pass = mysqli_real_escape_string($conn, test_input($_POST["pass"]));

            $result = mysqli_query($conn, "SELECT * FROM demoform where email = '$email' AND pass = '$pass'");

            $row = mysqli_fetch_assoc($result);

            if (is_array($row) && !empty($row)) {
                $_SESSION['valid'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['age'] = $row['age'];
                $_SESSION['id'] = $row['id'];
                header("Location: Welcome.php");
            } else {
                echo  "<div class = 'Emessage'>
                            <p>Wrong Username or Password<p>
                            <a href = 'signIn.php'><button class='Ebtn'>Go Back</button>
                        </div> <br>";
            }
            
            $_SESSION["cName"] = "admin";
            $_SESSION["cValue"] = $_SESSION['name'];
        
        } 
        else {
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <header>Sign In</header>
        <div class="inputs">
            <label for="name">Email</label>
            <input type="email" name="email" autocomplete="off" id="email" required>
        </div>
        <div class="inputs">
            <label for="pass">Password</label>
            <input type="password" name="pass" autocomplete="off" id="pass" required>
        </div>
        <div class="field">
            <input type="submit" value="Login" class="btn" name="submit">
        </div>
        <div class="links">
            No account? <a href="demo.php">Register</a>
        </div>

        <?php
            // if(!isset($_COOKIE[$cookie_name])) {
            //     echo "Cookie named '" . $cookie_name . "' is not set!";
            // } else {
            //     echo "Cookie '" . $cookie_name . "' is set!<br>";
            //     echo "Value is: " . $_COOKIE[$cookie_name];
            // }
        ?>
    </form>

    <?php }?>
</body>
</html>