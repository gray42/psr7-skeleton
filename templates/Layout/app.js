let app = {};

//var VueGettext = {};
//VueGettext.install = function (Vue, options) {
    // 1. add global method or property
    // Vue.prototype.__ = __;
//};

const Notify = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false,
    showCancelButton: false,
    timer: 3000,
});

/**
 * Fix for open modal is shifting body content to the left #9855
 */
//if ($.fn.modal) {
    // Boostrap 4.x
    //$.fn.modal.Constructor.prototype._setScrollbar = function () {};
//}