<div class="tab-content" id="tabcontent">
    <div role="tabpanel" class="tab-pane @if(!request()->has('combination')) active @endif"
        id="info">
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" class="form"
            enctype="multipart/form-data" id="form_{{$product->id}}">
            @csrf
            <input type="hidden" name="_method" value="put">
            <div class="row">
                <div class="col-md-7 col-lg-6">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label class="form-control-label" for="sku">SKU</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i
                                                class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="sku" id="sku" placeholder="xxxxx"
                                        class="form-control" value="{!! $product->sku !!}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="form-control-label" for="quantity">Cantidad</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i
                                                class="fa fa-hashtag"></i></span>
                                    </div>
                                    @if($productAttributes->isEmpty())
                                    <input type="text" name="quantity" id="quantity"
                                        placeholder="Cantidad" class="form-control"
                                        value="{!! $product->quantity  !!}">
                                    @else
                                    <input type="hidden" name="quantity" value="{{ $qty }}">

                                    <input type="text" value="{{ $qty }}" class="form-control"
                                        disabled>
                                    @endif
                                    @if(!$productAttributes->isEmpty())<a
                                        class="text-center info-tooltip" data-toggle="tooltip"
                                        data-original-title="La cantidad está deshabilitada. La cantidad total es calculada por la suma de todas las combinaciones">
                                        ? </a> @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i
                                                class="fa fa-font"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" placeholder="Nombre"
                                        class="form-control" value="{!! $product->name !!}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="price">Precio Normal</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i
                                                class="fa fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" name="price" id="price"
                                        placeholder="Precio Normal" class="form-control"
                                        value="{!! $product->price !!}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="sale_price">Precio
                                    Oferta</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i
                                                class="fa fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" name="sale_price" id="sale_price"
                                        placeholder="Precio Oferta" class="form-control"
                                        value="{{ $product->sale_price }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label">Categorías</label>
                                @include('ecommerce::admin.shared.categories', ['categories' =>
                                $categories->where('is_active',1),
                                'ids' => $product])
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label">Grupos</label>
                                @include('ecommerce::admin.shared.product_groups', ['product_groups'
                                =>
                                $product_groups,
                                'ids' => $product])
                            </div>
                        </div>
                        <div class="col-sm-6">
                            @if(!$brands->isEmpty())
                            <div class="form-group">
                                <label class="form-control-label" for="brand_id">Marca</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i
                                                class="fa fa-copyright"></i></span>
                                    </div>
                                    <select name="brand_id" id="brand_id"
                                        class="form-control select2">
                                        <option value=""></option>
                                        @foreach($brands as $brand)
                                        <option @if($brand->id == $product->brand_id)
                                            selected="selected" @endif
                                            value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                @include('ecommerce::admin.shared.status-select', ['status' =>
                                $product->is_active])
                            </div>
                        </div>
                        <div class="col-12">
                            @include('ecommerce::admin.shared.attribute-select',
                            [compact('default_weight')])
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="description">Descripción</label>
                                <textarea class="form-control ckeditor" name="description"
                                    id="description" rows="5"
                                    placeholder="Descripción">{!! $product->description  !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-6">
                    <div class="form-group">
                        <label class="form-control-label" for="cover">Cover</label>
                        <div class="row">
                            <img src="{{ $product->cover }}" alt="{{$product->slug}}"
                                style="max-height: 170px; margin: 0px auto;">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-image"></i></span>
                            </div>
                            <input type="file" name="cover" id="cover" class="form-control"
                                accept="image/*"
                                onchange="AcceptableFileUpload('form_{{$product->id}}', '1', '')">
                        </div>
                    </div>
                    @if ($images->isNotEmpty())
                    <div class="slideshow-container mt-3">
                        @foreach ($images as $image)
                        <div class="mySlides text-center">
                            <div class="numbertext"></div>
                            <img src="{{ asset("storage/$image->src") }}"
                                style="max-height: 450px; max-width:100%;">
                            <div class="text d-flex justify-content-center">
                                <a onclick="return confirm('¿Estás Seguro?')"
                                    href="{{ route('admin.product.remove.thumb', ['src' => $image->src]) }}"
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
                    <div class="relative">
                        <div class="form-group">
                            <label class="form-control-label" for="image">Imagenes</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i
                                            class="fa fa-image"></i></span>
                                </div>
                                <input type="file" name="image[]" id="image" class="form-control"
                                    multiple accept="image/*"
                                    onchange="AcceptableFileUpload('form_{{$product->id}}', '1', '')">
                            </div>
                            <a class="text-center info-tooltip" data-toggle="tooltip"
                                data-original-title="Puedes usar (cmd o ctrl) para seleccionar
                                multiples
                                imagenes">
                                ! </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" ml-auto pb-0">
                    <a href="{{ route('admin.product.duplicate', ['id' => $product->id]) }}"
                        class="btn btn-default btn-sm">Duplicar</a>
                    <a href="{{ route('admin.products.index') }}"
                        class="btn btn-default btn-sm">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm"
                        id="create_button_">Actualizar</button>
                </div>
        </form>
    </div>
</div>