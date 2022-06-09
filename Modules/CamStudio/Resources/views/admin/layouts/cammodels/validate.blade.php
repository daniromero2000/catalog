<style>
    .message{
        text-align: center;
        display: none;
        color: #154394;
        padding-bottom: 10px;
    }
</style>
<script>
    function validar(e,target) {
        var key=e.keyCode || e.which;
        if (key==13){
            if (target == 0) {
                verifyPassStreaming();
            } else{
                verifyPassSocial();
            }
            $("#validationModal").modal('hide')
            e.preventDefault();
        }
    }
    function sendKey(value){
        document.getElementById("selected").value = value;

    }
    function sendPass(val){
        document.getElementById("passStreaming").value = val;
    }
    function verifyPassStreaming(){
        var verifyPass = document.getElementById('verifyPass').value;
        var passStreaming = document.getElementById('passStreaming').value;
        var selected = document.getElementById('selected').value;
        $.ajax({
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"/admin/cammodel-streamings/verifyPass/",
            data:{verifyPass:verifyPass,passStreaming:passStreaming},
            success:function(res){
                if(res == 'No Correcta'){
                    document.getElementById('message').style.display = "block";
                    document.getElementById('message').classList.remove("btn-success");
                    document.getElementById('message').classList.add("btn-danger");
                    $("#message").html("Validación no superada, no cuenta con los permisos necesarios o la contraseña ingresada es incorrecta.");
                }else{
                    $('.changeType'+selected).val(res);
                    $('.changeType'+selected).attr('type', 'text');
                    $('.changeType'+selected).attr('disabled', 'disabled');
                    document.getElementById('message').style.display = "block";
                    document.getElementById('message').classList.remove("btn-danger");
                    document.getElementById('message').classList.add("btn-success");
                    $("#message").html("Validación correcta");
                }
            },
        })
    }
    function verifyPassSocial(){
        var verifyPass = document.getElementById('verifyPassSocial').value;
        var passStreaming = document.getElementById('passStreaming').value;
        var selected = document.getElementById('selected').value;
        $.ajax({
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"/admin/cammodel-social/verifyPass/",
            data:{verifyPass:verifyPass,passStreaming:passStreaming},
            success:function(res){
                if(res == 'No Correcta'){
                    document.getElementById('message').style.display = "block";
                    document.getElementById('message').classList.remove("btn-success");
                    document.getElementById('message').classList.add("btn-danger");
                    $("#message").html("Validación no superada, no cuenta con los permisos necesarios o la contraseña ingresada es incorrecta.");
                }else{
                    $('.changeTypeSocial'+selected).val(res);
                    $('.changeTypeSocial'+selected).attr('type', 'text');
                    $('.changeTypeSocial'+selected).attr('disabled', 'disabled');
                    document.getElementById('message').style.display = "block";
                    document.getElementById('message').classList.remove("btn-danger");
                    document.getElementById('message').classList.add("btn-success");
                    $("#message").html("Validación correcta");
                }
            },
        })
    }
</script>
