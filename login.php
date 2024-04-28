<?php
$gmail = null;
$pass = null;
$login = true;
if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_POST["email"])) {
    require "dbconnect.php";
    $gmail = $_POST["name_email"];
    $pass = $_POST["password"];
    $sql = "SELECT * FROM `login_page` WHERE gmail = '$gmail'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pass_hash = $row['password'];
            $pass_verify = password_verify($pass, $pass_hash);
            if ($pass_verify == true) {
                $login = true;
                session_start();
                $_SESSION['login'] = $login;
                $_SESSION['gmail'] = $gmail;
                header("location: index.php");
            }
        }
    } else {
        $sql = "SELECT * FROM `login_page` WHERE username = '$gmail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                $pass_hash = $row['password'];
                $pass_verify = password_verify($pass, $pass_hash);
                if ($pass_verify == true) {
                    $login = true;
                    session_start();
                    $_SESSION['login'] = $login;
                    $_SESSION['gmail'] = $gmail;
                    header("location: index.php");
                }
                else{
                    $login=false;
                }
            }
        }
        else{
            $login=false;
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
    <title>Login</title>
</head>

<body style="background: linear-gradient(90deg, rgba(22,35,53,1) 0%, rgba(57,79,103,1) 100%)">
    <header>
        <ul>
            <li><a href="./signup.php">Signup</a></li>
            <li><a style="border: 2px solid #d5defb;" href="./login.php">login</a></li>
        </ul>
    </header>
    <section>
        <?php
        if ($login == false) {
            echo '<div id="main-prompt">
            <div id="prompt">
                <p>
                    <b>Error!</b>Invalid Credentials
                </p>
                <button onclick="display_prompt()">&times; </button>
            </div>
        </div>';
        }
        ?>
        <div id="login_form">
            <form method="post" action="./login.php">
                <div>
                    <p>Log in to Your Account</p>
                </div>
                <div>
                    <label for="email">Username or Email</label>
                    <input type="text" name="name_email" id="name_email" autocomplete="off" placeholder="Enter Your Username or Email.."
                        value="<?php echo $gmail ?>" required>
                </div>
                <div id="showhidediv">
                    <label for="login_password">Password</label>
                    <input type="password" name="password" id="login_password" autocomplete="off"
                        placeholder="Enter Your Password.." value="<?php echo $pass ?>" required>
                    <span id="showhide" onclick="showhide_pass()"><img
                            src="./images/6351969_eye_key_look_password_security_icon.svg" width="20px"></span>
                </div>
                <div>
                    <input type="submit" name="Login" id="Login" value="Login">
                </div>
            </form>
        </div>
    </section>
    <footer>
        <p>Copyright &#169 2023-2024.All Right Reversed</p>
    </footer>
    <script>
        function display_prompt() {
            document.querySelector("#main-prompt").style = "display:none;"
        }
        function showhide_pass() {
            var pass = document.querySelector("#login_password")
            var eyeicon = document.querySelector("#showhide img")
            if (pass.type == "password") {
                pass.type = "text"
                eyeicon.src = "./images/6351930_eye_password_see_view_icon.svg"
            }
            else {
                pass.type = "password"
                eyeicon.src = "./images/6351969_eye_key_look_password_security_icon.svg"
            }
        }
    </script>

</body>

</html>