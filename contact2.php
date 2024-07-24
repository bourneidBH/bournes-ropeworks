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
                <p class="center">Bourne’s Ropeworks LLC is located in West Allis, Wisconsin, west of Milwaukee. We will measure and install in the southeast Wisconsin area or splice to customer supplied dimensions and ship nationwide.</p>
                <p class="center">
                    Phone: <a href="tel:4143804246">414-380-4246</a><br>
                    Email: <a href="mailto:info@bournesropeworks.com">info@bournesropeworks.com</a>
                    Or fill out the form below.
                </p>
            </div>
            <div class="col md 12">

                <!--contact form-->
                <form method="post" action="email.php">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">phone</i>
                        <label for="phone">Phone (format 012-345-6789):</label>
                        <input type="text" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea name="request" id="request" class="materialize-textarea">
                        </textarea>
                        <label for="request">Request:</label>
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