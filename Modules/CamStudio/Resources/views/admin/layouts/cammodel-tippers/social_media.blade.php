<div class="card-body pt-0 px-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="col">
                        <span class="h4">
                            Redes Sociales {{ $cammodelTipper->profile }}
                        </span>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary btn-sm text-white" data-toggle="modal"
                            data-target="#addSocialAccountModal">
                            <span>
                                Agregar Red Social
                            </span>
                        </button>
                    </div>
                </div>
                @if ($cammodelTipper->CammodelTipperSocialMedia->isNotEmpty())
                <div class="table text-center">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Perfil</th>
                                <th>Red Social</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($cammodelTipper->CammodelTipperSocialMedia as $socialAccount)    
                                <td>{{ $socialAccount->profile }}</td>
                                <td>{{ $socialAccount->socialMedia->social }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                    <span class="text-sm m-3">No se han agregado redes sociales para el tipper</span>
                @endif
            </div>
        </div>
    </div>
</div>