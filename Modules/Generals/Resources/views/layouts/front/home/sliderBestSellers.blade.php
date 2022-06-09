@if ($bestSellers->isNotEmpty())
<div>
    @include('ecommerce::front.products.layouts.cards.card_product_option_one',['title' => 'LOS MAS VENDIDOS',
    'background'=>'carrousel-reset-home'])
</div>
@endif