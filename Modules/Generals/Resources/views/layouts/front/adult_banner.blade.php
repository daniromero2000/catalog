<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="RATING" content="RTA-5042-1996-1400-1577-RTA" />
    <link rel="icon" href="/favicon.ico">

    <title>We need you to verify you accept our policies</title>

    <!-- merged CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <style type="text/css">
        @media (min-width: 750px) {
            .card-text {
                margin-right: 8rem !important;
                margin-left: 8rem !important;
            }
        }

        @media (min-width: 768px) {
            .container-fluid {
                max-width: 974px;
            }

            small {
                font-size: 100%;
            }

        }

        @media (max-width: 576px) {

            .container-fluid {
                padding-left: 0;
                padding-right: 0;
            }

            body {
                font-size: 14px;
            }

            .adultbanner .adultlogo {
                max-width: 80%;
            }

            .btn-lg,
            .btn-group-lg>.btn {
                font-size: 0.8rem;
            }

            .adultbanner p {
                font-size: 10px;
            }

            .adultbanner h2 {
                font-size: 16px;
            }

            .block1 {
                display: none;
            }

            .block2 {}

            .block3 {
                margin-bottom: 1.0rem !important;
                margin-top: 1.0rem !important;

            }
        }

        @media (min-width: 576px) {
            .block1 {
                margin-bottom: 1.5rem !important;
                margin-top: 1.5rem !important;
            }

            .block2 {}

            .block3 {
                margin-bottom: 1.5rem !important;
                margin-top: 1.5rem !important;

            }

        }


        @media (max-width: 375px) {
            .menulogo {
                max-width: 200px;
            }
        }

        @media (min-width: 376px) {
            .menulogo {
                max-width: 280px;
            }
        }
    </style>



</head>

<body class="adultcheck">
    <div class="container-fluid text-center">
        <div class="adultbanner card bg-dark text-white mx-auto">
            <img class="card-img" src="https://picsum.photos/750/900/" alt="Disclaimer background">
            <div style="background-color: rgba(0, 0, 0, 0.7);" class="card-img-overlay text-center">
                <div class="block1">
                    <img class="card-text adultlogo img-responsive" src="https://picsum.photos/400/90/" alt="Logo">
                </div>
                <div class="block2">
                    <h2 class="card-title">The Webcam Shop</h2>
                </div>
                <div class="block3">
                    <a class="card-text btn btn-warning  btn-lg" style="white-space: normal;color:black"
                        href="{{ Modules\Generals\Entities\AgeProtectionBanner\AgeProtectionBanner::generate_accept_link($request)}}"><strong>ENTER
                        </strong></a>
                    <p class="card-text mt-1"><small>I disagree - <a class="text-warning"
                                onclick="window.location.replace('http://www.google.com');"
                                href="http://www.google.com">Exit</a></small></p>
                </div>

                <p class="card-text text-justify"><small>Cookie Notice: This website uses cookies for necessary
                        operation, functionality, social integration, performance &amp; analytics. By clicking “ENTER" you consent to our cookies. <a class="text-warning" href="/cookies-policy">More
                            information</a>.</small></p>
                <p class="card-text text-justify"><small>This site contains sexually oriented adult material intended
                        for individuals <strong>18 years of age</strong> or older. If you are not yet 18, if adult
                        material offends you, or if you are accessing this site from any country or location where adult
                        material is prohibited by law, please don't continue.</small></p>

                <p class="card-text text-justify"><small>By clicking on the "Enter" button, and by entering this website
                        you agree with all the above and certify under penalty of perjury that you are an adult.</small>
            </div>
        </div>
        <hr>
</body>

</html>
