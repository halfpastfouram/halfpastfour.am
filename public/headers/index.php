<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="What headers are you sending?">
    <meta name="author" content="halfpastfour.am">
    <link rel="icon" href="../favicon.ico">

    <title>What headers are you sending ? - halfpastfour.am</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <link href="../css/material.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 shadow-sm text-light">
    <h5 class="my-0 mr-md-auto font-weight-normal">halfpastfour.am / headers</h5>
    <a class="btn btn-outline-light btn-light" href="../">
        &larr;
        Go back
    </a>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center text-light">
    <h1 class="display-4">What are your request headers?</h1>
    <p class="lead">
        We've detected that you're sending us the headers listed below. Try this from any browser on your desktop,
        laptop
        or phone.<br />
    </p>
    <p>View this output in <a href="./json">JSON</a> or <a href="./xml">XML</a> format.</p>
</div>

<pre>
<?php
$headers = getallheaders();
?>
</pre>

<div class="container text-light">
    <div class="card-deck mb-3">
        <table class="table table-striped table-hover table-borderless shadow-lg">
            <thead class="text-center">
            <tr>
                <th width="30%">Header</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($headers as $header => $value) { ?>
                <tr>
                    <td><?= $header ?></td>
                    <td><?= $value ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="container">
    <footer class="my-md-5 text-light">
        <div class="row">
            <div class="col-12 col-md">
                <small class="d-block mb-3">&copy; 2010-<?= (new DateTime())->format('Y') ?></small>
            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-light" href="./json">JSON format</a></li>
                    <li><a class="text-light" href="./xml">XML format</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a class="text-light" href="https://www.w3.org/Protocols/rfc2616/rfc2616-sec5.html">HTTP/1.1</a>
                    </li>
                    <li>
                        <a class="text-light" href="https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers">HTTP
                            Headers
                        </a>
                    </li>
                    <li>
                        <a class="text-light" href="https://en.wikipedia.org/wiki/List_of_HTTP_header_fields">List of
                            HTTP Header fields
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li>
                        <a class="text-light" href="../">
                            <span class="fa fa-clock"></span>
                            halfpastfour.am
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
<script src="../js/material.min.js"></script>
</body>
</html>