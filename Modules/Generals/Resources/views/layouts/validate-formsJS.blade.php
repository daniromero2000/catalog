<script>
    function onlyletters(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46];
    
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
    }
    
    function clean() {
        var val = document.getElementById("formInput").value;
        var tam = val.length;
        for(i = 0; i < tam; i++) {
            if(!isNaN(val[i]))
                document.getElementById("formInput").value = '';
        }
    }

    function valideKey(evt){        
        var code = (evt.which) ? evt.which : evt.keyCode;
        
        if(code==8) {
          return true;
        } else if(code>=48 && code<=57) {
          return true;
        } else{
          return false;
        }
    }
    var input=  document.getElementById('numero');
        input.addEventListener('input',function(){
        if (this.value.length > 10) 
            this.value = this.value.slice(0,10); 
    })
</script>