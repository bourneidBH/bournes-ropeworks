<?php
    // Autoloader
    if (file_exists('DIR_VENDOR' . 'autoload.php')) {
        require_once('DIR_VENDOR' . 'autoload.php');
    }

    // $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    // $dotenv->load();
    // $s3_bucket = getenv('S3_BUCKET');
    // $dataSitekey = getenv('data-sitekey');
    // $secret_key = getenv('secretKey');
    $errors = [];
    $missing = [];
    if (isset($_POST['send'])) {
        $expected = ['name', 'email', 'phone', 'request'];
        $required = ['name', 'email', 'request'];
        $to = 'Jim Bourne <info@bournesropeworks.com>';
        $subject = 'Feedback from online form';
        $headers = [];
        $headers[] = 'email';
        $headers[] = 'Content-type: text/plain; charset=utf-8';
        // most hosting servers require $authorized to be set to string -f followed immediately by valid email address on your domain
        $authorized = '-finfo@bournesropeworks.com';
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
    <link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Contact | Bourne's Ropeworks</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <!-- nav -->
    <?php require_once './assets/includes/topnav.php'; ?>
    <!--main-->
    <main class="container full-height">
        <div class="row">
            <div class="col m10 offset-m1 s12">
                <h1 class="center">Contact Us</h1>
                <p class="center">Bourne’s Ropeworks LLC is located in Manitowoc, Wisconsin. We will measure and install in the Sheboygan and Manitowoc, Wisconsin areas or splice to customer supplied dimensions and ship nationwide.</p>
                <p class="center">
                    Phone: <a href="tel:4143804246">414-380-4246</a><br>
                    Email: <a href="mailto:info@bournesropeworks.com">info@bournesropeworks.com</a>
                    Or fill out the form below.
                </p>
            </div>
            <div class="col md 12">
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
                        <label for="phone">Phone (format 012-345-6789):
                            <?php if (isset($errors['phone'])) : ?>
                                <span class="warning">Invalid phone number.</span>
                            <?php endif; ?>

                        </label>
                        <input type="text" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
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
                    <!-- <div class="g-recaptcha" data-sitekey=<?php $dataSitekey ?></div> -->
                    <div class="col s12 center">
                        <button type="submit" name="send" id="send" value="Submit request" class="waves-effect waves-light btn">
                            Submit request
                        </button>
                    </div>
                </div>
                </form>
            </div> 
        </div>

    </main>
    <!-- footer -->
    <?php require_once './assets/includes/footer.php'; ?>
    <!--scripts-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>