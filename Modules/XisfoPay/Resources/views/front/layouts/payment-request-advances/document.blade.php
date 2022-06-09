<div class="card">
    <div class="card-body">
        <div class="px-sm-5 px-3 pb-5">
            <div class="slideshow-container mt-3">
                @foreach ($images as $image)
                <div class="mySlides text-center">
                    <div class="numbertext"></div>
                    @include('generals::layouts.admin.files.show_pdf_or_image', ['data'=>
                    $image->src])
                    <div class="text d-flex justify-content-center">
                        <a onclick="return confirm('¿Estás Seguro?')"
                            href="{{ route('admin.payment.advance.remove.thumb', ['src' => $image->src]) }}"
                            class="btn btn-danger btn-sm"><i class="fas fa-trash"> </i></a>
                    </div>
                </div>
                @endforeach
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>
            <div style="text-align:center">
                @foreach ($images as $key => $image)
                <span class="dot" onclick="currentSlide({{$key+1}})"></span>
                @endforeach
            </div>
        </div>
    </div>
    @include('xisfopay::layouts.payment_request_advances.edit_payment_request_advance_file', ['data' =>
    $payment_request_advance])
</div>
