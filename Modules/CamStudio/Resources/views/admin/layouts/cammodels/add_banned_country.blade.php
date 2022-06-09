<div class="modal fade" id="modal-countries" tabindex="-1" role="dialog" aria-labelledby="modal-default"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Elige País a Bloquear</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('admin.banned-countries.store') }}" method="post" class="form"
                enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="px-3">
                        <div class="col-sm-12">
                            <input type="hidden" name="cammodel_id" value="{{$cammodel->id}}">
                            <div id="countries" class="form-group mt-3">
                                <label class="form-control-label" for="country_id">País</label>
                                <div class="input-group">
                                    <select name="country_id" id="country_id" class="form-control" enabled>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col text-right">
                        <button type="submit" class="btn btn-primary btn-sm">Bloquear</button>
                        <button type="button" class="btn btn-link btn-sm ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
