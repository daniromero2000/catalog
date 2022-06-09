@if(isset($payment['name']))
@if($payment['name'] == config('stripe.name'))
@include('ecommerce::front.payments.stripe')
@elseif($payment['name'] == config('paypal.name'))
@include('ecommerce::front.payments.paypal')
@elseif($payment['name'] == config('bank-transfer.name'))
@include('ecommerce::front.payments.bank-transfer')
@elseif($payment['name'] == config('payu.name'))
@include('ecommerce::front.payments.payu')
@endif
@endif