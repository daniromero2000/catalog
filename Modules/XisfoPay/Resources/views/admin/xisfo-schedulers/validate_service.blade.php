<script>
    function addUrl(){
        var idUser = document.getElementById('id_employee').value;
        $("#content_btn_scheduler").empty();
        $("#content_btn_scheduler").append('<a href="schedulers/viewScheduler/'+idUser+'" class="btn btn-primary btn-sm" id="create_button">Crear</a>');
    }
    function  changeService() {
        var x = document.getElementById("service").value;
        $.ajax({
            type:"POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url:"/admin/xisfo-schedulers/verifyService/",
            data:{idservice:x},
            success:function(resp){
                var at = [];
                $.each(resp,function(key,value){
                    if(key == 'attachedEmployeesArrayIds'){
                        if(value.length == 0){
                            $("#id_employee").empty();
                            document.getElementById("id_employees").style.display = "block";
                            $("#id_employee").append('<option>No hay ningún asesor disponible.</option>');
                        }else{
                            for(var i=0;i<value.length;i++){
                                at[i] = value[i];
                            }
                        }
                    }
                    if(key == 'employees'){
                        $("#id_employee").empty();
                        var cont = 0;
                        for(var j=0;j<value.length;j++){
                            for(var n=0;n < at.length;n++){
                                if(at[n]==value[j]['id']){
                                    document.getElementById("id_employees").style.display = "block";
                                    if(cont==0){
                                        $("#id_employee").append('<option>Selecciona Asesor</option>');
                                        cont++;
                                    }
                                    $("#id_employee").append('<option value="'+value[j]['id']+'">'+value[j]['name']+" "+value[j]['last_name']+'</option>');
                                }
                            }
                        }
                    }
                });

            },
        })
    }
</script>
