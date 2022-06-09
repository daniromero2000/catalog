@extends('layouts.front.app') @section('title', 'Gracias') @section('content') <script async
    src="https://www.googletagmanager.com/gtag/js?id=UA-126114100-2"></script>
<script>
    window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','UA-126114100-2',{'page_title':'Item Thank You Page','page_path':'/itemtkspage'});
</script> @include('generals::layouts.errors-and-messages')<div class="container-fluid">
    <div class="row d-flex justify-content-center d-flex align-items-center top-buffer bottom-buffer">
        <div class="col-12 col-xs-12 col-sm-12 col-md-7 col-lg-8 col-xl-8">
            <div id="tkspageitem">
                <h1 class="tkspage-text5 text-center">Estimado/a {{ $pqr->name }}</h1>
            </div>
        </div>
    </div>
</div>
@endsection