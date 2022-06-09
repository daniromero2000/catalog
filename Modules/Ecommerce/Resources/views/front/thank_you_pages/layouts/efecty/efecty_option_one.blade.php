@extends('layouts.front.thank_you_page')
@section('tags')
<script>
  window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','UA-175178939-1',{'page_title':'home','page_path':"/than-you-page/efecty"});
</script>
@endsection
@section('content')

<div class="container d-flex mt-4">
  <div class="ml-auto">
    <h3 class="orden">ORDEN N°: FVNO-{{$order}}</h3>
  </div>
</div>

<div class="container mt-3">
  <p class="text-center text-orden">
    <span> Hola {{request()->customer}},</span>
    <br>
    <span><b>Gracias por comprar en FVN online</b></span>
    <br>
    <span>
      Tu pedido ha sido creado con el número FVN-{{$order}} exitosamente en nuestro sistema de información.
    </span>
    <br>
    <span>Nuestra promesa de entrega es de 3 a 7 días hábiles contados a partir del dia hábil después de realizar
      la consignación a la cuenta <b>No° 42.138.544</b> a nombre de <b>Juliana Jaramillo</b> por un valor de <span
        class="total"><b> ${{ number_format($total, 0)}}</b>.</span>
  </p>

  <hr class="mt-4" style="border-top: 2px solid rgb(0 46 84 / 69%);">
</div>

@endsection