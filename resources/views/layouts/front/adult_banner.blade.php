@extends('layouts.front.app')
@section('content')
<div class="container-fluid text-center">
    <div class="adultbanner card bg-dark text-white mx-auto">
        <img class="card-img" src="https://picsum.photos/750/900/" alt="Disclaimer background">
        <div style="background-color: rgba(0, 0, 0, 0.7);" class="card-img-overlay text-center">
            <div class="block2">
                <h2 class="card-title">Lefemme Cams</h2>
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
                    operation, functionality, social integration, performance &amp; analytics. By clicking “ENTER"
                    you consent to our cookies. <a class="text-warning" href="/cookies-policy">More
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
</div>
@endsection
