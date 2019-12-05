<?php
    $errors = [];
    $missing = [];
    if (isset($_POST['send'])) {
        $expected = ['name', 'email', 'phone', 'request'];
        $required = ['name', 'email', 'request'];
        $to = 'Jim Bourne <jbourne1@wi.rr.com>';
        $subject = 'Feedback from online form';
        $headers = [];
        $headers[] = 'From: webmaster@bournesropeworks.com';
        $headers[] = 'Content-type: text/plain; charset=utf-8';
        // most hosting servers require $authorized to be set to string -f followed immediately by valid email address on your domain
        $authorized = '-fjbourne1@wi.rr.com';
        require './assets/includes/process_mail.php';
        // if $mailSent = true redirect to thank you page, else display error message
        if ($mailSent) {
            header('Location: thanks.php');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Contact | Bourne's Ropeworks</title>
</head>
<body>
        <!-- nav -->
        <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="#" class="brand-logo"><img src="assets/images/BournesRopeworks_logo-reverse.png" alt="Bourne's Ropeworks" height="80px"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="index.html#services">Services</a></li>
                    <li><a href="index.html#marine">Marine</a></li>
                    <li><a href="index.html#industrial">Industrial</a></li>
                    <li><a href="index.html#architectural">Architectural</a></li>
                    <li><a href="index.html#about">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </nav>
        <ul class="sidenav" id="mobile-demo">
            <li><a href="index.html#services">Services</a></li>
            <li><a href="index.html#marine">Marine</a></li>
            <li><a href="index.html#industrial">Industrial</a></li>
            <li><a href="index.html#architectural">Architectural</a></li>
            <li><a href="index.html#about">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </div>
    <!--main-->
    <main class="container">
        <h1 class="center">Contact Us</h1>
        <?php if ($_POST && ($suspect || (isset($errors['mailfail'])) ) ) : ?>
        <p class="warning">Sorry, your mail couldn't be sent.</p>
        <?php elseif ($errors || $missing) : ?>
        <p class="warning">Please fix the item(s) indicated.</p>
        <?php endif; ?>

        <!--contact form-->
        <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <label for="name">Name:
                <?php if ($missing && in_array('name', $missing)) : ?>
                    <span class="warning">Please enter your name.</span>
                <?php endif; ?>
                </label>
                <input type="text" name="name" id="name"
                    <?php
                    if ($errors || $missing) {
                        echo 'value="' . htmlentities($name) . '"';
                    }
                    ?>
                >
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">phone</i>
                <label for="phone">Phone:
                    <?php if (isset($errors['phone'])) : ?>
                        <span class="warning">Invalid phone number.</span>
                    <?php endif; ?>

                </label>
                <input type="text" name="name" id="name"
                    <?php
                    if ($errors) {
                        echo 'value="' . htmlentities($phone) . '"';
                    }
                    ?>
                >
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <label for="email">Email:
                    <?php if ($missing && in_array('email', $missing)) : ?>
                        <span class="warning">Please enter your email address.</span>
                    <?php elseif (isset($errors['email'])) : ?>
                        <span class="warning">Invalid email address.</span>
                    <?php endif; ?>
                </label>
                <input type="email" name="email" id="email"
                    <?php
                    if ($errors || $missing) {
                        echo 'value="' . htmlentities($email) . '"';
                    }
                    ?>
                >
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">mode_edit</i>
                <textarea name="request" id="request" class="materialize-textarea"><?php
                    if ($errors || $missing) {
                        echo htmlentities($request);
                    }
                    ?>
                </textarea>
                <label for="request">Request:
                    <?php if ($missing && in_array('request', $missing)) : ?>
                        <span class="warning">Please enter details about your request.</span>
                    <?php endif; ?>
                </label>
            </div>
            <div class="col s12 center">
                <button type="submit" name="send" id="send" value="Submit request" class="waves-effect waves-light btn">
                    Submit request
                </button>
            </div>
        </div>
        </form>

    </main>
    <!--scripts-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/app.js"></script>

</body>