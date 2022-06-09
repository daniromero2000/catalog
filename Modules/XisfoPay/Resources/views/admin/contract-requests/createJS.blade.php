<script>
    function myfunction(constitution_type) {
        var company_legal_name = document.getElementById('company_legal_name');

        if (constitution_type.value == 'Natural') {
            var name = document.getElementById("name").value;
            var last_name = document.getElementById("last_name").value;
            company_legal_name.value = name.concat(' ', last_name);
            document.getElementById('is_tokens').style.display = 'inline';
        } else {
            company_legal_name.value = '';
            document.getElementById('is_tokens').style.display = 'none';
            $("#contract_request_type").val('0');
        }
    };
</script>
