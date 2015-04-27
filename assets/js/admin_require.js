require.config({
    paths: {
        jquery: "vendor/jquery/jquery",
        json2: 'vendor/json2',
        j_form: 'vendor/jquery/jquery.form',
        bootstrap: 'vendor/bootstrap/bootstrap'
    },
    shim: {
        json2: {deps: ['jquery']},
        jquery_center: {deps: ['jquery']},
        j_form: {deps: ['jquery']},
        bootstrap: {deps: ['jquery']},
    },
    waitSeconds: 30
});
require(["jquery", 'json2', 'j_form', 'bootstrap'], function($) {
});
