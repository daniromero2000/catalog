<div class="col-xl-7 order-xl-1">
    <form>
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Editar Perfil <strong>{{$cammodel->nickname}}</strong></h3>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="pl-lg-4">
                    <div class="row mr-4">
                        <div class="col-lg-10">
                            <div class="form-group">
                                <label class="form-control-label ml-3" for="nickname">Nickname</label>
                                <input required type="text" id="nickname" name="nickname"
                                    class="form-control rounded-pill" style="background: #E6E6E6"
                                    placeholder="Nombre" value="{{$cammodel->nickname}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label ml-3" for="height">Estatura</label>
                                <input type="text" id="height" value="{{$cammodel->height}}"
                                    name="height" class="form-control rounded-pill "
                                    style="background: #E6E6E6" placeholder="1.50">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label ml-3" for="weight">Peso / Kg</label>
                                <input required type="text" id="weight" name="weight"
                                    value="{{$cammodel->weight}}" class="form-control rounded-pill "
                                    style="background: #E6E6E6" placeholder="50">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label ml-3" for="breast_cup_size">Tamaño de
                                    senos</label>
                                <input type="text" id="breast_cup_size" name="breast_cup_size"
                                    class="form-control rounded-pill " style="background: #E6E6E6"
                                    placeholder="38B" value="{{$cammodel->breast_cup_size}}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label ml-3" for="fake_age">Edad</label>
                                <input required type="text" id="fake_age" name="fake_age"
                                    value="{{$cammodel->fake_age}}" class="form-control rounded-pill "
                                    style="background: #E6E6E6" placeholder="50">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label ml-3">Categorías</label>
                                @include('camstudio::admin.shared.categories', ['categories' =>
                                $categories,
                                'ids' => $cammodel])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="pl-lg-4 pr-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label ml-3">Sobre mí</label>
                                <div class="input-group">
                                    <textarea required name="about_me" rows="4" id="about_me"
                                        class="form-control" aria-label="With textarea"
                                        style="background: #E6E6E6; border-radius: 1rem;">{{$cammodel->about_me}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label ml-3">Tatuajes y piercings?</label>
                                <div class="input-group">
                                    <textarea required name="tattoos_piercings" rows="4" id="tattoos_piercings"
                                        class="form-control" aria-label="With textarea"
                                        style="background: #E6E6E6; border-radius: 1rem;">{{$cammodel->tattoos_piercings}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label ml-3">Gustos y disgustos</label>
                                <div class="input-group">
                                    <textarea required name="likes_dislikes" rows="4"
                                        id="likes_dislikes" class="form-control"
                                        aria-label="With textarea"
                                        style="background: #E6E6E6; border-radius: 1rem;">{{$cammodel->likes_dislikes}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pl-lg-4 pr-lg-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label ml-3">Mis reglas</label>
                                <div class="input-group">
                                    <textarea required name="my_rules" rows="4" id="editor"
                                        class="form-control" aria-label="With textarea"
                                        style="background: #E6E6E6; border-radius: 1rem;">{{$cammodel->my_rules}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
