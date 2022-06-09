"use strict";

function getCart() {
  $.get('/api/getCart?mode=single', function (data) {
    var cart = '';
    var formatter = new Intl.NumberFormat('es-CO', {
      style: 'currency',
      currency: 'COP',
      minimumFractionDigits: 0
    });
    data.cartItems.forEach(function (e) {
      cart += '<a href="/cart" class="dropdown-item"> <div class="media"> <img src="' + e.cover + '" alt="' + e.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted"><i class="fas fa-dollar-sign"></i> ' + e.price + ' x ' + e.qty + '</p> </div> </div>  </a> <div class="dropdown-divider"></div>';
      $('#' + e.id).html(formatter.format(e.price * e.qty));
    });
    var total = data.cartItems.length;

    if (total > 0) {
      $('#items').show();
    }

    data.subtotal = formatter.format(data.subtotal);
    data.tax = formatter.format(data.tax);
    data.total = formatter.format(data.total);
    cart = cart != '' ? cart += '<a href="/cart" class="dropdown-item"> <div class="media"> <div class="media-body d-flex justify-content-between px-4 py-2"> <p class="text-sm subtotal">Subtotal</p> <p class="text-sm text-muted price">' + data.subtotal + '</p> </div> </div>  </a> <div class="dropdown-divider"></div> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/cart" class="btn button-reset d-block">Ir al carrito</a> </div> </div>' : '<a href="#" class="dropdown-item dropdown-footer">Tu carrito está vacío </a> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/cart" class="btn button-reset d-block">Ir al carrito</a> </div> </div>';
    $('#subtotalCart').html(data.subtotal);
    $('#taxesCart').html(data.tax);
    $('#totalCart').html(data.total);
    $('#cartItems').html(cart);
    $('#total').html(total);
  });
}

getCart();

function addCart(product, mode) {
  if (product && mode == '1') {
    quantity = $('input[name="quantity"]').val();
    atribute = $('#productAttribute').val();

    if (quantity != 0) {
      if ($('#productAttribute').val()) {
        var productAttribute = $('#productAttribute').val();
        storeItemSingle(product, quantity, productAttribute, 1);
      } else {
        Swal.fire({
          title: 'Oops!',
          text: 'Por favor selecciona una talla',
          icon: 'warning',
          confirmButtonText: 'Ok'
        });
      }
    } else {
      Swal.fire({
        title: 'Oops!',
        text: 'Por favor ingresa una cantidad',
        icon: 'warning',
        confirmButtonText: 'Ok'
      });
    }
  }

  if (product && mode == '2') {
    quantity = $('#qty_input' + product).val();

    if (quantity != 0) {
      if ($('input[name="productAttribute"]').val()) {
        var productAttribute = $('input[name="productAttribute"]').val();
        storeItemSingle(product, quantity, productAttribute, 1);
      } else {
        Swal.fire({
          title: 'oops!',
          text: 'Por favor selecciona una talla',
          icon: 'warning',
          confirmButtonText: 'Ok'
        });
      }
    } else {
      Swal.fire({
        title: 'oops!',
        text: 'Por favor ingresa una cantidad',
        icon: 'warning',
        confirmButtonText: 'Ok'
      });
    }
  }
}

function addCartWishlist(product, wishlist, mode) {
  if (product && mode == '2') {
    quantity = $('#qty_input' + product).val();

    if (quantity != 0) {
      if ($('input[name="productAttribute"]').val()) {
        var productAttribute = $('input[name="productAttribute"]').val();
        storeItemSingle(product, quantity, productAttribute, 1);
        movetoCart(wishlist);
      } else {
        Swal.fire({
          title: 'oops!',
          text: 'Por favor selecciona una talla',
          icon: 'warning',
          confirmButtonText: 'Ok'
        });
      }
    } else {
      Swal.fire({
        title: 'oops!',
        text: 'Por favor ingresa una cantidad',
        icon: 'warning',
        confirmButtonText: 'Ok'
      });
    }
  }
}

function movetoCart(params) {
  $.ajax({
    url: '/wishlist/' + params,
    type: 'PUT',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      params: params
    },
    success: function success(response) {
      setTimeout(function () {
        location.reload();
      }, 1500);
    }
  });
}

function addWishlist(id) {
  $.ajax({
    url: '/wishlist',
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      id: id
    },
    success: function success(response) {
      if (response == 'login') {
        window.location.href = "/login";
      } else {
        getListWishlist();
        Swal.fire({
          title: 'Añadido!',
          text: 'Tú artículo ha sido añadido a la lista de deseos',
          icon: 'success',
          confirmButtonText: 'Ok'
        });
      }
    }
  });
}

function getListWishlist() {
  $.ajax({
    url: '/api/getWishlist',
    type: 'GET',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(response) {
      var total = response.length;
      wishlist = '';
      response.forEach(function (e) {
        // wishlist += '<a href="/cart" class="dropdown-item"> <div class="media"> <img src="' + e.product.cover + '" alt="' + e.product.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.product.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted"><i class="fas fa-dollar-sign"></i> ' + +'</p> </div> </div>  </a> <div class="dropdown-divider"></div>'
        wishlist += '<a href="/cart" class="dropdown-item"> <div class="media"> <img src="' + e.product.cover + '" alt="' + e.product.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.product.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted">' + '</p> </div> </div>  </a> <div class="dropdown-divider"></div>';
      });

      if (total > 0) {
        $('#wishlistContainer').show();
      }

      wishlist = wishlist != '' ? wishlist += '<a href="/cart" class="dropdown-item"> <div class="media"> <div class="media-body d-flex justify-content-between px-4 py-2"> <p class="text-sm subtotal">Subtotal</p> <p class="text-sm text-muted price"></p> </div> </div>  </a> <div class="dropdown-divider"></div> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/accounts" class="btn button-reset d-block">Ir a mi lista de deseos</a> </div> </div>' : '<a href="#" class="dropdown-item dropdown-footer">Tu lista está vacía </a> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/" class="btn button-reset d-block">Añadir productos a tu lista de deseos</a> </div> </div>';
      $('#totalWishlist').html(total);
      $('#wishlistItems').html(wishlist);
    }
  });
}

getListWishlist();

function storeItemAtribute(product, quantity, productAttribute, link) {
  $.ajax({
    url: '/cart',
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      product: product,
      quantity: quantity,
      productAttribute: productAttribute
    },
    success: function success(response) {
      getCart();
      Swal.fire({
        title: 'Añadido!',
        text: 'Tú artículo ha sido añadido al carrito',
        icon: 'success',
        confirmButtonText: 'Ok'
      });

      if (link == 1) {
        $('#productModal' + product).modal('hide');
        $('html, body').animate({
          scrollTop: $("#cart").offset().top
        }, 1000);
        $('#cartItems').addClass('show');
        $('#cart').addClass('show');
        $("#cart .nav-link ").attr("aria-expanded", "true");
      }
    }
  });
}

function storeItemSingle(product, quantity, productAttribute, link) {
  var dataProduct = {};

  if (productAttribute) {
    dataProduct = {
      product: product,
      quantity: quantity,
      productAttribute: productAttribute
    };
  } else {
    dataProduct = {
      product: product,
      quantity: quantity
    };
  }

  $.ajax({
    url: '/cart',
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: dataProduct,
    success: function success(response) {
      getCart();
      Swal.fire({
        title: 'Añadido!',
        text: 'Tú artículo ha sido añadido al carrito',
        icon: 'success',
        confirmButtonText: 'Ok'
      });
      $('input[name="productAttribute"]').val('');
      var buttons = [document.getElementById("sizes" + productAttribute)];

      for (var j = 0; j < buttons.length; j++) {
        var res = document.getElementsByClassName("sizes active");

        if (res.length > 0) {
          res[0].className = res[0].className.replace(" active", "");
        }

        this.className += " active";
      }

      if (link == 1) {
        $('#productModal' + product).modal('hide');
        $('html, body').animate({
          scrollTop: $("#cart").offset().top
        }, 1000);
        $('#cartItems').addClass('show');
        $('#cart').addClass('show');
        $("#cart .nav-link ").attr("aria-expanded", "true");
      }
    }
  });
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

function minus(dataId) {
  $('#qty_input' + dataId).val(parseInt($('#qty_input' + dataId).val()) - 1);

  if ($('#qty_input' + dataId).val() == 0) {
    $('#qty_input' + dataId).val(1);
  }

  $('#qty_input_real' + dataId).val(parseInt($('#qty_input_real' + dataId).val()) - 1);

  if ($('#qty_input_real' + dataId).val() == 0) {
    $('#qty_input_real' + dataId).val(1);
  }

  quantity = $('#qty_input_real' + dataId).val();
  rowId = $('#row' + dataId).val();
  ;
  updatedItem(rowId, quantity);
}

function max(dataId) {
  $('#qty_input' + dataId).val(parseInt($('#qty_input' + dataId).val()) + 1);
  $('#qty_input_real' + dataId).val(parseInt($('#qty_input_real' + dataId).val()) + 1);
  quantity = $('#qty_input_real' + dataId).val();
  rowId = $('#row' + dataId).val();
  ;
  updatedItem(rowId, quantity);
}

function updatedItem(row, quantity) {
  $.ajax({
    url: '/cart/' + row,
    type: 'PUT',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      quantity: quantity
    },
    success: function success(response) {
      getCart();
    }
  });
}

function res() {
  $('#qty_input').val(parseInt($('#qty_input').val()) - 1);

  if ($('#qty_input').val() == 0) {
    $('#qty_input').val(1);
  }

  $('#qty_input_real').val(parseInt($('#qty_input_real').val()) - 1);

  if ($('#qty_input_real').val() == 0) {
    $('#qty_input_real').val(1);
  }

  quantity = $('#qty_input_real').val();
  rowId = $('#row').val();
  ;
}

function sum() {
  $('#qty_input').val(parseInt($('#qty_input').val()) + 1);
  $('#qty_input_real').val(parseInt($('#qty_input_real').val()) + 1);
  quantity = $('#qty_input_real').val();
  rowId = $('#row').val();
  ;
}

function resId(id) {
  $('#qty_input' + id).val(parseInt($('#qty_input' + id).val()) - 1);

  if ($('#qty_input' + id).val() == 0) {
    $('#qty_input' + id).val(1);
  }

  $('#qty_input_real' + id).val(parseInt($('#qty_input_real' + id).val()) - 1);

  if ($('#qty_input_real' + id).val() == 0) {
    $('#qty_input_real' + id).val(1);
  }

  quantity = $('#qty_input_real' + id).val();
  rowId = $('#row' + id).val();
  ;
}

function sumId(id) {
  $('#qty_input' + id).val(parseInt($('#qty_input' + id).val()) + 1);
  $('#qty_input_real' + id).val(parseInt($('#qty_input_real' + id).val()) + 1);
  quantity = $('#qty_input_real' + id).val();
  rowId = $('#row' + id).val();
  ;
}

function addValue(id) {
  // var product = $('#productId' + id).val()
  var buttons = "";
  $('input[name="productAttribute"]').val(id);
  buttons = document.getElementById("sizes" + id);
  buttons.addEventListener("click", function () {
    var res = "";
    res = document.getElementsByClassName("sizes active");

    if (res.length > 0) {
      res[0].className = res[0].className.replace(" active", "");
    }

    this.className += " active";
  });
} // Add active class to the current button (highlight it)
// var header = document.getElementById("sizes");
// var btns = header.getElementsByClassName("sizes");
// for (var i = 0; i < btns.length; i++) {
//     btns[i].addEventListener("click", function () {
//         var current = document.getElementsByClassName("sizes active");
//         if (current.length > 0) {
//             current[0].className = current[0].className.replace(" active", "");
//         }
//         this.className += " active";
//     });
// }