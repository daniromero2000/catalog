<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var jq = $.noConflict(true);
    jq(document).ready(function () {
        if(document.getElementById('country_id_customer_1')){
            getCity($('#country_id_customer_1').val(), 'customer', '1');
            getCity($('#country_id_representative_1').val(), 'representative', '1');
            getCity($('#country_id_customer_2').val(), 'customer', '2');
            getCity($('#country_id_representative_2').val(), 'representative', '2');
        }

        function changeCountry(target, sub_target = '') {
            var city = $('#country_id_' + target + '_' + sub_target).val();
            getCity(city, target);
        }

        function getCity(city, target, sub_target = '') {
            jq.get('/api/user/getCountry/' + city + '/province/', function (data) {
                if (data) {
                    let html =
                        '<label class="laber-form-card form-control-label" for="province_id">Departamento <span class="text-danger">*</span></label>';
                    html +=
                        '<select id="province_id_' + target + '_' + sub_target +
                        '" onchange="getProvince(' + "'" + target + "','" + sub_target + "'" + 
                        ')" required class="custom-select input-form-register"> <option value selected disabled>--Select an option--</option>';
                    jq(data).each(function (idx, v) {
                        html += '<option value="' + v.id + '">' + v.province + '</option>';
                    });
                    html += '</select>';

                    jq('#provinces_' + target + '_' + sub_target).html(html).show();
                }
            });
        }
    });

    function getProvince(target, sub_target = '') {
        var province = $('#province_id_' + target + '_' + sub_target).val();
        jq.get('/api/user/getProvince/' + province + '/city/', function (data) {
            if (data) {
                
                let html = '<option value selected disabled>--Select an option--</option>';
                jq(data).each(function (idx, v) {
                    html += '<option value="' + v.id + '">' + v.city + '</option>';
                });

                jq('#cities_' + target + '_' + sub_target).html(html);
            }
        });
    }

    function cityValuer(target = '2',sub_target = ''){
        var city = jq('#cities_'+target+'_'+sub_target).val();
        jq('#city_target_'+target+'_'+sub_target).val(city);
    }

</script>
