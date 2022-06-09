<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var jq = $.noConflict(true);
    jq(document).ready(function () {
        getCity($('#country_id_customer_1').val(), 'customer', '1');
        getCity($('#country_id_representative_1').val(), 'representative', '1');
        getCity($('#country_id_customer_2').val(), 'customer', '2');
        getCity($('#country_id_representative_2').val(), 'representative', '2');

        function changeCountry(constitution_type, customer_type) {
            var city = $('#country_id_' + constitution_type + '_' + customer_type).val();
            getCity(city, constitution_type, customer_type);
        }

        function getCity(city, constitution_type, customer_type) {
            //var city = $('#country_id_'+constitution_type+'_'+customer_type).val();
            jq.get('/api/user/getCountry/' + city + '/province/', function (data) {
                if (data) {
                    let html =
                        '<label class="laber-form-card form-control-label" for="province_id">Departamento <span class="text-danger">*</span></label>';
                    html +=
                        '<select id="province_id_' + constitution_type + '_' + customer_type +
                        '" onchange="getProvince(' + "'" + constitution_type + "'" + ',' + "'" +
                        customer_type + "'" +
                        ')" required class="custom-select input-form-register"> <option value selected disabled>--Select an option--</option>';
                    jq(data).each(function (idx, v) {
                        html += '<option value="' + v.id + '">' + v.province + '</option>';
                    });
                    html += '</select>';

                    jq('#provinces_' + constitution_type + '_' + customer_type).html(html).show();
                }
            });
        }
    });

    function getProvince(constitution_type, customer_type) {
        var province = $('#province_id_' + constitution_type + '_' + customer_type).val();
        jq.get('/api/user/getProvince/' + province + '/city/', function (data) {
            if (data) {
                let html =
                    '<label class="laber-form-card form-control-label" for="city">Ciudad <span class="text-danger">*</span></label>';
                if (constitution_type == 'customer') {
                    html +=
                        '<select class="custom-select input-form-register" name="city_id" id="company_city_id" enabled required> <option value selected disabled>--Select an option--</option>';
                } else{
                    html +=
                        '<select class="custom-select input-form-register" name="company_city_id" id="company_city_id" enabled required> <option value selected disabled>--Select an option--</option>';
                }
                jq(data).each(function (idx, v) {
                    html += '<option value="' + v.id + '">' + v.city + '</option>';
                });
                html += '</select>';

                jq('#cities_' + constitution_type + '_' + customer_type).html(html).show();
            }
        });
    }
</script>
