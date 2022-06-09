<tr>
    <td>
        @if(isset($payment['name']))
        {{ ucwords($payment['name']) }}
        @else
        <p class="alert alert-danger">You need to have <strong>name</strong> key in your config</p>
        @endif
    </td>
    <td>
        @if(isset($payment['description']))
        {{ $payment['description'] }}
        @endif
    </td>
    <td>
        <form action="{{ route('checkout.store') }}" method="post" class="pull-right" id="payPalForm">
            @csrf
            <input type="hidden" name="payment" value="{{ config('paypal.name') }}">
            <input type="hidden" class="billingAddress" name="billingAddress" value="">
            <input type="hidden" class="delivery_address_id" name="delivery_address" value="">
            <input type="hidden" class="courier" name="courier" value="">
            <button onclick="return confirm('¿Estás Seguro?')" type="submit" class="btn btn-success pull-right">Pay with
                {{ ucwords($payment['name']) }} <i class="fa fa-paypal"></i></button>
        </form>
    </td>
</tr>
<script type="text/javascript">
    $(document).ready(function () {
        let billingAddressId = $('input[name="billingAddress"]:checked').val();
        $('.billingAddress').val(billingAddressId);

        $('input[name="billingAddress"]').on('change', function () {
          billingAddressId = $('input[name="billingAddress"]:checked').val();
          $('.billingAddress').val(billingAddressId);
        });

        let courierRadioBtn = $('input[name="rate"]');
        courierRadioBtn.click(function () {
            $('.rate').val($(this).val())
        });
    });
</script>
