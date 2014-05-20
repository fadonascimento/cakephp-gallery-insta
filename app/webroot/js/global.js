window.INSTAGRAN = window.INSTAGRAN || {};
(function($) {
    INSTAGRAN.App = function() {

        bind = function() {

            var height = $(window).height();
            var width = $(window).width();
            var larguraImagens = 200;
            var AlturaImagens = 200;

            console.log(height);
            console.log(width);

        };

        return {

            init: function() {
                bind();
            }
        };
    };
}(jQuery));
$(document).ready(function() {
    init = new INSTAGRAN.App();
    init.init();
});