<div class="modal fade" id="size_overflow_" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header m-auto">
                <h1 class="modal-title mt-2" id="modalConfirmCreateLabel">TAMAÑO DE ARCHIVOS EXCEDIDO<span
                        style="color: #f5365c;"> <i class="fas fa-exclamation-circle"></i></span></h1>
            </div>
            <div class="modal-body text-center" style="padding:0px !important;">
                <p>
                    El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                </p>
                <p>Los archivos que has seleccionado pesan <span id="total_size_"></span>MB</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>
<script>
    function AcceptableFileUpload(form, to_modal, group_id, input_id = 0, grouped = 0) {
        var total_size = 0;
        if (input_id == 0) {
            if (grouped == '1') {

                if (document.getElementById('file_logo').files[0]) {
                    total_size = document.getElementById('file_logo').files[0].size + total_size;
                }
                if (document.getElementById('file_commerce').files[0]) {
                    total_size = total_size + document.getElementById('file_commerce').files[0].size;
                }
            } else{
                $('#'+form+' input:file').each(function () {
                    if ($(this).val().length > 0) {
                        for (index = 0; index < $(this)[0].files.length; index++) {
                            total_size = total_size + $(this)[0].files[index].size;
                        }
                    }
                });
            }
        } else {
            total_size = document.getElementById(input_id).files[0].size;
        }
        if (total_size > 10485760) {
            // Un MB en B es 1048576
            document.getElementById('total_size_'+ group_id).innerHTML = ((total_size / 1024) / 1024).toFixed(2);
            document.getElementById("create_button_"+ group_id).disabled = true;
            if (to_modal == '1') {
                $("#size_overflow_"+ group_id).modal({
                    show: true
                });
            } else{
                document.getElementById('size_overflow_'+ group_id).style.display = 'inline';
            }
        } else {
            document.getElementById("create_button_"+ group_id).disabled = false;
            document.getElementById('size_overflow_'+ group_id).style.display = 'none';
        }
    }
</script>
