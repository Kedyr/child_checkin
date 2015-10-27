require.config({
    paths: {
        jquery: "vendor/jquery/jquery",
        json2: 'vendor/json2',
        j_form: 'vendor/jquery/jquery.form',
        bootstrap: 'vendor/bootstrap/bootstrap',
        blockUI: 'vendor/jquery/jquery.blockUI'
    },
    shim: {
        json2: {deps: ['jquery']},
        jquery_center: {deps: ['jquery']},
        j_form: {deps: ['jquery']},
        bootstrap: {deps: ['jquery']},
        blockUI: {deps: ['jquery']}
    },
    waitSeconds: 30
});
require(["jquery", 'json2', 'j_form', 'bootstrap','blockUI'], function($) {
    $(document).ajaxStart(function() {
        $('html').block({
            message: '...please wait...'
        });
        checkLogouStatus();
    });
    $(document).ajaxStop(function() {
        $('html').unblock();
        checkLogouStatus();
    });

    function checkLogouStatus() {
        $(document).bind("ajaxComplete", function(event, response, ajaxOptions) {
            if (response.status == 200 && response.responseText.match(/login/)) {
                this.location = window.location.protocol + "//" + window.location.hostname + "/login";
                return false;
            }
        });
    }
});
