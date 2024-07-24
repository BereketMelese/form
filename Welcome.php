<?php
    session_start();

    include("db.php");

    if (!isset($_SESSION['valid'])) {
        header("Location: signIn.php");
    }
    $namee = $_SESSION["cName"];
    $valuee = $_SESSION["cValue"];
    setcookie($namee, $valuee, time() + (86400 * 30), "/");
    // setcookie($namee, $valuee, time() - 3600);
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
        $email = $_SESSION['valid'];
        $query = mysqli_query($conn, "Select * FROM demoform WHERE email = '$email'");
    
        while ($result = mysqli_fetch_assoc($query)) {
            $Name = $result['name'];
            $age = $result['age'];
            $id = $result['id'];
            $U_email = $result['email'];
        }
        
    ?>

    <div class="bx">
        <div class="h"><h1>HOME</h1></div>
        <div class="box">
            <p>Hello <b class="one"><?php echo $Name;?></b>, WELCOME!</p>
            <p>and, you are <b class="three"><sup><?php echo $age." ";?></sup></b>years old</p>
            <p>Your'e id is <b class="four"><sub><?php echo $id?></sub></b>.</p>
        </div>
        <a href="logout.php"><button class="btns">Log Out</button></a>
        <?php
            echo "<br/>";
            if(!isset($_COOKIE[$namee])) {
                echo "Cookie named '" .$namee. "' is not set !";
            } else {
                echo "Cookie '" . $namee . "' is set!<br>";
                echo "Value is: " . $_COOKIE[$namee];
            }
        ?>
    </div>
</body>
</html>