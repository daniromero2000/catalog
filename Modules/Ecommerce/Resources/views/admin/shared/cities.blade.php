<table class="table-striped table">
    <thead>
        <tr>
            <td class="col-md-4">Nombre</td>
            <td class="col-md-4">Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($cities as $city)
        <tr>
            <td>{{ $city['name'] }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('admin.countries.provinces.cities.edit', [$countryId, $province->id, $city['id']]) }}"
                        class="btn btn-primary"><i class="fa fa-eye"></i> Editar</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>