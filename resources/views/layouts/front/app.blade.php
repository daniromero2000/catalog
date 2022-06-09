<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta Card -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Feels Very Nice, fabrica y diseña calzado infantil que promueve el sano desarrollo de los pies de los niños, estimulando
el sistema motor. Compra en Linea 100% seguro, Somos la tienda de calzado mas innovadora de Colombia.">
    <meta name="tags"
        content="zapatos niños, zapatos niñas, zapatos ortopédicos para niños, zapatos fisiológicos, moda para niños, moda para niñas, sandalias para niña, sandalias para niño, sandalias minnie, sandalias frozen, zapatos de frozen para niña, zapatos cars para niño, zapatos Batman niño, sandalia Batman niño, zapatos Disney niña, calzado infantil Disney, calzado infantil fisiológico, calzado fisiológico dama, calzado para desarrollo de niños, moda para niños y niñas, zapatos infantiles Colombia, calzado infantil en Colombia, moda para niños Colombia, calzado para bebes, sandalias para bebés, zapatos para bebés, calzado ideal para bebés, tienda de zapatos para niños y niñas, tienda en línea de calzado infantil.">
    <meta name="subject" content="Feels Very Nice">
    <meta name="copyright" content="Feels Very Nice">
    <meta name="language" content="ES">
    <meta name="classification" content="Shoes Business">
    <meta name="keywords"
        content="zapatos niños, zapatos niñas, zapatos ortopédicos para niños, zapatos fisiológicos, moda para niños, moda para niñas, sandalias para niña, sandalias para niño, sandalias minnie, sandalias frozen, zapatos de frozen para niña, zapatos cars para niño, zapatos Batman niño, sandalia Batman niño, zapatos Disney niña, calzado infantil Disney, calzado infantil fisiológico, calzado fisiológico dama, calzado para desarrollo de niños, moda para niños y niñas, zapatos infantiles Colombia, calzado infantil en Colombia, moda para niños Colombia, calzado para bebes, sandalias para bebés, zapatos para bebés, calzado ideal para bebés, tienda de zapatos para niños y niñas, tienda en línea de calzado infantil.">
    <meta name="author" content="Feels Very Nice">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="Calzado Infantil Feels Very Nice">
    <meta name="twitter:creator" content="https://fvn.com.co/" />
    <meta name="twitter:site" content="https://fvn.com.co/" />
    <meta name="twitter:title" content="Calzado Infantil Feels Very Nice" />
    <meta name="twitter:description"
        content="Feels Very Nice, fabrica y diseña calzado infantil que promueve el sano desarrollo de los pies de los niños, estimulando el sistema motor. Compra en Linea 100% seguro, Somos la tienda de calzado mas innovadora de Colombia." />
    <meta name="twitter:image" content="{{asset('img/FVN/logo.png')}}" />
    <meta name="facebook-domain-verification" content="zve45y2pjpoiazhgdd95pwu8y7gqd8" />

    @section('og')
    <meta property="og:type" content="product" />
    <meta property="og:title" content="Feels Very Nice" />
    <meta property="og:description" content="Feels Very Nice, fabrica y diseña calzado infantil que promueve el sano desarrollo de los pies de los niños, estimulando
el sistema motor. Compra en Linea 100% seguro, Somos la tienda de calzado mas innovadora de Colombia." />
    @endsection

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '3294466514002555');
fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=3294466514002555&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175178939-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-175178939-1');
    </script>

    <!-- Global site tag (gtag.js) - Google Ads: 604881959 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-604881959"></script>
    <script>
        window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-604881959');
    </script>

    @yield('tags')

    <script type="application/ld+json">
        {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "Xisfo Pay Services",
      "url": "https://fvn.com.co/",
      "address": "",
      "sameAs": [
      "https://www.linkedin.com/company/xisfopay",
      "https://www.facebook.com/xisfopayservices",
      "https://www.instagram.com/xisfopay/"
      ]
  }
    </script>
    @yield('og')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://www.fvn.com.co/" rel="canonical" />
    <link rel="icon" href="{{asset('img/FVN/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/front/app.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/front/whatsapp.min.css')}}">
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    @yield('styles')
</head>

<body>

    <!-- Global site tag (gtag) - Google Ads: 604881959 -->
    <amp-analytics type="gtag" data-credentials="include">
        <script type="application/json">
            { "vars": { "gtag_id": "AW-604881959", "config": { "AW-604881959": { "groups": "default" } } }, "triggers": { } }
        </script>
    </amp-analytics>
    @include('layouts.front.header')
    @yield('content')
    <div id="WAButton" style="z-index: 99999;"></div>
    @include('layouts.front.footer')
    <script type="text/javascript">
        //<![CDATA[
      var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
      document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
    //]]>
    </script>
    <script language="JavaScript" type="text/javascript">
        TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_md_167x42.png", "POSDV", "none");
    </script>
</body>
<script src="{{ asset('js/front/jquery.min.js') }}"></script>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/front/sweetalert2.js') }}"></script>
<script src="{{ asset('js/front/front.js') }}"></script>
<script src="{{ asset('modules/ecommerce/front/js/app.js') }}"></script>
{{-- <script src="{{ asset('js/front/jquery.lazy.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('js/front/whatsapp.min.js') }}"></script>
<script src="{{ asset('js/admin/validate.js') }}"></script>
@yield('scripts')
<script type="text/javascript">
    $(function() {
    $('#WAButton').floatingWhatsApp({
        phone: '573117192436', //WhatsApp Business phone number
        headerTitle: 'Chatea con nosotros por WhatsApp !', //Popup Title
        popupMessage: 'Hola, como podemos ayudarte?', //Popup Message
        showPopup: true, //Enables popup display
        buttonImage: '<img src="{{ asset('img/logos/whatsapp.svg')}}" alt="logo whatsapp" />', //Button Image
        // headerColor: 'crimson', //Custom header color
        //backgroundColor: 'crimson', //Custom background button color
        position: "right" //Position: left | right

    });
});
</script>
<script type="text/javascript">
    !function(window){
  var $q = function(q, res){
        if (document.querySelectorAll) {
          res = document.querySelectorAll(q);
        } else {
          var d=document
            , a=d.styleSheets[0] || d.createStyleSheet();
          a.addRule(q,'f:b');
          for(var l=d.all,b=0,c=[],f=l.length;b<f;b++)
            l[b].currentStyle.f && c.push(l[b]);

          a.removeRule(0);
          res = c;
        }
        return res;
      }
    , addEventListener = function(evt, fn){
        window.addEventListener
          ? this.addEventListener(evt, fn, false)
          : (window.attachEvent)
            ? this.attachEvent('on' + evt, fn)
            : this['on' + evt] = fn;
      }
    , _has = function(obj, key) {
        return Object.prototype.hasOwnProperty.call(obj, key);
      }
    ;


  function loadImage (el, fn) {
    var img = new Image()
      , src = el.getAttribute('src');
    img.onload = function() {
      if (!! el.parent)
        el.parent.replaceChild(img, el)
      else
        el.src = src;
        fn? fn() : null;
    }
    img.src = src;
  }

  function elementInViewport(el) {
    var rect = el.getBoundingClientRect()

    return (
       rect.top    >= 0
    && rect.left   >= 0
    && rect.top <= (window.innerHeight || document.documentElement.clientHeight)
    )
  }

    var images = new Array()
      , query = $q('img.lazy')
      , processScroll = function(){
          for (var i = 0; i < images.length; i++) {
            if (elementInViewport(images[i])) {
              loadImage(images[i], function () {
                images.splice(i, i);
              });
            }
          };
        }
      ;
    // Array.prototype.slice.call is not callable under our lovely IE8
    for (var i = 0; i < query.length; i++) {
      images.push(query[i]);
    };

    processScroll();
    addEventListener('scroll',processScroll);

}(this);
</script>
<script>
    window.onload  = function(e){
  $('#sliderHome').show();
}
</script>
<script>
    function reloadUrl(url, type){
    if(type == 1){
      window.location.href = url;
    }else{
      window.open(url);
    }
}
</script>

</html>
