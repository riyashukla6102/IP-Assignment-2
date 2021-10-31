<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ip_ass2');


$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$email = $password="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an Email ID.";
    } else{
        $sql = "SELECT id FROM users WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);


            if(mysqli_stmt_execute($stmt)){

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already registered.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

        $password = trim($_POST["password"]);

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password );

            $param_email = $email;
            $param_password=$password;
            if(mysqli_stmt_execute($stmt)){
                header("location: 2a.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="2a.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="navbar">
        <a href="">City Guide <i class="fa fa-plane"></i></a>
        <div class="sub-navbar">
            <a href="">Home <i class="fa fa-home"></i></a>
            <a href="">News <i class="fa fa-newspaper-o"></i></a>
            <a href="">Contact Us <i class="fa fa-phone"></i></a>
            <a href="">Signup/Login <i class="fa fa-sign-in"></i></a>
        </div>
    </div>

    <div class="content-container">
        <div class="signinpage">
            <div class="heading">Sign In/Login <i class="fa fa-sign-in"></i></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="signin" method="post" onsubmit="return validate();">
                <input type="text" name="email" id="email" placeholder="Enter Email" class="contact-item">
                <input type="password" name="password" id="password" placeholder="*******" class="contact-item">
                <button type="submit" class="contact-item">SUBMIT</button>
            </form>
              <p id="form_note" style="text-align: center; font-size: 14px;"><strong style="color: red; font-size: 24px;" >*</strong>Password Must Be At Least 8 Digits Long And Contains One UpperCase, One LowerCase And One Special Character</p>

        </div>

        <div class="image-tour">
            <img src="https://youthincmag.com/wp-content/uploads/2018/09/Travel-And-Tourism-Sector.jpg" alt="">
        </div>
    
    </div>
    
    <script src="2a.js">

    </script>
</body>
</html>