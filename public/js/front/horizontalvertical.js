$(document).ready(function () { horVerSlider.init(), detectDevice.isMobile && $("body").addClass("mobile") }), detectDevice = { isMobile: !1, init: function () { return (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) && (detectDevice.isMobile = !0), detectDevice.isMobile } }, horVerSlider = { HWidth: 600, HHeight: 600, ZHWidth: 800, ZHHeight: 550, HElement: $("#horizon-slider"), HElementCount: "", HElemIndex: 0, HMouseDown: !1, HMouseUp: !1, HMouseMove: !1, HToughDown: !1, HMovement: 0, HOldX: 0, HtoughedAt: 0, VWidth: 100, VHeight: 130, VElement: $("#vertical-slider"), VElementCount: "", VElemIndex: 0, VElementOldIndex: 0, VMouseDown: !1, VToughDown: !1, VMovement: 0, HOldY: 0, VtoughedAt: 0, ZoomeLevel: 1, dotsHTML: "", winWidth: "", winHeight: "", horVerSlider: "", _mousemove: !1, _dragging: !1, _mousedown: !1, init: function () { horVerSlider.setSlider(), horVerSlider.HNav(), horVerSlider.verticalClick(), horVerSlider.dotClick(), horVerSlider.lazyLoad(), horVerSlider.lightBox(), horVerSlider.lightBoxZoom(), horVerSlider.playVideo(), horVerSlider.playThumbVideo(), horVerSlider.disabledNav(0), horVerSlider.HtoughMove() }, HNav: function () { $(".horizone-nav .next").on("click", function () { horVerSlider.ZoomeLevel = 1, horVerSlider.HElement.addClass("zoomin").removeClass("zoomout"), horVerSlider.addRemoveZoomCls(horVerSlider.ZoomeLevel), horVerSlider.HElement.find("li").css({ width: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: 0, top: 0 }), horVerSlider.HElement.find("ul").css({ width: horVerSlider.zoomedWidth * horVerSlider.HElementCount * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: -horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel * horVerSlider.HElemIndex, top: 0 }), horVerSlider.HMovement != -(horVerSlider.HElementCount - 1) * horVerSlider.HWidth && ($(".horVerSlider").hasClass("fullscreen"), horVerSlider.HWidth = $("#horizon-slider").width(), horVerSlider.HMovement = -horVerSlider.HWidth * horVerSlider.VElemIndex, horVerSlider.HMovement -= horVerSlider.HWidth, horVerSlider.moveLeft(), horVerSlider.VElemIndex += 1, horVerSlider.HElemIndex += 1), horVerSlider.handleVertElm(horVerSlider.VElemIndex), horVerSlider.disabledNav(horVerSlider.VElemIndex) }), $(".horizone-nav .prev").on("click", function () { horVerSlider.ZoomeLevel = 1, horVerSlider.HElement.addClass("zoomin").removeClass("zoomout"), horVerSlider.addRemoveZoomCls(horVerSlider.ZoomeLevel), horVerSlider.HElement.find("li").css({ width: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: 0, top: 0 }), horVerSlider.HElement.find("ul").css({ width: horVerSlider.zoomedWidth * horVerSlider.HElementCount * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: -horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel * horVerSlider.HElemIndex, top: 0 }), 0 != horVerSlider.HMovement && (horVerSlider.HWidth = $("#horizon-slider").width(), horVerSlider.HMovement = -horVerSlider.HWidth * horVerSlider.VElemIndex, horVerSlider.HMovement += horVerSlider.HWidth, horVerSlider.moveRight(), horVerSlider.VElemIndex -= 1, horVerSlider.HElemIndex -= 1), horVerSlider.handleVertElm(horVerSlider.VElemIndex), horVerSlider.disabledNav(horVerSlider.VElemIndex) }) }, handleVertElm: function (e) { $(horVerSlider.VElement).find("li").removeClass("active"), $(horVerSlider.VElement).find("li:eq(" + e + ")").addClass("active"), $(".dotwrap > div").removeClass("active"), $(".dotwrap > div:eq(" + e + ")").addClass("active"), horVerSlider.VMovement = -e * horVerSlider.VHeight, e < horVerSlider.VElementCount - 3 && $(horVerSlider.VElement).find("ul").animate({ top: horVerSlider.VMovement }, 500) }, moveLeft: function () { $(horVerSlider.HElement).find("ul").animate({ left: horVerSlider.HMovement }, 500) }, moveRight: function () { $(horVerSlider.HElement).find("ul").animate({ left: horVerSlider.HMovement }, 500) }, moveDown: function () { $(horVerSlider.VElement).find("ul").animate({ top: horVerSlider.VMovement }, 500) }, moveUp: function () { $(horVerSlider.VElement).find("ul").animate({ top: horVerSlider.VMovement }, 500) }, verticalsSliding: function (e, r) { e > 3 ? (horVerSlider.VMovement = -(e - 3) * horVerSlider.VHeight, $(horVerSlider.VElement).find("ul").animate({ top: horVerSlider.VMovement }, 500)) : e < 2 && 0 != e && r > e ? (horVerSlider.VMovement = (e - 1) * horVerSlider.VHeight, $(horVerSlider.VElement).find("ul").animate({ top: horVerSlider.VMovement }, 500)) : 0 == e || 2 == e ? $(horVerSlider.VElement).find("ul").animate({ top: 0 }, 500) : 3 == e && (horVerSlider.VMovement = -(e - 2) * horVerSlider.VHeight, $(horVerSlider.VElement).find("ul").animate({ top: horVerSlider.VMovement }, 500)) }, verticalClick: function () { horVerSlider.VElement.find("li").on("click", function () { horVerSlider.ZoomeLevel = 1, horVerSlider.HElement.addClass("zoomin").removeClass("zoomout").removeClass("zoomenable"), horVerSlider.addRemoveZoomCls(horVerSlider.ZoomeLevel), horVerSlider.HElement.find("li").css({ width: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: 0, top: 0 }), horVerSlider.HElement.find("ul").css({ width: horVerSlider.zoomedWidth * horVerSlider.HElementCount * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: -horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel * horVerSlider.HElemIndex, top: 0 }), $(this).hasClass("video") ? horVerSlider.HWidth = horVerSlider.getZoomWidth() : horVerSlider.HWidth = $("#horizon-slider").width(), console.log(horVerSlider.HWidth), horVerSlider.VElemIndex = $(this).index(), horVerSlider.HElemIndex = $(this).index(), horVerSlider.HMovement = -horVerSlider.HElemIndex * horVerSlider.HWidth, horVerSlider.VElement.find("li").removeClass("active"), $(this).addClass("active"), $(".dotwrap > div").removeClass("active"), $(".dotwrap > div:eq(" + horVerSlider.VElemIndex + ")").addClass("active"), $(horVerSlider.HElement).find("ul").animate({ left: horVerSlider.HMovement }, 500), horVerSlider.disabledNav(horVerSlider.VElemIndex), setTimeout(function () { horVerSlider.HElement.addClass("zoomenable") }, 600), horVerSlider.verticalsSliding(horVerSlider.VElemIndex, horVerSlider.VElementOldIndex), horVerSlider.VElementOldIndex = horVerSlider.VElemIndex }) }, dotClick: function () { }, setSlider: function () { for (horVerSlider.HElementCount = horVerSlider.HElement.find("ul li").length, horVerSlider.HElement.find("ul").css({ width: horVerSlider.HElementCount * horVerSlider.HWidth }), horVerSlider.VElementCount = horVerSlider.VElement.find("ul li").length, horVerSlider.VElement.find("ul").css({ height: horVerSlider.VElementCount * horVerSlider.VHeight }), $(horVerSlider.VElement).find("li").removeClass("active"), $(horVerSlider.VElement).find("li:eq(" + horVerSlider.HElemIndex + ")").addClass("active"), i = 0; i < horVerSlider.HElementCount; i++)0 == i ? horVerSlider.dotsHTML += "<div class='active'></div>" : horVerSlider.dotsHTML += "<div></div>"; $(".dots .dotwrap").append(horVerSlider.dotsHTML) }, lazyLoad: function () { horVerSlider.HElement.find("li").each(function () { var e = $(this).data("image"); $(this).hasClass("video"), $(this).css({ backgroundImage: "url(" + e + ")", "background-size": "contain" }) }), horVerSlider.VElement.find("li").each(function () { var e = $(this).data("image"); $(this).css({ backgroundImage: "url(" + e + ")" }) }) }, getZoomWidth: function () { }, HtoughMove: function () { }, lightBox: function () { }, addRemoveZoomCls: function (e) { }, lightBoxZoom: function () { }, zoomedMove: function () { }, playVideo: function () { $("#horizon-slider li.video").on("click", function (e) { $(this).closest(".horVerSlider").addClass("fullscreen"), $("body").addClass("pdppopopen"), $("html").css("overflow", "hidden"); var r = "<iframe width='560' height='315' src='" + $(this).data("pvideo") + "' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"; $(this).empty().html(r).removeClass("playicon"), $(this).css({ backgroundImage: "" }), horVerSlider.ZoomeLevel = 1, horVerSlider.zoomedWidth = horVerSlider.getZoomWidth(), horVerSlider.HElement.find("li").css({ width: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: 0, top: 0 }), horVerSlider.HElement.find("ul").css({ width: horVerSlider.zoomedWidth * horVerSlider.HElementCount * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: -horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel * horVerSlider.HElemIndex, top: 0 }) }), $(".close, .horizone-nav .next, .horizone-nav .prev").on("click", function (e) { $(".video").each(function () { $(this).empty(); var e = $(this).data("image"); $(this).hasClass("video") && $(this).css({ backgroundImage: "url(" + e + ")" }).addClass("playicon") }) }) }, playThumbVideo: function () { $("#vertical-slider li").on("click", function (e) { var r = $(this).index(), o = horVerSlider.HElement.find("li:eq(" + r + ")"); if ($(this).hasClass("video")) { $(".video").each(function () { $(this).empty(); var e = $(this).data("image"); $(this).hasClass("video") && $(this).css({ backgroundImage: "url(" + e + ")" }).addClass("playicon") }), o.closest(".horVerSlider").addClass("fullscreen"), $("body").addClass("pdppopopen"), $("html").css("overflow", "hidden"); var i = "<iframe width='560' height='315' src='" + o.data("pvideo") + "' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"; o.empty().html(i).removeClass("playicon"), o.css({ backgroundImage: "" }), horVerSlider.ZoomeLevel = 1, horVerSlider.zoomedWidth = horVerSlider.getZoomWidth(); var l = horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel * horVerSlider.HElemIndex; horVerSlider.HElement.find("li").css({ width: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: 0, top: 0 }), horVerSlider.HElement.find("ul").css({ width: horVerSlider.zoomedWidth * horVerSlider.HElementCount * horVerSlider.ZoomeLevel, height: horVerSlider.zoomedWidth * horVerSlider.ZoomeLevel, left: -l, top: 0 }) } else $(".video").each(function () { $(this).empty(); var e = $(this).data("image"); $(this).hasClass("video") && $(this).css({ backgroundImage: "url(" + e + ")" }).addClass("playicon") }) }) }, disabledNav: function (e) { horVerSlider.VElementCount = horVerSlider.VElement.find("ul li").length, _elementcount = horVerSlider.VElementCount, 0 == e ? ($(".horizone-nav .prev").css({ display: "none" }), $(".horizone-nav .next").css({ display: "block" })) : e + 1 == _elementcount ? ($(".horizone-nav .next").css({ display: "none" }), $(".horizone-nav .prev").css({ display: "block" })) : ($(".horizone-nav .prev").css({ display: "block" }), $(".horizone-nav .next").css({ display: "block" })) } };