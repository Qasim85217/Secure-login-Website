<?php
require 'dbconnect.php';
$username = null;
$gmail = null;
$password = null;
$cpassword = null;
$exist = false;
$existerror = '';
$signup = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST["signup_gmail"])) {
    $username = $_POST["signup_username"];
    $gmail = $_POST["signup_gmail"];
    $password = $_POST["signup_password"];
    $cpassword = $_POST["signup_cpassword"];
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $signup = false;
    $existSql = "SELECT * FROM `login_page` WHERE gmail = '$gmail'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        $exist = true;
        $existerror = 'Gmail Already exists';
    } else {
        $existSql = "SELECT * FROM `login_page` WHERE username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            $exist = true;
            $existerror = 'Username Already exists';
        } elseif ($password != $cpassword) {
            $exist = true;
            $existerror = "Password do not match";
        } else {

            $sql = "INSERT INTO `login_page` (`username`, `gmail`, `password`) VALUES ('$username', '$gmail', '$hash_pass');";
            $result = mysqli_query($conn, $sql);
            $signup = true;
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Signup</title>
</head>

<body style="background: linear-gradient(90deg, rgba(22,35,53,1) 0%, rgba(57,79,103,1) 100%)">
    <header>
        <ul>
            <li><a style="border: 2px solid #d5defb;" href="./signup.php">Signup</a></li>
            <li><a href="./login.php">login</a></li>
        </ul>
    </header>

    <section>
        <?php
        if ($exist == true) {
            echo '<div id="main-prompt">
            <div id="prompt">
                <p>
                    <b>Error!</b>' . $existerror . '.Please try again.
                </p>
                <button onclick="display_prompt()">&times; </button>
            </div>
        </div>';
        }
        if ($signup == true) {
            echo '<div id="main-prompt">
            <div style="background-color: #22bb33;" id="prompt">
                <p>
                    Your account has created succesfully.
                </p>
                <button onclick="display_prompt()">&times; </button>
            </div>
        </div>';
        }
        ?>

        <div id="signup_form">
            <form action="./signup.php" method="post" autocomplete="off">
                <div>
                    <p style="margin:1px auto;">Sign Up for a New Account</p>
                </div>
                <div>
                    <label for="signup_username">Username</label>
                    <input type="text" name="signup_username" id="signup_username" maxlength="64" autocomplete="off"
                        placeholder="Enter Your Username.." value="<?php echo $username ?>" required>
                </div>
                <div>
                    <label for="signup_gmail">Gmail</label>
                    <input type="gmail" name="signup_gmail" id="signup_gmail" maxlength="64" autocomplete="off"
                        placeholder="Enter Your Gmail.." value="<?php echo $gmail ?>" required>
                </div>
                <div>
                    <label for="signup_password">Password</label>
                    <input type="password" name="signup_password" id="signup_password" maxlength="18" autocomplete="off"
                        placeholder="Enter Your Password.." value="<?php echo $password ?>" required>
                </div>
                <div>
                    <label for="signup_cpassword">Confirm Password</label>
                    <input type="password" name="signup_cpassword" id="signup_cpassword" maxlength="18"
                        placeholder="Confirm Your Password.." autocomplete="off" value="<?php echo $cpassword ?>"
                        required>
                </div>
                <div>
                    <p id="error_show" style="color: red;"></p>
                    <p>By clicking signup I agree to your terms</p>
                </div>
                <div>
                    <input type="submit" name="Signup" id="Signup" value="Signup">
                </div>
            </form>
        </div>
    </section>
    <footer>
        <p>Copyright &#169 2023-2024.All Right Reversed</p>
    </footer>
</body>
<script>
    function display_prompt() {
        document.querySelector("#main-prompt").style = "display:none;"
    }
</script>


</html>