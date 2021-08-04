<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="halfpastfour.am">
    <link rel="icon" href="favicon.ico">

    <title>halfpastfour.am</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <link href="css/material.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-0 shadow-sm text-light">
    <h5 class="my-0 mr-md-auto font-weight-normal">halfpastfour.am</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-light" href="./headers">Check what headers you are sending</a>
    </nav>
    <a class="btn btn-outline-light btn-light" href="https://github.com/halfpastfouram/">
        <span class="fab fa-github"></span>
        Github
    </a>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center text-light">
    <h1 class="display-4">4:30 AM</h1>
    <p class="lead">You know when you're working on a personal project and suddenly it's half past four am?</p>
    <p>It happens to us all far too often.</p>
</div>

<div class="container">
    <footer class="my-md-5 text-light">
        <div class="row">
            <div class="col-12 col-md">
                <small class="d-block mb-3">&copy; 2010-<?= (new DateTime())->format('Y') ?></small>
            </div>
            <div class="col-6 col-md">
                <h5>Cool stuff</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-light" href="./headers">Check what headers you are sending</a></li>
                    <li><a class="text-light" href="https://halfpastfouram.github.io/phpchartjs/">halfpastfouram/phpchartjs</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>My stuff</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a class="text-light" href="https://luka.dog">luka.dog</a>
                    </li>
                    <li>
                        <a class="text-light" href="https://thor.pet">thor.pet</a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a class="text-light" href="https://github.com/halfpastfouram">
                            <span class="fab fa-github"></span>
                            Check me out on Github
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="js/material.min.js"></script>
</body>
</html>