$.fn.homeIndex = function () {
    const $this = this;

    this.init = function () {
        $this.fetchData();
    };

    this.fetchData = function () {
        Swal.showLoading()

        const params = {
            username: "max",
            email: "max@example.com"
        };

        ajax.post($d.getBaseUrl('home/load'), params).done(function (data) {
            Swal.hideLoading();

            Notify.fire({
                type: 'success',
                title: data.message,
            });

            // render template
            const html = $d.template($('#user-template').html(), data);
            $this.html(html);

        }).fail(function (xhr) {
            Swal.hideLoading();
            ajax.handleError(xhr);
        });
    };

    this.init();
};

$(function () {
    $('#app').homeIndex();
});

