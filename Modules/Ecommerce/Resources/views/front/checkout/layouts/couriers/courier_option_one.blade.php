<div class="w-100">
    <div class="card">
        <div class="card-body">
            <legend><i class="fa fa-truck"></i> Courier</legend>
            <ul class="list-unstyled">
                @foreach($rates as $rate)
                <li class="col-md-4">
                    <label class="radio">
                        <input type="radio" name="rate" data-fee="{{ $rate->amount }}" value="{{ $rate->object_id }}">
                    </label>
                    <img src="{{ $rate->provider_image_75 }}" alt="courier" class="img-thumbnail" />
                    {{ $rate->currency }} {{ $rate->amount }}<br />
                    {{ $rate->servicelevel->name }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>