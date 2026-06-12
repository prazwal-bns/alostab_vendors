const site_url = window.location.origin + "/";

function liveProductSearch(inputSelector, resultsSelector) {
    $("body").on("keyup", inputSelector, function () {
        const text = $(inputSelector).val();

        if (text.length > 0) {
            $.ajax({
                data: { search: text },
                url: site_url + "search-product",
                method: "post",
                beforeSend: function (request) {
                    return request.setRequestHeader(
                        "X-CSRF-TOKEN",
                        $('meta[name="csrf-token"]').attr("content")
                    );
                },
                success: function (result) {
                    $(resultsSelector).html(result);
                },
            });
        }

        if (text.length < 1) {
            $(resultsSelector).html("");
        }
    });
}

liveProductSearch("#search", "#searchProducts");
liveProductSearch("#mobile-search", "#mobileSearchProducts");