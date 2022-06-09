<div class="row p-0 m-0 bg-lighter">
    <div class="col-12 text-center font-weight-bold">
        Informe Cierre Del Trimestre De {{ $monthsNames['firstMonthName'] }} 
        A {{ $monthsNames['thirdMonthName'] }}
    </div>
    <div class="col-12 text-center bg-blue text-white font-weight-bold overflow-hidden">
        CONSOLIDADO VENTAS DE 
        {{ Str::upper($monthsNames['firstMonthName']) }} 
        A {{ Str::upper($monthsNames['thirdMonthName']) }} - POR MODELO (USD)
    </div>
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="row">
            <div class="col-12 p-0">
                <div class="table bg-white">
                    <table class="table table-bordered w-100">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center text-darker font-weight-bold p-1">Colores Aporte: </th>
                                <th class="text-center font-weight-bold text-darker p-1" style="color: #66CCFF !important;">
                                    Por encima de 600
                                </th>
                                <th class="text-center font-weight-bold text-darker p-1" style="color: #72D035 !important;">
                                    De 400 a 599,999
                                </th>
                                <th class="text-center font-weight-bold text-darker p-1" style="color: #FFF379 !important;">
                                    De 250 a 399,999
                                </th>
                                <th class="text-center font-weight-bold text-darker p-1" style="color: #FFAC42 !important;">
                                    De 90 a 249,999
                                </th>
                                <th class="text-center font-weight-bold text-darker p-1" style="color: #FF6961 !important;">
                                    De 0 a 89,999
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="col-4 pl-0 pr-2 mb-2">
                @include('camstudio::admin.layouts.camstudio-reports.trimester.first_month_table')
            </div>
            <div class="col-4 px-0 pr-xl-2 mb-2">
                @include('camstudio::admin.layouts.camstudio-reports.trimester.second_month_table')
            </div>
            <div class="col-4 px-0 mb-2">
                @include('camstudio::admin.layouts.camstudio-reports.trimester.third_month_table')
            </div>
        </div>
    </div>
    @include('camstudio::admin.layouts.camstudio-reports.compound_liquidations_table')
    @include('camstudio::admin.layouts.camstudio-reports.rooms_liquidations_table')
    <div class="col-lg-12 col-xl-6">
        <div class="row">
            @include('camstudio::admin.layouts.camstudio-reports.subsidiaries_liquidations_table')
            @include('camstudio::admin.layouts.camstudio-reports.cammodel_shifts_liquidations_table')
            @include('camstudio::admin.layouts.camstudio-reports.work_report_shifts_liquidations_table')
            @include('camstudio::admin.layouts.camstudio-reports.managers_liquidations_table')
        </div>
    </div>
    {{-- <div class="col-12 px-0">
        <div class="table">
            <table class="table table-bordered w-100">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center text-darker font-weight-bold p-1">Colores Crecimientos</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <tr>
                        <td class="text-center font-weight-bold text-darker p-1"
                            style="color: #62ff4d !important;">
                            Superior al 15%
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-weight-bold text-darker p-1"
                            style="color: #fff34d !important;">
                            Entre el 1% y el 14%
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-weight-bold text-darker p-1"
                            style="color: #fa4b4b !important;">
                            Decrecimiento
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-weight-bold text-darker p-1">
                            Crítica - antes de ajuste
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
</div>