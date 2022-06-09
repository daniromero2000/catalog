@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.streamings.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Streamings</h2>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="streaming">Nombre <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                </div>
                                <input type="text" name="streaming" id="streaming" validation-pattern="streaming"
                                    class="form-control" placeholder="Streaming" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="url">URL <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                </div>
                                <input type="text" name="url" id="url" validation-pattern="url"
                                    placeholder="URL" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Logo</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                </div>
                                <input type="file" name="icon" id="icon" validation-pattern="icon"
                                    class="form-control"
                                    onchange="AcceptableFileUpload('form_inputs', '1', '', 'icon')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                <a href="{{ route('admin.streamings.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
