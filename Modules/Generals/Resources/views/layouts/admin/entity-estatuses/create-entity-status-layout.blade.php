@include('generals::layouts.errors-and-messages')
<div class="card">
    <form action="{{ route($optionsRoutes .'.store') }}" method="post" class="form">
        <div class="card-body">
            @csrf
            <div class="col pl-0 mb-3">
                <h2>Crear Estado</h2>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-control-label" for="name">Nombre</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-font"></i></span>
                            </div>
                            <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                                class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-control-label" for="color">color</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-palette"></i></span>
                            </div>
                            <input type="color" name="color" id="color" placeholder="Color"
                                class="form-control jscolor my-colorpicker1 colorpicker-element"
                                value="{{ old('color') }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary btn-sm">Crear</button>
            <a href="{{ route($optionsRoutes . '.index') }}" class="btn btn-default btn-sm">Regresar</a>
        </div>
    </form>
</div>
