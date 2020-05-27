<?php

require_once 'connection.php';
require_once 'utilities.php';
$salt = 'XyZzy12*_';

if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (strlen($_POST['email']) > 0 && strlen($_POST['pass']) > 0) {
        if (strpos('@', $_POST['email']) != -1) {
            $check = hash('md5', $salt . $_POST['pass']);
            $sql = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
            $sql->execute(array(
                ":email" => $_POST['email'],
                ":password" => $check
            ));
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            if ($row == false) {
                $_SESSION['error'] = "Incorrect password";
                header("Location: login.php");
                return;
            } else {

                $_SESSION['name'] = $row['email'];
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['success'] = "Logged In";
                header("Location: index.php");
                return;
            }

        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="css/icons-font.css">
    <link rel="stylesheet" href="css/credentialstyle.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png">

    <title>Natraj Naveen Ch</title>
</head>
<body>
<div class="navigation">
    <input type="checkbox" class="navigation__checkbox" id="navi-toggle">
    <label for="navi-toggle" class="navigation__button">
            <span class="navigation__icon">
                &nbsp;
            </span>
    </label>
    <div class="navigation__background">&nbsp;
    </div>
    <nav class="navigation__nav">
        <ul class="navigation__list">
            <li class="navigation__item">
                <a href="#" class="navigation__link">
                    <span>01</span>About Natours</a>
            </li>
            <li class="navigation__item">
                <a href="#" class="navigation__link">
                    <span>02</span>Popular tours</a>
            </li>
            <li class="navigation__item">
                <a href="#" class="navigation__link">
                    <span>03</span>Your benifits</a>
            </li>
            <li class="navigation__item">
                <a href="#" class="navigation__link">
                    <span>04</span>stories</a>
            </li>
            <li class="navigation__item">
                <a href="#" class="navigation__link">
                    <span>05</span>Book now</a>
            </li>
        </ul>
    </nav>
</div>
<main>
    <section class="section-book">
        <div class="row">
            <div class="book">
                <div class="book__form">
                    <form action="#" class="form">
                        <div class="u-margin-bottom-medium">
                            <h2 class="heading-secondary">
                                Login Credentials
                            </h2>
                        </div>
                        <div class="form__group">
                            <input id="email" type="email" class="form__input" placeholder="Email address" required>
                            <label for="email" class="form__label">Email address</label>
                        </div>
                        <div class="form__group">
                            <input id="password" type="password" class="form__input" placeholder="Your password"
                                   required>
                            <label for="password" class="form__label">Password</label>
                        </div>
                        <div class="form__group u-margin-bottom-medium">
                            <div class="form__radio-group">
                                <input type="radio" id="small" name="size" class="form__radio-input">
                                <label for="small" class="form__radio-label">
                                        <span class="form__radio-button">
                                        </span>
                                    Keep me Signed in
                                </label>
                            </div>

                        </div>
                        <div class="form__group">
                            <input type="submit" class="btn btn--green" value="Sign in">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>