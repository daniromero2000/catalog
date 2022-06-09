<script>
    // PawnShop Items
    // ============================================================

    function backToInfoTab() {
    $('#tablist > li:first-child').addClass('active');
    $('#tablist > li:last-child').removeClass('active');

    $('#tabcontent > div:first-child').addClass('active');
    $('#tabcontent > div:last-child').removeClass('active');
    }
    $(document).ready(function () {
    const checkbox = $('input.attribute');
    $(checkbox).on('change', function () {
    const attributeId = $(this).val();
    if ($(this).is(':checked')) {
    $('#attributeValue' + attributeId).attr('disabled', false);
    } else {
    $('#attributeValue' + attributeId).attr('disabled', true);
    }
    const count = checkbox.filter(':checked').length;
    if (count > 0) {
    $('#productAttributeQuantity').attr('disabled', false);
    $('#productAttributePrice').attr('disabled', false);
    $('#salePrice').attr('disabled', false);
    $('#default').attr('disabled', false);
    $('#createCombinationBtn').attr('disabled', false);
    $('#combination').attr('disabled', false);
    } else {
    $('#productAttributeQuantity').attr('disabled', true);
    $('#productAttributePrice').attr('disabled', true);
    $('#salePrice').attr('disabled', true);
    $('#default').attr('disabled', true);
    $('#createCombinationBtn').attr('disabled', true);
    $('#combination').attr('disabled', true);
    }
    });
    });

    $(document).ready(function () {

    if ($('#thumbnails li img').length > 0) {
    $('#thumbnails li img').on('click', function () {
    $('#main-image')
    .attr('src', $(this).attr('src') + '?w=400')
    .attr('data-zoom', $(this).attr('src') + '?w=1200');
    });
    }
    });

    $("#item_category_id").change(function () {
    if ($(this).val() == "1") {
    $('#jewelry_quality_id1').show();
    $('#weight').show();
    $('#jewelryPrice01').show();
    $('#otherField').attr('required', '');
    $('#otherField').attr('data-error', 'This field is required.');
    $("#marca").prop('required', false);
    $("#ref1").prop('required', false);
    $("#ref2").prop('required', false);
    $("#fasecoldaCodeRef3").prop('required', false);
    $("#model").prop('required', false);
    } else {
    $('#jewelry_quality_id1').hide();
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
    $('#jewelryPrice01').hide();
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
    url: '/admin/autoevaluador/getmarcs',
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
    url: '/admin/autoevaluador/getrefs1/',
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
    url: '/admin/autoevaluador/getrefs2/',
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
    url: '/admin/autoevaluador/getrefs3/',
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
    url: '/admin/autoevaluador/getcode/',
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
    url: '/admin/autoevaluador/getprice/',
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
    $('#jewelry_quality_id').append('<option selected="selected" value="whatever">Seleccione Calidad</option>');
    $('#jewelry_quality_id').change(function () {
    var jewelry_quality_id = $(this).val();
    var weights = $("#weight").val();
    if (jewelry_quality_id) {
    $.ajax({
    url: '/admin/autoevaluador/getjewelryprice',
    type: "GET",
    data: {
    _token: "{{ csrf_token() }}",
    quality: jewelry_quality_id,
    weight: weights
    },
    dataType: "json",
    success: function (data) {
    if (data) {
    $('#jewelryPrice1').empty();
    $('#jewelryPrice1').focus;
    $('#jewelryPrice1').val(data);
    }
    }
    });
    } else {
    $('#jewelryPrice1').empty();
    }
    });
</script>
