<tr>
    <td>
        @if(isset($payment['name']))
        {{ ucwords($payment['name']) }}
        @else
        <p class="alert alert-danger">Tienes que tener <strong>name</strong> key in your config</p>
        @endif
    </td>
    <td>
        @if(isset($payment['description']))
        {{ $payment['description'] }}
        @endif
    </td>
    @if ($billingAddress)
    <td>
        <form action="{{ route('bank-transfer.index') }}">
            <input type="hidden" class="billingAddress" name="billingAddress" value=" {{$billingAddress->id}}">
            <input type="hidden" class="rate" name="rate" value="">
            <input type="hidden" name="shipment_obj_id" value="{{ $shipment_object_id }}">
            <button type="submit" class="btn btn-warning pull-right">Pay with {{ ucwords($payment['name']) }} <i
                    class="fa fa-bank"></i></button>
        </form>
    </td>
    <td>
        <form action="{{ route('bank-transfer.index') }}">
            <input type="hidden" class="billingAddress" name="billingAddress" value=" {{$billingAddress->id}}">
            <input type="hidden" class="rate" name="rate" value="">
            <input type="hidden" name="shipment_obj_id" value="{{ $shipment_object_id }}">
            <button type="submit" class="btn btn-warning pull-right">Pay with {{ ucwords($payment['name']) }} <i
                    class="fa fa-bank"></i></button>
        </form>
    </td>
    @endif
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