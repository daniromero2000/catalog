<script>
    function customer_bank_accounts_finder(stream_account_id) {
        target_key = document.getElementById("target_" + stream_account_id).value;
        customer_bank_accounts = bank_accounts[target_key]['contract_request']['customer']['customer_bank_accounts'];
        content = "<option value selected disabled>--Select an option--</option>";

        customer_bank_accounts.forEach(bank_account => {
            if(bank_account['is_active'] == '1'){
                bank_id = bank_account['id'];
                bank_name = bank_account['bank']['name'];
                account_type = bank_account['account_type'];
                account_number = bank_account['account_number'];
                content += '<option value="' + bank_id +
                                '">' + bank_name + ' ' + account_type + ' ' + account_number + '</option>';
            }
        });

        document.getElementById('customer_bank_account_id').innerHTML = content;
    }

    function loan_modal() {
        if (document.getElementById('payment_type').value == '0') {
            $("#loan_question").modal({
                show: true
            });
        }
        activate_loan(0);
    }

    function activate_loan(asign_value) {
        document.getElementById('loan').value = asign_value;
    }

    function payment_type_finder(continuer = '') {
        stream_account_id = document.getElementById("contract_request_stream_account_id").value;
        selected_stream = document.getElementById('key_' + stream_account_id).value;
        target_key = document.getElementById("target_" + stream_account_id).value;
        payment_type = bank_accounts[target_key]['streaming']['streaming'];
        if (selected_stream == "2") {
            document.getElementById('option_0').style.display = "none";
            document.getElementById('option_1').style.display = "none";
            document.getElementById('option_2').style.display = "inline";
            document.getElementById('option_2').selected = true;
            document.getElementById('input_quantity').innerHTML = 'Cantidad Tokens <span class="text-danger">*</span>';
        } else {
            if (payment_type == "Chaturbate") {
                document.getElementById('option_0').style.display = "inline";
            } else {
                document.getElementById('option_0').style.display = "none";
            }
            document.getElementById('option_1').style.display = "inline";
            document.getElementById('option_2').style.display = "none";
            document.getElementById('option_2').selected = false;
            document.getElementById('option_default').selected = true;
            document.getElementById('input_quantity').innerHTML = 'Cantidad Dolares <span class="text-danger">*</span>';
        }
        if (continuer == 1) {
            customer_bank_accounts_finder(stream_account_id);
        }
        activate_loan(0);
    }

    function disable_button(target_id) {
        document.getElementById(target_id).disabled = true;
    }

    function room_selection(room) {
        open_doors = document.getElementsByClassName('fa-door-open');
        [].forEach.call(open_doors, function (el) {
            el.className = el.className.replace(/\bfa-door-open\b/g, "fa-door-closed");
        });
        selected_room = document.getElementById('icon_' + room);
        selected_room.className = selected_room.className.replace(/\bfa-door-closed\b/g, "fa-door-open");
        $("#modal" + room).modal({
            show: true
        });
    }

    function subsidiary_selection() {
        subsidiary = document.getElementById('subsidiary_selector').value;
        room_cards = "";
        rooms.forEach(room => {
            if (subsidiary == '0' || subsidiary == room['subsidiary']['id'])
                room_cards += '<div class="col-xl-2 col-lg-3">' +
                '<div class="card mx-0 px-0">' +
                '<button type="button" onclick="room_selection(' + room['id'] + ')" class="btn mx-0 pt-4">' +
                '<span style="color: #AF6AA4"><i id="icon_' + room['id'] + '"' +
                'class="fas fa-door-closed fa-6x"></i></span>' +
                '<div class="card-body text-center p-0 pt-2">' +
                '<h5 class="card-title m-0">' + room['name'] + '</h5>' +
                '<span class="h5 card-text p-0">' + room['subsidiary']['name'] + '</span>' +
                '</div>' +
                '</button>' +
                '</div>' +
                '</div>';
        });
        document.getElementById('room_cards').innerHTML = room_cards;
    }

</script>
