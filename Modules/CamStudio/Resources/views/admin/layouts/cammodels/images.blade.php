<div class="col-xl-5 order-xl-2">
    <div class="row">
        <div class="px-2 col-md-12 col-xl-12">
            @include('camstudio::admin.layouts.generals')
        </div>
        <div class="px-2 col-md-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 text-right">
                            <div class="" style="position: relative;">
                                <a class="btn rounded-pill bg-primary btn-sm text-white" data-toggle="modal"
                                    data-target="#modal-cover" style="position: absolute;top: 3px;right: -4px;">
                                    <i class="fas fa-pen m-auto"></i> Editar foto perfil
                                </a>
                                <img style="border-radius: 1rem; max-height: 450px;"
                                    src="{{ asset("storage/$cammodel->cover") }}" class="img-fluid mx-auto">
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <div class="" style="position: relative;">
                                <a class="btn bg-primary text-white btn-sm rounded-pill" data-toggle="modal"
                                    data-target="#modal-tkn" style="position: absolute;top: 3px;right: -4px;">
                                    <i class="fas fa-pen m-auto"></i> Editar foto agradecimiento
                                </a>
                                <img style="border-radius: 1rem; max-height: 450px;"
                                    src="{{ asset("storage/$cammodel->image_tks") }}" class="img-fluid mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="px-2 col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <span class="form-control-label ml-3">Imagenes </span>
                    <a class="btn bg-primary text-white btn-sm rounded-pill" data-toggle="modal"
                        data-target="#modal-img" style="position: absolute;top: 10px;right: 10px;">
                        <i class="fas fa-pen m-auto"></i> Agregar imagenes
                    </a>
                    @if ($images->isNotEmpty())
                    <div class="slideshow-container mt-3">
                        @foreach ($images as $image)
                        <div class="mySlides text-center">
                            <div class="numbertext"></div>
                            <img src="{{ asset("storage/$image->src") }}" style="max-height: 450px; max-width:100%;">
                            <div class="text d-flex justify-content-center">
                                <a onclick="return confirm('¿Estás Seguro?')"
                                    href="{{ route('admin.cammodels.remove.thumb', ['src' => $image->src]) }}"
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('camstudio::admin.layouts.cammodels.edit_banner_image')
@include('camstudio::admin.layouts.cammodels.edit_profile_image')
@include('camstudio::admin.layouts.cammodels.edit_tkn_image')
@include('camstudio::admin.layouts.cammodels.add_images')
