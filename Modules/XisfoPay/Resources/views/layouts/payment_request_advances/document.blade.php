<div class="card">
    <div class="card-body">
        <div class="col text-right">
            <a data-toggle="modal" data-target="#filemodal{{ $payment_request_advance->id }}"
                class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Agregar Archivo</a>
        </div>
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
            {{-- <div class="card-columns">
                @foreach($images as $image)
                <div class="card">
                    @include('generals::layouts.admin.files.show_pdf_or_image', ['data'=>
                    $image->src])
                    <div class="card-body text-center">
                        <a onclick="return confirm('¿Estás Seguro?')"
                            href="{{ route('admin.payment.remove.thumb', ['src' => $image->src]) }}"
                            class="col-4 btn btn-danger btn-sm mt-3"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    <a onclick="return confirm('¿Estás Seguro?')"
                        href="{{ route('admin.payment.advance.remove.thumb', ['src' => $image->src]) }}"
                        class="btn btn-danger remove-img btn-sm btn-block">X</a>
                </div>
                @endforeach
            </div> --}}
        </div>
    </div>
    @include('xisfopay::layouts.payment_request_advances.edit_payment_request_advance_file', ['data' =>
    $payment_request_advance])
</div>
