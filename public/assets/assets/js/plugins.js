/*
Template Name: Dosix - Admin & Dashboard Template
Author: Themesbrand
Version: 1.1.0
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Common Plugins Js File
*/

(function () {
    var script = document.currentScript;
    var base = "assets/assets/libs/";

    if (script && script.src) {
        base = script.src.replace(/\/js\/plugins\.js(?:\?.*)?$/i, "/libs/");
    }

    function load(src) {
        document.writeln("<script src='" + src + "'><\/script>");
    }

    if (document.querySelectorAll("[toast-list]").length) {
        load(base + "toastify-js/src/toastify.js");
    }

    if (document.querySelectorAll("[data-provider]").length) {
        load(base + "flatpickr/dist/flatpickr.min.js");
    }

    if (document.querySelectorAll("[data-choices]").length) {
        load(base + "choices.js/public/assets/scripts/choices.min.js");
    }
})();
