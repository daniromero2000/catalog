<style>
    .message{
        text-align: center;
        display: none;
        color: #154394;
        padding-bottom: 10px;
    }
</style>
<script>
    function validar(e) {
        var key=e.keyCode || e.which;
        if (key==13){
            verifyPass();
            $("#exampleModal").modal('hide')
            e.preventDefault();
        }
    }
    function sendKey(value){
        document.getElementById("selected").value = value;

    }
    function sendPass(val){
        document.getElementById("passStreaming").value = val;
    }
    function verifyPass(){
        var verifyPass = document.getElementById('verifyPass').value;
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
                    $("#message").html("Validación no superada, no cuenta con los permisos necesarios o la contraseña ingresada es incorrecta.");
                }else{
                    $('.changeType'+selected).val(res);
                    $('.changeType'+selected).attr('type', 'text');
                    $('.changeType'+selected).attr('disabled', 'disabled');
                    $("#message").html("Validación correcta");
                }
            },
        })
    }
</script>
