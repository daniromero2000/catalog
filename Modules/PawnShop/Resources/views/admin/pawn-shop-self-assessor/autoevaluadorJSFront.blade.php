<script>
    // PawnShop Items
    // ============================================================
    $("#item_category_id").change(function () {
    if ($(this).val() == "1") {
    $('#jewelry_quality_id').show();
    $('#weight').show();
    $('#otherField').attr('required', '');
    $('#otherField').attr('data-error', 'This field is required.');
    $("#marca").prop('required', false);
    $("#ref1").prop('required', false);
    $("#ref2").prop('required', false);
    $("#fasecoldaCodeRef3").prop('required', false);
    $("#model").prop('required', false);
    } else {
    $('#jewelry_quality_id').hide();
    $('#weight').hide();
    $('#otherField').removeAttr('required');
    $('#otherField').removeAttr('data-error');
    }
    });
    $("#item_category_id").trigger("change");

    $("#item_category_id").change(function () {
    if ($(this).val() == "2") {
    $('#fasecoldaCodeClase1').show();
    $('#fasecoldaCodeMarca1').show();
    $('#fasecoldaCodeRef01').show();
    $('#fasecoldaCodeRef02').show();
    $('#fasecoldaCodeRef03').show();
    $('#fasecoldaModelo1').show();
    $('#fasecoldaPrice1').show();
    $('#name').hide();
    $("jewelry_quality_id").prop('required', false);
    $("#marca").prop('required', true);
    $("#ref1").prop('required', true);
    $("#ref2").prop('required', true);
    $("#fasecoldaCodeRef3").prop('required', true);
    $("#model").prop('required', true);
    } else {
    $('#fasecoldaCodeClase1').hide();
    $('#fasecoldaCodeMarca1').hide();
    $('#fasecoldaCodeRef01').hide();
    $('#fasecoldaCodeRef02').hide();
    $('#fasecoldaCodeRef03').hide();
    $('#fasecoldaModelo1').hide();
    $('#fasecoldaPrice1').hide();
    $('#name').show();
    }
    });
    $("#item_category_id").trigger("change");

    $("#seeAnotherFieldGroup").change(function () {
    if ($(this).val() == "yes") {
    $('#otherFieldGroupDiv').show();
    $('#otherField1').attr('required', '');
    $('#otherField1').attr('data-error', 'This field is required.');
    $('#otherField2').attr('required', '');
    $('#otherField2').attr('data-error', 'This field is required.');
    } else {
    $('#otherFieldGroupDiv').hide();
    $('#otherField1').removeAttr('required');
    $('#otherField1').removeAttr('data-error');
    $('#otherField2').removeAttr('required');
    $('#otherField2').removeAttr('data-error');
    }
    });
    $("#seeAnotherFieldGroup").trigger("change");

    $('#fasecoldaCodeClase').change(function () {
    var fasecoldaClase = $(this).val();
    $('#marca', ).html('<option value="">-- Seleccione --</option>');
    $('#ref1', ).html('<option value="">-- Seleccione --</option>');
    $('#ref2', ).html('<option value="">-- Seleccione --</option>');
    $('#fasecoldaCodeRef3', ).html('<option value="">-- Seleccione --</option>');
    $('#model', ).html('<option value="">-- Seleccione --</option>');

    if (fasecoldaClase) {
    $.ajax({
    url: '/items/getmarcs',
    type: "GET",
    data: {
    _token: "{{ csrf_token() }}",
    clase: fasecoldaClase
    },
    dataType: "json",
    success: function (data) {
    if (data) {
    $('#marca').empty();
    $('#marca').focus;
    $('select[name="marca"]').append('<option value="">-- Seleccciona Marca --</option>');
    $.each(data, function (key, value) {
    $('select[name="marca"]').append('<option value="' + key + '">' + value + '</option>');
    });
    } else {
    $('#marca').empty();
    }
    }
    });
    } else {
    $('#marca').empty();
    }
    });
    $('#marca').change(function () {
    var fasecoldaClase = $("#fasecoldaCodeClase").val();
    var fasecoldaMarca = $(this).val();
    $('#ref1').html('<option value="">-- Seleccione --</option>');
    $('#ref2', ).html('<option value="">-- Seleccione --</option>');
    $('#fasecoldaCodeRef3', ).html('<option value="">-- Seleccione --</option>');
    $('#model', ).html('<option value="">-- Seleccione --</option>');
    if (fasecoldaMarca) {
    $.ajax({
    url: '/items/getrefs1/',
    type: "GET",
    data: {
    _token: "{{ csrf_token() }}",
    marca: fasecoldaMarca,
    clase: fasecoldaClase
    },
    dataType: "json",
    success: function (data) {
    $('#name').val(fasecoldaMarca);
    if (data) {
    $('#ref1').empty();
    $('#ref1').focus;
    $('select[name="ref1"]').append('<option value="">-- Seleccciona Línea --</option>');
    $.each(data, function (key, value) {
    $('select[name="ref1"]').append('<option value="' + key + '">' + value + '</option>');
    });
    } else {
    $('#ref1').empty();
    }
    }
    });
    } else {
    $('#ref1').empty();
    }
    });

    $('#ref1').change(function () {
    var fasecoldaClase = $("#fasecoldaCodeClase").val();
    var fasecoldaMarca = $("#marca").val();
    var fasecoldaRef1 = $(this).val();
    $('#ref2', ).html('<option value="">-- Seleccione --</option>');
    $('#fasecoldaCodeRef3', ).html('<option value="">-- Seleccione --</option>');
    $('#model', ).html('<option value="">-- Seleccione --</option>');

    if (fasecoldaRef1) {
    $.ajax({
    url: '/items/getrefs2/',
    type: "GET",
    data: {
    _token: "{{ csrf_token() }}",
    ref1: fasecoldaRef1,
    marca: fasecoldaMarca,
    clase: fasecoldaClase
    },
    dataType: "json",
    success: function (data) {
    if (data) {
    $('#ref2').empty();
    $('#ref2').focus;
    $('select[name="ref2"]').append('<option value="">-- Seleccciona Referencia --</option>');
    $.each(data, function (key, value) {
    $('select[name="ref2"]').append('<option value="' + key + '">' + value + '</option>');
    });
    } else {
    $('#ref2').empty();
    }
    }
    });
    } else {
    $('#ref2').empty();
    }
    });

    $('#ref2').change(function () {
    var fasecoldaClase = $("#fasecoldaCodeClase").val();
    var fasecoldaMarca = $("#marca").val();
    var fasecoldaRef1 = $("#ref1").val();
    var fasecoldaRef2 = $(this).val();
    $('#fasecoldaCodeRef3', ).html('<option value="">-- Seleccione --</option>');
    $('#model', ).html('<option value="">-- Seleccione --</option>');

    if (fasecoldaRef2) {
    $.ajax({
    url: '/items/getrefs3/',
    type: "GET",
    data: {
    _token: "{{ csrf_token() }}",
    ref1: fasecoldaRef1,
    marca: fasecoldaMarca,
    clase: fasecoldaClase,
    ref2: fasecoldaRef2
    },
    dataType: "json",
    success: function (data) {
    if (data) {
    $('#fasecoldaCodeRef3').empty();
    $('#fasecoldaCodeRef3').focus;
    $('select[name="fasecoldaCodeRef3"]').append('<option value="">-- Seleccciona Cilindraje --</option>');
    $.each(data, function (key, value) {
    $('select[name="fasecoldaCodeRef3"]').append('<option value="' + key + '">' + value + '</option>');
    });
    } else {
    $('#fasecoldaCodeRef3').empty();
    }
    }
    });
    } else {
    $('#fasecoldaCodeRef3').empty();
    }
    });

    $('#fasecoldaCodeRef3').change(function () {
    var fasecoldaRef2 = $("#ref2").val();
    var fasecoldaRef1 = $("#ref1").val();
    var fasecoldaRef3 = $(this).val();
    $('#model', ).html('<option value="">-- Seleccione --</option>');

    if (fasecoldaRef3) {
    $.ajax({
    url: '/items/getcode/',
    type: "GET",
    data: {
    _token: "{{ csrf_token() }}",
    ref1: fasecoldaRef1,
    ref2: fasecoldaRef2,
    ref3: fasecoldaRef3
    },
    dataType: "json",
    success: function (data) {
    if (data) {
    $('#model').empty();
    $('#model').focus;
    $('select[name="model"]').append('<option value="">-- Seleccciona Modelo --</option>');
    $.each(data, function (key, value) {
    $('select[name="model"]').append('<option value="' + key + '">' + value + '</option>');
    });
    } else {
    $('#model').empty();
    }
    }
    });
    } else {
    $('#model').empty();
    }
    });

    $('#model').change(function () {
    var fasecoldaRef1 = $("#ref1").val();
    var fasecoldaRef2 = $("#ref2").val();
    var fasecoldaRef3 = $("#fasecoldaCodeRef3").val();
    var fasecoldaModel = $(this).val();
    if (fasecoldaModel) {
    $.ajax({
    url: '/items/getprice/',
    type: "GET",
    data: {
    _token: "{{ csrf_token() }}",
    ref1: fasecoldaRef1,
    ref2: fasecoldaRef2,
    ref3: fasecoldaRef3,
    model: fasecoldaModel
    },
    dataType: "json",
    success: function (data) {
    if (data) {
    $('#current_price').empty();
    $('#current_price').focus;
    $('#current_price').val(data);
    }
    }
    });
    } else {
    $('#current_price').empty();
    }
    });
</script>
