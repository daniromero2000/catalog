<script>
    function prefixSelector(selector){
        $phoneType = document.getElementById(selector).value;
        if ($phoneType == "Fijo") {
            document.getElementById('prefix_select').style.display = "inline";
            document.getElementById('prefix_select').required = true;
        } else{
            document.getElementById('prefix_select').style.display = "none";
            document.getElementById('prefix_select').required = false;
        }
    }
</script>