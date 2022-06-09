<div class="card w-100">
    <div class="table-responsive">
        @if(!empty($datas))
        <table
            class="table table-striped align-items-center table-flush table-hover text-center table-borderless table-sm">
            <thead class="thead-light">
                <tr>
                    <th class="text-center" scope="col">Comentario</th>
                    <th class="text-center" scope="col">Usuario</th>
                </tr>
            </thead>
            <tbody class="list">
                @foreach($datas as $info)
                <tr>
                    <td class="text-center">{{ $info->commentary }}</td>
                    <td class="text-center">{{ $info->user }}</td>
                </tr>
                @endforeach
            <tbody>
        </table>
        @else
        <span class="text-sm"><strong>Aún no</strong> tiene comentarios</span>
        @endif
    </div>
</div>
