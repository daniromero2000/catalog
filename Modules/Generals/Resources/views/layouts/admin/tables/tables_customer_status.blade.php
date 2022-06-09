<table class="table-striped table table-borderless table-hover table-sm">
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
                <span style="display:block; width: 45px; height: 15px; margin:auto; background-color:{{ $data['color'] }}"></span>
            </td>
            <td class="text-center">
                @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes])
            </td>
        </tr>
        @endforeach
    <tbody>
</table>
