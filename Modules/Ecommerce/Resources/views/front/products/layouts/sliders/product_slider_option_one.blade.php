<div class="p-2 d-flex">
    <div class="horVerSlider" data-desktop="600" data-tabportrait="600" data-tablandscape="600" data-mobilelarge="375"
        data-mobilelandscape="500" data-mobileportrait="375">
        <div class="close"></div>
        <div class="vertical-wrapper">
            <div id="vertical-slider">
                <ul>
                    <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                        <img class="img-fluid lazy" src="{{ asset("storage/$product->cover") }}"
                            alt="{{$product->slug}}" style=" border-radius: 6px; "></li>
                    @if(isset($images) && !$images->isEmpty())
                    @foreach($images as $image)
                    <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                        <img class="img-fluid lazy" src="{{ asset("storage/$image->src") }}"
                            alt="{{$product->slug}}" style=" border-radius: 6px; "></li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="horizon-wrapper ">
            <div class="horizone-nav">
                <div class="prev" style="display: none;">
                    <div>
                        <i class="fas fa-chevron-left"></i>
                    </div>
                </div>
                <div class="next" style="display: block;">
                    <div>
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </div>
            </div>
            <div id="horizon-slider">
                <ul>
                    <li class="ui-draggable bg-white zoom-img">
                        <img class="img-fluid zoom lazy" src="{{ asset("storage/$product->cover") }}"
                            alt="{{$product->slug}}" style=" border-radius: 15px; "></li>
                    @if(isset($images) && !$images->isEmpty())
                    @foreach($images as $image)
                    <li class="ui-draggable ui-draggable-handle ui-draggable-disabled bg-white zoom-img">
                        <img class="img-fluid zoom lazy" src="{{ asset("storage/$image->src") }}"
                            alt="{{$product->slug}}" style=" border-radius: 15px; "></li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 text-center">
    <p>Pasa el mouse encima de la imagen para aplicar zoom</p>
</div>
