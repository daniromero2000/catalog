<div class="table-responsive">
    <table class="table-striped table align-items-center table-flush table-hover">
        @include('generals::layouts.admin.tables.table-headers')
        <tbody>
            @foreach($datas as $data)
            <tr>
                @foreach($data->toArray() as $key => $value)
                <td class="text-center">
                    {{ $data[$key] }}
                </td>
                @endforeach
                <td class="text-center">
                    @include('generals::layouts.admin..tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes])
                </td>
            </tr>
            @endforeach
        <tbody>
    </table>
</div>
