@if ($cammodelStreamingIncomes->isNotEmpty())
<div class="card">
    <div class="card_body p-3">
        <span class="h3">Información de la Modelo:
            {{ $cammodel->nickname }}
        </span>
        <div class="row mt-2">
            <div class="col-lg-3 text-center h-100">
                <div class="card bg-gradient-secondary d-block mx-0">
                    <br>
                    <div class="card-body p-0 text-center" style="overflow: hidden">
                        <div class="circular-image text-center">
                            <a
                                href="{{route('admin.cammodels.show', $cammodelStreamingIncomes['0']['cammodel']['id'])}}">
                                @if ($cammodelStreamingIncomes['0']['cammodel']->employeeName->avatar != "No
                                Avatar")
                                <img src="{{ asset("storage/".$cammodelStreamingIncomes['0']['cammodel']->employeeName->avatar) }}"
                                    style="max-width: 100%; max-height: 300px;"
                                    id="cammodel_{{ $cammodelStreamingIncomes['0']['cammodel']['id'] }}"
                                    alt="{{ $cammodelStreamingIncomes['0']['cammodel']['nickname'] }}">
                                @else
                                <img src="https://cdn.pixabay.com/photo/2014/04/02/14/10/female-306407__340.png"
                                    style="max-width: 100%; max-height: 300px;"
                                    id="cammodel_{{ $cammodelStreamingIncomes['0']['cammodel']['id'] }}"
                                    alt="{{ $cammodelStreamingIncomes['0']['cammodel']['nickname'] }}">
                                @endif
                            </a>
                        </div>
                    </div>
                    <span class="text-sm">
                        {{ $cammodelStreamingIncomes['0']['cammodel']->employeeName->name }}
                        {{ $cammodelStreamingIncomes['0']['cammodel']->employeeName->last_name }}
                        <br>
                        Sede: {{ $cammodelStreamingIncomes['0']['cammodel']->employeeName->subsidiary->name }}
                        <br>
                        @if ($cammodelStreamingStats->isNotEmpty())

                        Última transmisión:
                        @if ($cammodelStreamingStats->last()->last_broadcast != null)
                        {{ $cammodelStreamingStats->last()->last_broadcast->format('M d, Y') }}
                        @else
                        ----
                        @endif
                        <br>
                        <b>{{ $cammodelStreamingStats->last()->votes_up }}</b>
                        <i class="fas fa-thumbs-up"></i>
                        <i class="fas fa-thumbs-down ml-2"></i>
                        <b>{{$cammodelStreamingStats->last()->votes_down }}</b>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-lg-3 p-lg-0 mx-0 text-center">
                <div class="card mb-3 d-block py-2">
                    <span class="h3">Progreso de Ventas</span>
                    <br>
                    <span class="h4">{{ number_format($cammodelStreamingIncomes['0']['usd_cammodel'] / 2, 2) }}
                        / {{ $cammodelStreamingIncomes['0']['cammodel']['shift']['goal']['usd_goal'] }} (USD)</span>
                    <div style="position: relative;">
                        <span>{{ number_format((($cammodelStreamingIncomes['0']['usd_cammodel'] / 2) * 100) /
                                $cammodelStreamingIncomes['0']['cammodel']['shift']['goal']['usd_goal'], 2) }} %</span>
                    </div>
                    <div class="chart" style="height: 250px">
                        <canvas id="streaming-incomes-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="card mb-3 mx-0 d-block p-2">
                    <span class="h3">Ventas por Streaming (USD)</span>
                    <br>
                    <span class="text-sm font-weight-bold">Plataforma de mayores ventas:
                        <span class="font-weight-light" id="best-platform"></span>
                    </span>
                    <br>
                    <span class="text-sm font-weight-bold">Plataforma de menores ventas:
                        <span class="font-weight-light" id="worst-platform"></span>
                    </span>
                    <div class="chart" style="height: 250px">
                        <canvas id="streamings-incomes-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pr-lg-0 text-center">
                <div class="card mb-3 mx-0 d-block p-2">
                    <span class="h3">Ventas quincena actual (USD)</span>
                    <div class="chart" style="height: 250px">
                        <canvas id="daily-incomes-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 pr-3 text-center" id="fortnights-graph">
                <button class="btn p-0 m-0 w-100" onclick="changeGraph('progress-graph', 'fortnights-graph')">
                    <div class="card mb-3 mx-0 d-block p-2">
                        <span class="h3">Comparación Quincenas (USD)</span>
                        <div class="chart" style="height: 250px">
                            <canvas id="fortnights-incomes-chart"></canvas>
                        </div>
                    </div>
                </button>
            </div>
            <div class="col-lg-6 pr-3 text-center" style="display: none;" id="progress-graph">
                <button class="btn p-0 m-0 w-100" onclick="changeGraph('fortnights-graph', 'progress-graph')">
                    <div class="card mb-3 d-block bg-gradient-default shadow p-2">
                        <span class="h3 text-white">Progreso 60 Días (USD)</span>
                        <div class="chart" style="height: 250px">
                            <canvas id="60-progress-chart"></canvas>
                        </div>
                    </div>
                </button>
            </div>
            @if ($cammodelStreamingStats->isNotEmpty())
            <div class="col-lg-6 pr-lg-0">
                <div class="card bg-gradient-default shadow p-2">
                    <div class="row">
                        <div class="col-6">
                            <span class="text-white ml-2">Seguidores en Streaming</span>
                        </div>
                        <div class="col-6 text-right">
                            <select class="form-control form-control-sm">
                                <option value="1">Chaturbate</option>
                                <option value="2">My Free Cams</option>
                                <option value="3">Cam4</option>
                                <option value="4">CamSoda</option>
                                <option value="5">Bongacams</option>
                                <option value="7">Stripchat</option>
                                <option value="8">Streamate</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-2 mt-2">
                        <div class="chart" style="height: 250px">
                            <canvas id="streaming-stats-chart"></canvas>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="col-6 text-white text-sm ml-2">Seguidores actuales:
                            {{ $cammodelStreamingStats->last()->num_followers }}</span>
                        <span class="col-6 text-white text-sm ml-2">Variación:
                            {{ number_format($changeRateStreaming, 2) }}%
                            @if ($changeRateStreaming == 0)
                            <i class="fas fa-minus mr-3"></i>
                            @elseif ($changeRateStreaming < 0) <i class="fas fa-arrow-down text-danger mr-3"></i>
                                @else
                                <i class="fas fa-arrow-up text-success mr-3"></i>
                                @endif
                        </span>
                    </div>
                </div>
            </div>
            @endif

            @if ($cammodelSocialStats->isNotEmpty())
            <div class="col-lg-6">
                <div class="card bg-gradient-default shadow p-2">
                    <div class="row">
                        <div class="col-6">
                            <span class="text-white ml-2">Seguidores en Redes Sociales</span>
                        </div>
                        <div class="col-6 text-right">
                            <select class="form-control form-control-sm">
                                <option value="3">Twitter</option>
                                <option value="2">Instagram</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-2 mt-2">
                        <div class="chart" style="height: 250px">
                            <canvas id="social-stats-chart"></canvas>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="col-6 text-white text-sm ml-2">Seguidores actuales:
                            {{ $cammodelSocialStats->last()->followers_count }}</span>
                        <span class="col-6 text-white text-sm ml-2">Variación:
                            {{ number_format($changeRateSocial, 2) }}%
                            @if ($changeRateSocial == 0)
                            <i class="fas fa-minus mr-3"></i>
                            @elseif ($changeRateSocial < 0) <i class="fas fa-arrow-down text-danger mr-3"></i>
                                @else
                                <i class="fas fa-arrow-up text-success mr-3"></i>
                                @endif
                        </span>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@else
<div class="card">
    <div class="card_body p-3">
        <span class="h3">Información de la Modelo:
            {{ $cammodel->nickname }}
        </span>
        <div class="row mt-2">
            <div class="col-lg-3 text-center h-100">
                <div class="card bg-gradient-secondary d-block mx-0">
                    <br>
                    <div class="card-body p-0 text-center" style="overflow: hidden">
                        <div class="circular-image text-center">
                            <a
                                href="{{route('admin.cammodels.show', $cammodel->id)}}">
                                @if ($cammodel->employee->avatar != "No
                                Avatar")
                                <img src="{{ asset("storage/".$cammodel->employee->avatar) }}"
                                    style="max-width: 100%; max-height: 300px;"
                                    id="cammodel_{{ $cammodel->id }}"
                                    alt="{{ $cammodel->nickname }}">
                                @else
                                <img src="https://cdn.pixabay.com/photo/2014/04/02/14/10/female-306407__340.png"
                                    style="max-width: 100%; max-height: 300px;"
                                    id="cammodel_{{ $cammodel->id }}"
                                    alt="{{ $cammodel->nickname }}">
                                @endif
                            </a>
                        </div>
                    </div>
                    <span class="text-sm">
                        {{ $cammodel->employee->name }}
                        {{ $cammodel->employee->last_name }}
                        <br>
                        Sede: {{ $cammodel->employee->subsidiary->name }}
                    </span>
                </div>
            </div>
            <div class="col-lg-9 text-center h-100">
                <span class="h2">La modelo aún no cuenta con ingresos registrados para esta quincena</span>
            </div>
        </div>
    </div>
</div>
@endif
