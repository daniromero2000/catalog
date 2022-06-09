<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail notification - XisfoPay</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style type="text/css">
        table {
            border-collapse: collapse;
        }

        .card {
            margin-bottom: 30px;
            border: 0;
        }

        header {
            background-color: #fff;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }

        .text-center {
            text-align: center !important;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .justify-content-between {
            -ms-flex-pack: justify !important;
            justify-content: space-between !important;
        }

        .row {
            display: -ms-flexbox !important;
            display: flex !important;
            -ms-flex-wrap: wrap !important;
            flex-wrap: wrap !important;
            margin-right: -15px !important;
            margin-left: -15px !important;
         
        }

        .mb-2,
        .my-2 {
            margin-bottom: .5rem !important;
        }

        @media (min-width: 768px) {
            .col-md-4 {
                -ms-flex: 0 0 33.333333% !important;
                flex: 0 0 33.333333% !important;
                max-width: 33.333333% !important;
            }

            .col-md-5 {
                -ms-flex: 0 0 41.666667% !important;
                flex: 0 0 41.666667% !important;
                max-width: 41.666667% !important;
            }

            .justify-content-md-between {
                -ms-flex-pack: justify !important;
                justify-content: space-between !important;
            }

            .col-md-6 {
                -ms-flex: 0 0 50% !important;
                flex: 0 0 50% !important;
                max-width: 50% !important;
            }
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }

        .mt-5,
        .my-5 {
            margin-top: 3rem !important;
        }

        @media (min-width: 992px) {
            .col-lg-3 {
                -ms-flex: 0 0 25% !important;
                flex: 0 0 25% !important;
                max-width: 25% !important;
            }

            .col-lg-4 {
                -ms-flex: 0 0 33.333333% !important;
                flex: 0 0 33.333333% !important;
                max-width: 33.333333% !important;
            }
        }

        .card-body {
            flex: 1 1 auto !important;
            padding: 1em !important;
        }

        .col-12 {
            -ms-flex: 0 0 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            width: 100%;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        table {
            border-collapse: collapse;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .mb-1,
        .my-1 {
            margin-bottom: .25rem !important;
        }

        .h6,
        h6 {
            font-size: 1rem;
        }

        .d-block {
            display: block !important;
        }

        .small,
        small {
            font-size: 80%;
            font-weight: 400;
        }

        .text-left {
            text-align: left !important;
        }

        .mt-3,
        .my-3 {
            margin-top: 1rem !important;
        }

        .card .card-footer,
        .card .card-header {
            background-color: #fff;
        }

        .text-right {
            text-align: right !important;
        }

        .card .card-footer,
        .card .card-header {
            background-color: #fff;
        }

        .ml-auto,
        .mx-auto {
            margin-left: auto !important;
        }

        .card-footer:last-child {
            border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px);
        }

        .card-footer {
            padding: .75rem 1.25rem;
            background-color: rgba(0, 0, 0, .03);
            border-top: 1px solid rgba(0, 0, 0, .125);
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.5rem;
        }

        .bg-default {
            background-color: #222753 !important;
            color: white;
        }

        .table thead th {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .80rem;
            letter-spacing: 1px;
            border-bottom: .0625rem solid #dee2e6;
        }

        .text-muted {
            color: #8898aa !important;
        }

        .table td,
        .table th,
        .table td p {
            font-size: .8125rem;
            white-space: nowrap;
        }

        .table th {
            font-weight: 600;
        }

        .table td,
        .table th {
            padding: 1rem;
            vertical-align: top;
            border-top: .0625rem solid #dee2e6;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-bottom: .5rem;
            font-family: inherit;
            font-weight: 400;
            line-height: 1.5;
            color: #32325d;
        }

        body {
            margin: 0;
            font-family: Open Sans, sans-serif !important;
            font-size: 1rem !important;
            font-weight: 400;
            line-height: 1.5;
            color: #525f7f;
            text-align: left;
            background-color: #fff;
        }

        @media (min-width: 1200px) {

            .container,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                max-width: 1250px;
            }

        }

        @media (max-width: 575px) {

            .container,
            .container-fluid,
            .container-lg,
            .container-md,
            .container-sm,
            .container-xl {
                padding-right: 8px !important;
                padding-left: 8px !important;
            }


            .col-md-10 {
                padding-right: 0px !important;
                padding-left: 0px !important;
            }
        }

        .ml-auto,
        .mx-auto {
            margin-left: auto !important;
        }

        @media (min-width: 768px) {
            .col-md-10 {
                -ms-flex: 0 0 83.333333%;
                flex: 0 0 83.333333%;
                max-width: 83.333333%;
            }
        }

        .h3,
        h3 {
            font-size: 1.75rem;
            
        }

        .h4,
        h4 {
            font-size: 1.5rem;
        }

        .h5,
        h5 {
            font-size: 1.25rem;
            margin-top: 0px;
        }

        .h6,
        h6 {
            font-size: 1rem;
            margin-top: 0px;
        }

        .mr-auto,
        .mx-auto {
            margin-right: auto !important;
        }

        .ml-auto {
            margin-left: auto !important;
        }

        .col,
        .col-1,
        .col-10,
        .col-11,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-auto,
        .col-lg,
        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-auto,
        .col-md,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-auto,
        .col-sm,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-auto,
        .col-xl,
        .col-xl-1,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .lead,
        p,
        span {
            font-weight: 300;
            line-height: 1.7;
        }

        p {
            font-size: 1rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }
    
        .blue-dark{
            color: #204699;
        }
        .btn-redirect-dashboard{
            color: white !important;
            background-color: #204699;
            padding: 5px 20px;
            border-radius: 10px;
            text-decoration: none;
        }
        .button-create-account {
            color: #213053;
            font-size: 20px;
            background-color: #ffcd01;
            padding: 10px 50px;
            border-radius: 20px;
        }
        .button-create-account:hover {
            color: #ffcd01;
            font-size: 20px;
            background-color: transparent;
            padding: 10px 50px;
            border-radius: 20px;
            border: solid 1px #ffcd01;
        } 
         .col-2 m-auto{

        }

        .btn-redirect-dashboard:hover{
            color: #204699 !important;
            background-color: #FDCC13;
            padding: 5px 20px;
            border-radius: 10px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-expired-alert{
            background-color: #f5365c;

            color: white;
            padding: 5px 10px;
            border-radius: 20px;
        }
        body {
            -webkit-user-select: none;  /* Chrome all / Safari all */
            -moz-user-select: none;     /* Firefox all */
            -ms-user-select: none;      /* IE 10+ */
            user-select: none;          /* Likely future */
            font-family: 'Montserrat', sans-serif;
        }
        .img-header-mailing{
            width: 100% !important;
        }
        .cordial-text{
            color: gray; 
            line-height: 0px;
        }
        .w-logo-footer{
            width: 200px;
        }
        .bg-footer{
            background-color: #204699;
        }
        .invitation-socials{
            font-size: 20px; 
            color: white;
        }
        .decoration-none{
            text-decoration: none;
        }
        .w-icons-socials{
            width: 35px;
        }
        .text-no-request{
            font-size: 13px;
            color:white;
        }
        .mail-to-indicators{
            text-decoration: none;
            color:white !important;
            font-size:15px;
            font-weight: 300;
        }
        .mail-to-indicators:hover{
            text-decoration: none;
            color:#F7DE29 !important;
            font-size:15px;
            font-weight: 300;
            transition: 0.2s;
        }
        .bg-text-politics{
            background-color: #F7F7F7;
            padding: 20px 0px;
            border-radius: 0px 0px 20px 20px;
            text-align: center;
        }
        .text-cordial{
            font-size: 20px;
            color:black;
        }
        .description-mail{
            font-size: .90rem;
            color:black;
        }
        .row-reset{
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding-right: 0 !important;
            padding-left: 0 !important;
        }
        .w-100{
            width: 100% !important;
        }
    </style>
    @yield('styles-mail')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body class="w-100">
    <div class="card-header text-center">
        @include('xisfopay::emails.admin.layouts.header-mail')
    </div>
    <div class="card-body text-center">
        <div class="mx-auto mt-2">
                @yield('content')
        </div>
            
    </div>
    <div class="card-footer">
        @include('xisfopay::emails.admin.layouts.footer-mail')
    </div>
</body>
</html>