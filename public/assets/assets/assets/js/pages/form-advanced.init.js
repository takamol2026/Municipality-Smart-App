/*
Template Name: Dosix - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Form Advanced Js File
*/

// multiselect

var multiSelectBasic = document.getElementById("multiselect-basic");
if (multiSelectBasic) {
    multi(multiSelectBasic, {
        enable_search: false
    });
}

var multiSelectHeader = document.getElementById("multiselect-header");
if (multiSelectHeader) {
    multi(multiSelectHeader, {
        non_selected_header: "خودروها",
        selected_header: "خودروهای مورد علاقه"
    });
}

var multiSelectOptGroup = document.getElementById("multiselect-optiongroup");
if (multiSelectOptGroup) {
    multi(multiSelectOptGroup, {
        enable_search: true
    });
}

// Autocomplete
var autoCompleteFruit = new autoComplete({
    selector: "#autoCompleteFruit",
    placeHolder: "برای میوه‌ها جستجو کنید...",
    data: {
        src: ["سیب", "موز", "بلوبری", "گیلاس", "نارگیل", "کیوی", "لیمو", "لیمو ترش", "مَنگو", "پرتقال"],
        cache: true
    },
    resultsList: {
        element: function element(list, data) {
            if (!data.results.length) {
                // Create "No Results" message element
                var message = document.createElement("div");
                // Add class to the created element
                message.setAttribute("class", "no_result");
                // Add message text content
                message.innerHTML = "<span>نتیجه‌ای برای \"" + data.query + "\" پیدا نشد</span>";
                // Append message element to the results list
                list.prepend(message);
            }
        },
        noResults: true
    },
    resultItem: {
        highlight: true
    },
    events: {
        input: {
            selection: function selection(event) {
                var selection = event.detail.selection.value;
                autoCompleteFruit.input.value = selection;
            }
        }
    }
});

var autoCompleteCars = new autoComplete({
    selector: "#autoCompleteCars",
    placeHolder: "برای جستجوی خودروها...",
    data: {
        src: ["شورولت", "فیات", "فورد", "هوندا", "هیوندای", "هیوندای", "کیا", "ماهندرا", "ماروتی", "میتسوبیشی", "ام‌جی", "نیسان", "رنو", "اسکودا", "تاتا", "تویوتا", "فولکس واگن"],
        cache: true
    },
    resultsList: {
        element: function element(list, data) {
            if (!data.results.length) {
                // Create "No Results" message element
                var message = document.createElement("div");
                // Add class to the created element
                message.setAttribute("class", "no_result");
                // Add message text content
                message.innerHTML = "<span>نتیجه‌ای برای \"" + data.query + "\" پیدا نشد</span>";
                // Append message element to the results list
                list.prepend(message);
            }
        },
        noResults: true
    },
    resultItem: {
        highlight: true
    },
    events: {
        input: {
            selection: function selection(event) {
                var selection = event.detail.selection.value;
                autoCompleteCars.input.value = selection;
            }
        }
    }
});