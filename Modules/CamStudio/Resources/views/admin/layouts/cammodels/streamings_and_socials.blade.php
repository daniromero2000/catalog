<div>
    <div class="btn btn-danger btn-sm mb-2 rounded-pill w-100" id="message" style="display: none;">Mensaje</div>
    <div class="card">
        <div class="card-header font-weight-bold">
            Streamings
        </div>
        <div class="table-responsive">
            <table class="table-striped table text-center">
                <thead>
                    <th>Perfil</th>
                    <th>Usuario</th>
                    <th>Plataforma</th>
                    <th>Contraseña</th>
                </thead>
                <tbody>
                    @foreach ($cammodel->cammodelStreamAccounts as $key => $streamAccount)
                    <tr>
                        <td>{{ $streamAccount->profile }}</td>
                        <td>{{ $streamAccount->user }}</td>
                        <td><a target="_blank"
                                href="https://{{ $streamAccount->streaming->url }}{{ $streamAccount->profile }}">{{ $streamAccount->streaming->streaming }}</a>
                        </td>
                        <td>
                            <input class="text-center border-0 changeType{{ $key }}" type="password" id="changeType"
                                value="password" data-toggle="modal" data-target="#validationModal"
                                onclick="sendKey({{ $key }}); sendPass('{{ $streamAccount->id }}')">
                        </td>
                    </tr>
                    <div class="modal validationPass fade" id="validationModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Validación de Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Ingrese su
                                            Contraseña:</label>
                                        <input type="password" class="form-control" id="verifyPass" name="verifyPass"
                                            onkeypress="validar(event)">
                                        <input type="hidden" value="" name="passStreaming" id="passStreaming">
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        <button type="button" data-dismiss="modal" class="btn btn-primary"
                                            onclick="verifyPassStreaming()">Comprobar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header font-weight-bold">
            Socials
        </div>
        <div class="table-responsive">
            <table class="table-striped table text-center">
                <thead>
                    <th>Perfil</th>
                    <th>Usuario</th>
                    <th>Red Social</th>
                    <th>Contraseña</th>
                </thead>
                <tbody>
                    @foreach ($cammodel->cammodelSocialMedia as $row => $socialAccount)
                    <tr>
                        <td>{{ $socialAccount->profile }}</td>
                        <td>{{ $socialAccount->user }}</td>
                        <td>
                            <a target="_blank"
                                href="https://{{ $socialAccount->socialMedia->url }}/{{ $socialAccount->profile }}"><span><i
                                        class="{{ $socialAccount->socialMedia->icon }}"></i></span></a>
                        </td>
                        <td>
                            <input class="text-center border-0 changeTypeSocial{{ $row+15 }}" id="changeType"
                                type="password" value="password" data-toggle="modal" data-target="#exampleModal"
                                onclick="sendKey({{ $row+15 }});sendPass('{{$socialAccount->id }}')">
                        </td>
                    </tr>
                    <div class="modal validationPass fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Validación de Usuario</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Ingrese su
                                                Contraseña:</label>
                                            <input type="password" class="form-control" id="verifyPassSocial"
                                                name="verifyPass" onkeypress="validar(event)">
                                            <input type="hidden" value="" name="passStreaming" id="passSocial">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                                        onclick="verifyPassSocial()">Comprobar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" name="selected" id="selected">
</div>
