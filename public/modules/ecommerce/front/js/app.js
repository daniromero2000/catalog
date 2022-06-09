function addCartWishlist(product, wishlist, mode) {
    if (product && mode == '2') {
        quantity = $('#qty_input' + product).val()
        if (quantity != 0) {
            if ($('input[name="productAttribute"]').val()) {
                var productAttribute = $('input[name="productAttribute"]').val()
                storeItemSingle(product, quantity, productAttribute, 1);
                movetoCart(wishlist);
            } else {
                Swal.fire({
                    title: 'oops!',
                    text: 'Por favor selecciona una talla',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                })
            }
        } else {
            Swal.fire({
                title: 'oops!',
                text: 'Por favor ingresa una cantidad',
                icon: 'warning',
                confirmButtonText: 'Ok'
            })
        }
    }
}

window.onload = (function () {
    $('#carrousel-reset').show();
});

function movetoCart(params) {
    $.ajax({
        url: '/wishlist/' + params,
        type: 'PUT',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { params },
        success: function (response) {
            setTimeout(() => {
                location.reload();
            }, 1500);
        }
    });
}

function addWishlist(id) {
    $.ajax({
        url: '/wishlist',
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: { id },
        success: function (response) {
            if (response == 'login') {
                window.location.href = "/login";
            } else {
                getListWishlist();
                Swal.fire({
                    title: 'Añadido!',
                    text: 'Tú artículo ha sido añadido a la lista de deseos',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            }
        }
    });
}

function getListWishlist() {
    $.ajax({
        url: '/api/getWishlist',
        type: 'GET',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (response) {
            var total = response.length;
            wishlist = '';
             response.forEach(e => {
                // wishlist += '<a href="/cart" class="dropdown-item"> <div class="media"> <img src="' + e.product.cover + '" alt="' + e.product.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.product.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted"><i class="fas fa-dollar-sign"></i> ' + +'</p> </div> </div>  </a> <div class="dropdown-divider"></div>'
                wishlist += '<a href="/cart" class="dropdown-item"> <div class="media"> <img src="/storage/' + e.product.cover + '" alt="' + e.product.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.product.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted">' + '</p> </div> </div>  </a> <div class="dropdown-divider"></div>'
            });

            if (total > 0) {
                $('#wishlistContainer').show();
            }

            wishlist = wishlist != '' ? wishlist += '<a href="/cart" class="dropdown-item"> <div class="media"> <div class="media-body d-flex justify-content-between px-4 py-2">  </div> </div>  </a> <div class="dropdown-divider"></div> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/accounts" class="btn button-reset d-block">Ir a mi lista de deseos</a> </div> </div>' : '<a href="#" class="dropdown-item dropdown-footer">Tu lista está vacía </a> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/" class="btn button-reset d-block">Añadir productos a tu lista de deseos</a> </div> </div>';

            $('#totalWishlist').html(total);
            $('#wishlistItems').html(wishlist);

        }
    });
}

/**
 * Permite cambiar de estado la estrella del rating o prodoctReview
 * @param  {} // none
 * @return  {} // execute function
 * Author Jhon Pizarro
 */
function productReviews() {
    $(".btnrating").on('click', (function (e) {
        let previous_value = $("#selected_rating").val()
        let selected_value = $(this).attr("data-attr")
        $("#selected_rating").val(selected_value)
        $(".selected-rating").empty()
        $(".selected-rating").html(selected_value)
        if (selected_value == 1 && previous_value == 1) {
            $("#rating-star-1").toggleClass('btn-warning')
            $("#rating-star-1").toggleClass('btn-default')
            $(".selected-rating").html('0')
            $("#selected_rating").val(0)
            $("#comment").val('')
            if ($('#createProductReview').length > 0) {
                $('#createProductReview').prop('disabled', true)
            }
            if ($('#upDateProductReview').length > 0) {
                $('#upDateProductReview').prop('disabled', true)
            }
        }
        else {
            for (i = 1; i <= selected_value; ++i) {
                $("#rating-star-" + i).toggleClass('btn-warning')
                $("#rating-star-" + i).toggleClass('btn-default')
            }
            for (ix = 1; ix <= previous_value; ++ix) {
                $("#rating-star-" + ix).toggleClass('btn-warning')
                $("#rating-star-" + ix).toggleClass('btn-default')
            }
            if ($('#createProductReview').length > 0) {
                $('#createProductReview').prop('disabled', false)
            }
            if ($('#upDateProductReview').length > 0) {
                $('#upDateProductReview').prop('disabled', false)
            }
        }
    }));
}
/**
 * Valida si el usuario esta logueado sino lo redirije al login
 * @param  {} //
 * @return  {} //
 * Author Jhon Pizarro
 */
function triguerProductReviewModal() {
    let valid = $('.product .valid');
    if (valid.length == 0) {
        $("#triggerProductReviewModal").on('click', (function (e) {
            window.location.href = "/login"
        }))
    }
}
/**
 * Envia el voto a la base de datos
 * @param  {} //
 * @return  {} //
 * Author Jhon Pizarro
 */
function searchProductReview() {
    let valid = $('.product .valid');
    if (valid.length > 0) {
        let product_id = $("#product_id").val()
        $.ajax({
            type: 'get',
            url: '/product-reviews/search/' + product_id,
            data: {
                product_id: product_id
            },
            success: function (response) {
                if (response.data != null) {
                    for (i = 1; i <= response.data.rating; ++i) {
                        $("#rating-star-" + i).addClass('btn-warning')
                        $("#rating-star-" + i).removeClass('btn-default')
                    }
                    $(".selected-rating").html(response.data.rating)
                    $("#selected_rating").val(response.data.rating)
                    $("#comment").val(response.data.comment)
                    $('#createProductReview').after('<button type="button" id="upDateProductReview" disabled class="btn button-reset" data-dismiss="modal">Actualizar Calificaci&oacute;n</button>')
                    $('#createProductReview').remove()
                    $('.valid').attr('data-attr', response.data.id)
                    upDateProductReview()
                }
            },
            error: function (response) {
            }
        })
    }
}
/**
 * Envia el voto a la base de datos
 * @param  {} //
 * @return  {} //
 * Author Jhon Pizarro
 */
function createProductReview() {
    $("#createProductReview").on('click', (function (e) {
        let product_id = $("#product_id").val()
        let name = $("#name").val()
        let title = $("#title").val()
        let rating = parseInt($('#selected_rating').val())
        let comment = $("#comment").val()
        let status = $("#status").val()
        let _token = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            type: 'post',
            url: '/product-reviews/store',
            data: {
                product_id: product_id,
                name: name,
                title: title,
                rating: rating,
                comment: comment,
                status: status,
                _token: _token
            },
            success: function (response) {
                if (response == 'login') {
                    window.location.href = "/login"
                }
                else {
                    Swal.fire({
                        title: 'Muchas gracias!',
                        text: 'Calificaste este Producto. Tu opinion es muy importante para nosotros.',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                }
            }
        })

    }));
}
/**
 * Actualiza el voyo y el comentario del producto realizado por el customer
 * @param  {} //
 * @return  {} //
 * Author Jhon Pizarro
 */
function upDateProductReview() {
    $("#upDateProductReview").on('click', (function (e) {
        let product_id = $("#product_id").val()
        let review_id = $('.valid').attr("data-attr")
        let name = $("#name").val()
        let title = $("#title").val()
        let rating = parseInt($('#selected_rating').val())
        let comment = $("#comment").val()
        let status = $("#status").val()
        let _token = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            type: 'post',
            url: '/product-reviews/update/' + review_id,
            data: {
                product_id: product_id,
                name: name,
                title: title,
                rating: rating,
                comment: comment,
                status: status,
                _token: _token
            },
            success: function (response) {
                if (response == 'login') {
                    window.location.href = "/login"
                }
                else {
                    Swal.fire({
                        title: 'Muchas gracias!',
                        text: 'Actualizaste tu comentario en este Producto. Tu opinion es muy importante para nosotros.',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                }
            }
        })
    }));
}
/**
 * Resetea el formulario si el customer decide no botar.
 * @param  {} //
 * @return  {} //
 * Author Jhon Pizarro
 */
function cancelReview() {
    $("#cancelReview").on('click', (function (e) {
        if ($(".btnrating").hasClass("btn-warning")) {
            $(".btnrating").removeClass('btn-warning')
            $(".btnrating").addClass('btn-default')
        }
        $(".selected-rating").html('0')
        $("#selected_rating").val(0)
        $("#comment").val('')
    }));
}
/**
 *
 * @param  {} //
 * @return  {} //
 * Author Jhon Pizarro
 */
function promedioRating() {
    let valid = $('.product');
    if (valid.length > 0) {
        let promedioRating = $('#promedioRating').html()
        promedioRating = parseFloat(promedioRating)
        for (i = 1; i <= promedioRating; ++i) {
            $("#rating-review-" + i).addClass('fas').removeClass('far')
        }
    }
}

function showRatingPorcents() {
    if ($(window).width() < 769) {
        $('#ratingContainer').removeClass('justify-content-cent').addClass('flex-wrap')
        $('#porcentByRating').addClass('mt-3')
    }
    let valid = $('.product');
    if (valid.length > 0) {
        $("#moreInfo").on('click', (function () {
            $('#porcentByRating').show('slow').fadeTo("slow", 1)
        }))
        $(".close").on('click', (function () {
            $('#porcentByRating').fadeTo("slow", 0).hide('slow')
        }))
    }

}
/******************************************************** */
/******************************************************** */
/******************************************************** */
/**
 * Execute function on document ready
 */
jQuery(document).ready(function ($) {
    productReviews();
    searchProductReview();
    triguerProductReviewModal();
    createProductReview();
    cancelReview();
    promedioRating();
    getListWishlist();
    showRatingPorcents();
});
