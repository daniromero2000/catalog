<table class="table-striped table">
    <thead class="thead-light">
        <tr>
            <th class="text-center" scope="col">DANE</th>
            <th class="text-center" scope="col">NOMBRE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cities as $city)
        <tr>
            <td class="text-center">{{ $city['dane'] }}</td>
            <td class="text-center">{{ $city['city'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>