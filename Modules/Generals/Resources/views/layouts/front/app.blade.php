<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Meta Card -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }}</title>

  @yield('og')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/front/app.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/front/whatsapp.min.css')}}">
  @yield('styles')

</head>

<body>

  @include('layouts.front.header')
  @yield('content')
  <div id="WAButton" style="z-index: 99999;"></div>
  {{-- @include('layouts.front.footer') --}}

</body>
<script src="{{ asset('js/front/jquery.min.js') }}"></script>
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/front/front.js') }}"></script>
<script src="{{ asset('modules/ecommerce/front/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('css/front/webslidemenu.js.descarga')}}"></script>
<script type="text/javascript" src="{{ asset('js/front/whatsapp.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/front/lazyLoad/app.min.js') }}"></script>
<script src="{{ asset('js/front/sweetalert2.js') }}"></script>
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
  $(document).ready(function () {
            $("a[data-theme]").click(function () {
              $("head link#theme").attr("href", $(this).data("theme"));
              $(this).toggleClass('active').siblings().removeClass('active');
            });
            $("a[data-effect]").click(function () {
              $("head link#effect").attr("href", $(this).data("effect"));
              $(this).toggleClass('active').siblings().removeClass('active');
            });
          });
</script>
@include('layouts.front.footer')

</html>