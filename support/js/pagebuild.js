// Intercept the menu link clicks

//Anvil Page
$("#pageNav").on("click", "#anvils", function (evt) {
    evt.preventDefault();

    $.getJSON("js/acme.json", function (JSON) {
        var items = [];
        $.each(JSON, function (key, val) {

            if (val.anvilsLink === 1) {
                $("#pageTitle").text(val.name);
                $("#homeContent").text('');
                $("#productTitle").text(val.name);
                $("#image").html("<img src='" + val.path + "' alt='anvil'>");
                $("#description").text(val.description);
                $("#manufacturer").html("<b> Made by: </b>" + val.manufacturer);
                $("#price").html("<b> Price: $" + val.price + "</b>");
                $("#reviews").html("<b> Reviews: </b>" + val.reviews);

                console.log(key);
                console.log(val);
            }
        });
    });
});


//Explosives Page
$("#pageNav").on("click", "#explosives", function (evt) {
    evt.preventDefault();

    $.getJSON("js/acme.json", function (JSON) {
        var items = [];
        $.each(JSON, function (key, val) {

            if (val.anvilsLink === 2) {
                $("#pageTitle").text(val.name);
                $("#homeContent").text('');
                $("#productTitle").text(val.name);
                $("#image").html("<img src='" + val.path + "' alt='explosives'>");
                $("#description").text(val.description);
                $("#manufacturer").html("<b> Made by: </b>" + val.manufacturer);
                $("#price").html("<b> Price: $" + val.price + "</b>");
                $("#reviews").html("<b> Reviews: </b>" + val.reviews);

                console.log(key);
                console.log(val);
            }

        });
    });
});

//Decoys Page
$("#pageNav").on("click", "#decoys", function (evt) {
    evt.preventDefault();

    $.getJSON("js/acme.json", function (JSON) {
        var items = [];
        $.each(JSON, function (key, val) {

            if (val.anvilsLink === 3) {
                $("#pageTitle").text(val.name);
                $("#homeContent").text('');
                $("#productTitle").text(val.name);
                $("#image").html("<img src='" + val.path + "' alt='decoys'>");
                $("#description").text(val.description);
                $("#manufacturer").html("<b> Made by: </b>" + val.manufacturer);
                $("#price").html("<b> Price: $" + val.price + "</b>");
                $("#reviews").html("<b> Reviews: </b>" + val.reviews);

                console.log(key);
                console.log(val);
            }

        });
    });
});

//Traps Page
$("#pageNav").on("click", "#traps", function (evt) {
    evt.preventDefault();

    $.getJSON("js/acme.json", function (JSON) {
        var items = [];
        $.each(JSON, function (key, val) {

            if (val.anvilsLink === 4) {
                $("#pageTitle").text(val.name);
                $("#homeContent").text('');
                $("#productTitle").text(val.name);

                $("#image").html('<img src="' + val.path + '" alt="traps">');
                $("#description").text(val.description);
                $("#manufacturer").html("<b> Made by: </b>" + val.manufacturer);
                $("#price").html("<b> Price: $" + val.price + "</b>");
                $("#reviews").html("<b> Reviews: </b>" + val.reviews);

                console.log(key);
                console.log(val);
            }
        });
    });
});
