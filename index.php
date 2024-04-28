<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Welcome page</title>
</head>

<body>
    <header>
        <ul>
            <li><a style="border: 2px solid #d5defb;" href="./">Home</a></li>
            <li><a>Logout</a></li>
        </ul>
    </header>
    <main>
        <section id="home_section">
            <div id="main_logout_modal">
                <div id="logout_modal">
                    <p>Are You Sure for logout?</p>
                    <div>
                        <button>Yes</button>
                        <button>No</button>
                    </div>
                </div>
            </div>
            <h2>Welcome</h2>
            <p>Welcome to our website! Here, we offer a user-friendly platform designed to provide you with seamless
                access
                to our services. Whether you're here to explore our features, sign up for an account, or simply learn
                more
                about what we offer, you're in the right place.</p>

            <p>At our core, we believe in simplicity and efficiency. Our PHP-based login system ensures that your
                interactions with our website are secure and hassle-free. With just a few clicks, you can create an
                account,
                log in securely, and access all the features our platform has to offer.</p>

            <p>Feel free to navigate through our pages, explore our services, and experience the convenience of our
                platform
                firsthand. If you have any questions or need assistance, our support team is always ready to help. Thank
                you
                for choosing us as your online destination!</p>
        </section>
        <section id="about_section">
            <h2>About the Website</h2>
            <p>Here, we'd like to take a moment to introduce ourselves and
                provide
                you with some insight into who we are and what we stand for.</p>

            <p>Our journey began with a simple idea: to create a user-centric platform that prioritizes security,
                efficiency,
                and convenience. With a team of dedicated professionals and a passion for innovation, we set out to
                build a
                PHP-based login system that would revolutionize the way users interact with online platforms.</p>

            <p>Today, we are proud to offer a comprehensive solution that not only streamlines the login process but
                also
                ensures the safety and security of our users' data. Our commitment to excellence drives us to
                continually
                improve and enhance our platform, ensuring that our users always have access to the latest features and
                technologies.</p>

            <p>But our journey doesn't stop here. We are constantly evolving, adapting to the ever-changing needs of our
                users
                and the digital landscape. As we continue to grow, our mission remains the same: to provide you with a
                seamless
                and secure online experience that empowers you to achieve your goals.</p>

            <p>Thank you for your support and trust in our platform. We look forward to serving you and exceeding your
                expectations every step of the way.</p>
        </section>
    </main>
    <footer>
        <p>Copyright &#169 2023-2024.All Right Reversed</p>
    </footer>
    <script>
        var logout_button = document.querySelector("header ul").children[1].children[0];
        console.log(logout_button)
        logout_button.addEventListener('click', function () {
            document.querySelector("#main_logout_modal").style.display = "flex";
            var welcome_button = document.querySelector("header ul").children[0].children[0];
            logout_button.style="border: 2px solid #d5defb;"
            welcome_button.style="border: 1px solid #14ebff45;"
        });

        var logout_nobutton = document.querySelector('#logout_modal').children[1].children[1];
        logout_nobutton.addEventListener('click', function () {
            document.querySelector("#main_logout_modal").style.display = "none";
            var welcome_button = document.querySelector("header ul").children[0].children[0];
            logout_button.style="border: 1px solid #14ebff45;"
            welcome_button.style="border: 2px solid #d5defb;"
        });
        var logout_yesbutton = document.querySelector('#logout_modal').children[1].children[0];
        logout_yesbutton.addEventListener('click', function () {
            window.location.href="logout.php"
        });

    </script>
</body>

</html>