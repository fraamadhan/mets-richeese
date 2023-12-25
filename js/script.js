function showAllMenu() {
  $.getJSON("data/menu.json", function (data) {
    let menu = data.menu;
    $("#menuItems").empty()
    $.each(menu, function (idx, data) {
      $("#menuItems").append(
        ' <div class="col-lg-4 d-flex flex-column menuItem"><div class="card mb-3 flex-fill"> <img src="img/menu/' +
          data.image +
          ' " class="card-img-top" alt="alacarte beef"><div class="card-body"><h5 class="card-title">' +
          data.menuName +
          '</h5><p class="card-text">' +
          data.description +
          '</p><h5 class="card-title">' +
          rupiah(data.price) +
          '</h5><a href="#" class="btn btn-primary mt-3">Order now</a></div></div></div>'
      );
    });
  });
}

showAllMenu()

$(".nav-link").on("click", function () {
  $(".nav-link").removeClass("active");
  $(this).addClass("active");

  let category = $(this).html();
  $("#title-menu").html(category);

  if (category == "All Menu") {
    showAllMenu()
    return
  }

  $.getJSON("data/menu.json", function (data) {
    let menu = data.menu;
    let content = "";
    $.each(menu, function (idx, data) {
      if (data.menuType === category) {
        content +=
          '<div class="col-lg-4 d-flex flex-column menuItem"><div class="card mb-3 flex-fill"> <img src="img/menu/' +
          data.image +
          ' " class="card-img-top" alt="alacarte beef"><div class="card-body"><h5 class="card-title">' +
          data.menuName +
          '</h5><p class="card-text">' +
          data.description +
          '</p><h5 class="card-title">' +
          rupiah(data.price) +
          '</h5><a href="#" class="btn btn-primary mt-3">Order now</a></div></div></div>';
      }
    });

    $("#menuItems").html(content);
  });
});

const rupiah = (number) => {
  return new Intl.NumberFormat("id-ID", {
    style: "currency",
    currency: "IDR",
  }).format(number);
};
