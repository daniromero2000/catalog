<div class="card">
    <div class="card-body">
        <div class="col text-right">
            <a data-toggle="modal" data-target="#filemodal{{ $payment_request->id }}"
                class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Agregar Archivo</a>
        </div>
        @if ($images->isNotEmpty())
        <div class="slideshow-container mt-3">
            @foreach ($images as $image)
            <div class="mySlides text-center">
                <div class="numbertext"></div>
                @include('generals::layouts.admin.files.show_pdf_or_image', ['data'=>
                $image->src])
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
        @else
        <span>No hay documentos</span>
        @endif
    </div>
    @include('xisfopay::layouts.payment_requests.edit_payment_request_file', ['data' =>
    $payment_request])
</div>
