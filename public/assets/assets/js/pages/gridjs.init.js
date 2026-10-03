/*
Template Name: Dosix - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: grid Js File
*/

// Basic Table
if (document.getElementById("table-gridjs"))
    new gridjs.Grid({
        columns: [{
                name: 'شناسه',
                width: '80px',
                formatter: (function (cell) {
                    return gridjs.html('<span class="fw-semibold">' + cell + '</span>');
                })
            },
            {
                name: 'نام',
                width: '150px',
            },
            {
                name: 'ایمیل',
                width: '220px',
                formatter: (function (cell) {
                    return gridjs.html('<a href="">' + cell + '</a>');
                })
            },
            {
                name: 'موقعیت',
                width: '250px',
            },
            {
                name: 'شرکت',
                width: '180px',
            },
            {
                name: 'کشور',
                width: '180px',
            },
            {
                name: 'اقدامات',
                width: '150px',
                formatter: (function (cell) {
                    return gridjs.html("<a href='#' class='text-reset text-decoration-underline'>" +
                        "جزئیات" +
                        "</a>");
                })
            },
        ],
        pagination: {
            limit: 5
        },
        sort: true,
        search: true,
        language: {
            search: {
              placeholder: 'جستجو...'
            },
            sort: {
              sortAsc: 'مرتب‌سازی صعودی',
              sortDesc: 'مرتب‌سازی نزولی'
            },
            pagination: {
              previous: 'قبلی',
              next: 'بعدی',
              showing: 'نمایش',
              results: () => 'نتیجه'
            },
            loading: 'در حال بارگذاری...',
            noRecordsFound: 'رکوردی یافت نشد',
            error: 'خطایی رخ داده است'
          },
        data: [
            ["01", "جاناتان", "jonathan@example.com", "معمار ارشد پیاده‌سازی", "Hauck Inc", "واتیکان"],
            ["02", "هارولد", "harold@example.com", "هماهنگ‌کننده خلاقیت پیشرو", "Metz Inc", "ایران"],
            ["03", "شانون", "shannon@example.com", "همکار عملکردهای قدیمی", "Zemlak Group", "گرجستان جنوبی"],
            ["04", "رابرت", "robert@example.com", "تکنسین حساب‌های محصول", "Hoeger", "سان مارینو"],
            ["05", "نوئل", "noel@example.com", "مدیر داده‌های مشتری", "Howell - Rippin", "آلمان"],
            ["06", "تراسی", "traci@example.com", "مدیر هویت شرکتی", "Koelpin - Goldner", "وانواتو"],
            ["07", "کری", "kerry@example.com", "همکار ارشد برنامه‌ها", "Feeney, Langworth and Tremblay", "نیجر"],
            ["08", "پتسی", "patsy@example.com", "مدیر تضمین پویا", "Streich Group", "نیو"],
            ["09", "کتی", "cathy@example.com", "مدیر داده‌های مشتری", "Ebert, Schamberger and Johnston", "مکزیک"],
            ["10", "تایرون", "tyrone@example.com", "رابط ارشد پاسخگویی", "Raynor, Rolfson and Daugherty", "قطر"],
        ]
    }).render(document.getElementById("table-gridjs"));

// card Table
if (document.getElementById("table-card"))
    new gridjs.Grid({
        columns: [{
            name: 'نام',
            width: '150px',
        },{
            name: 'ایمیل',
            width: '250px',
        }, {
            name: 'موقعیت',
            width: '250px',
        }, {
            name: 'شرکت',
            width: '250px',
        }, {
            name: 'کشور',
            width: '150px',
        }],
        sort: true,
        pagination: {
            limit: 5
        },language: {
            search: {
              placeholder: 'جستجو...'
            },
            sort: {
              sortAsc: 'مرتب‌سازی صعودی',
              sortDesc: 'مرتب‌سازی نزولی'
            },
            pagination: {
              previous: 'قبلی',
              next: 'بعدی',
              showing: 'نمایش',
              results: () => 'نتیجه'
            },
            loading: 'در حال بارگذاری...',
            noRecordsFound: 'رکوردی یافت نشد',
            error: 'خطایی رخ داده است'
          },
        data: [
            ["جاناتان", "jonathan@example.com", "معمار ارشد پیاده‌سازی", "Hauck Inc", "واتیکان"],
            ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقیت پیشرو", "Metz Inc", "ایران"],
            ["شانون", "shannon@example.com", "همکار عملکردهای قدیمی", "Zemlak Group", "گرجستان جنوبی"],
            ["رابرت", "robert@example.com", "تکنسین حساب‌های محصول", "Hoeger", "سان مارینو"],
            ["نوئل", "noel@example.com", "مدیر داده‌های مشتری", "Howell - Rippin", "آلمان"],
            ["تراسی", "traci@example.com", "مدیر هویت شرکتی", "Koelpin - Goldner", "وانواتو"],
            ["کری", "kerry@example.com", "همکار ارشد برنامه‌ها", "Feeney, Langworth and Tremblay", "نیجر"],
            ["پتسی", "patsy@example.com", "مدیر تضمین پویا", "Streich Group", "نیو"],
            ["کتی", "cathy@example.com", "مدیر داده‌های مشتری", "Ebert, Schamberger and Johnston", "مکزیک"],
            ["تایرون", "tyrone@example.com", "رابط ارشد پاسخگویی", "Raynor, Rolfson and Daugherty", "قطر"],
        ]
    }).render(document.getElementById("table-card"));


// pagination Table
if (document.getElementById("table-pagination"))
    new gridjs.Grid({
        columns: [{
                name: 'شناسه',
                width: '120px',
                formatter: (function (cell) {
                    return gridjs.html('<a href="" class="fw-medium">' + cell + '</a>');
                })
            }, {
                name: 'نام',
                width: '150px',
            }, {
                name: 'تاریخ',
                width: '180px',
            }, {
                name: 'مجموع',
                width: '120px',
            }, {
                name: 'وضعیت',
                width: '120px',
            },
            {
                name: 'اقدامات',
                width: '100px',
                formatter: (function (cell) {
                    return gridjs.html("<button type='button' class='btn btn-sm btn-light'>" +
                        "جزئیات" +
                        "</button>");
                })
            },
        ],
        pagination: {
            limit: 5
        },
        language: {
            search: {
              placeholder: 'جستجو...'
            },
            sort: {
              sortAsc: 'مرتب‌سازی صعودی',
              sortDesc: 'مرتب‌سازی نزولی'
            },
            pagination: {
              previous: 'قبلی',
              next: 'بعدی',
              showing: 'نمایش',
              results: () => 'نتیجه'
            },
            loading: 'در حال بارگذاری...',
            noRecordsFound: 'رکوردی یافت نشد',
            error: 'خطایی رخ داده است'
          },
        data: [
            ["#VL2111", "جاناتان", "۰۷ اکتبر ۲۰۲۱", "۲۴.۰۵ دلار", "پرداخت شده"],
            ["#VL2110", "هارولد", "۰۷ اکتبر ۲۰۲۱", "۲۶.۱۵ دلار", "پرداخت شده"],
            ["#VL2109", "شانون", "۰۶ اکتبر ۲۰۲۱", "۲۱.۲۵ دلار", "بازپرداخت"],
            ["#VL2108", "رابرت", "۰۵ اکتبر ۲۰۲۱", "۲۵.۰۳ دلار", "پرداخت شده"],
            ["#VL2107", "نوئل", "۰۵ اکتبر ۲۰۲۱", "۲۲.۶۱ دلار", "پرداخت شده"],
            ["#VL2106", "تراسی", "۰۴ اکتبر ۲۰۲۱", "۲۴.۰۵ دلار", "پرداخت شده"],
            ["#VL2105", "کری", "۰۴ اکتبر ۲۰۲۱", "۲۶.۱۵ دلار", "پرداخت شده"],
            ["#VL2104", "پتسی", "۰۴ اکتبر ۲۰۲۱", "۲۱.۲۵ دلار", "بازپرداخت"],
            ["#VL2103", "کتی", "۰۳ اکتبر ۲۰۲۱", "۲۲.۶۱ دلار", "پرداخت شده"],
            ["#VL2102", "تایرون", "۰۳ اکتبر ۲۰۲۱", "۲۵.۰۳ دلار", "پرداخت شده"],
        ]
    }).render(document.getElementById("table-pagination"));

// search Table
if (document.getElementById("table-search"))
    new gridjs.Grid({
        columns: [{
            name: 'نام',
            width: '150px',
        }, {
            name: 'ایمیل',
            width: '250px',
        }, {
            name: 'موقعیت',
            width: '250px',
        }, {
            name: 'شرکت',
            width: '250px',
        }, {
            name: 'کشور',
            width: '150px',
        }],
        pagination: {
            limit: 5
        },
        search: true,language: {
            search: {
              placeholder: 'جستجو...'
            },
            sort: {
              sortAsc: 'مرتب‌سازی صعودی',
              sortDesc: 'مرتب‌سازی نزولی'
            },
            pagination: {
              previous: 'قبلی',
              next: 'بعدی',
              showing: 'نمایش',
              results: () => 'نتیجه'
            },
            loading: 'در حال بارگذاری...',
            noRecordsFound: 'رکوردی یافت نشد',
            error: 'خطایی رخ داده است'
          },
        data: [
            ["جاناتان", "jonathan@example.com", "معمار ارشد پیاده‌سازی", "Hauck Inc", "واتیکان"],
            ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقیت پیشرو", "Metz Inc", "ایران"],
            ["شانون", "shannon@example.com", "همکار عملکردهای قدیمی", "Zemlak Group", "گرجستان جنوبی"],
            ["رابرت", "robert@example.com", "تکنسین حساب‌های محصول", "Hoeger", "سان مارینو"],
            ["نوئل", "noel@example.com", "مدیر داده‌های مشتری", "Howell - Rippin", "آلمان"],
            ["تراسی", "traci@example.com", "مدیر هویت شرکتی", "Koelpin - Goldner", "وانواتو"],
            ["کری", "kerry@example.com", "همکار ارشد برنامه‌ها", "Feeney, Langworth and Tremblay", "نیجر"],
            ["پتسی", "patsy@example.com", "مدیر تضمین پویا", "Streich Group", "نیو"],
            ["کتی", "cathy@example.com", "مدیر داده‌های مشتری", "Ebert, Schamberger and Johnston", "مکزیک"],
            ["تایرون", "tyrone@example.com", "رابط ارشد پاسخگویی", "Raynor, Rolfson and Daugherty", "قطر"],
        ]
    }).render(document.getElementById("table-search"));

// Sorting Table
if (document.getElementById("table-sorting"))
    new gridjs.Grid({
        columns: [{
            name: 'نام',
            width: '150px',
        }, {
            name: 'ایمیل',
            width: '250px',
        }, {
            name: 'موقعیت',
            width: '250px',
        }, {
            name: 'شرکت',
            width: '250px',
        }, {
            name: 'کشور',
            width: '150px',
        }],
        pagination: {
            limit: 5
        },
        sort: true,language: {
            search: {
              placeholder: 'جستجو...'
            },
            sort: {
              sortAsc: 'مرتب‌سازی صعودی',
              sortDesc: 'مرتب‌سازی نزولی'
            },
            pagination: {
              previous: 'قبلی',
              next: 'بعدی',
              showing: 'نمایش',
              results: () => 'نتیجه'
            },
            loading: 'در حال بارگذاری...',
            noRecordsFound: 'رکوردی یافت نشد',
            error: 'خطایی رخ داده است'
          },
        data: [
            ["جاناتان", "jonathan@example.com", "معمار ارشد پیاده‌سازی", "Hauck Inc", "واتیکان"],
            ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقیت پیشرو", "Metz Inc", "ایران"],
            ["شانون", "shannon@example.com", "همکار عملکردهای قدیمی", "Zemlak Group", "گرجستان جنوبی"],
            ["رابرت", "robert@example.com", "تکنسین حساب‌های محصول", "Hoeger", "سان مارینو"],
            ["نوئل", "noel@example.com", "مدیر داده‌های مشتری", "Howell - Rippin", "آلمان"],
            ["تراسی", "traci@example.com", "مدیر هویت شرکتی", "Koelpin - Goldner", "وانواتو"],
            ["کری", "kerry@example.com", "همکار ارشد برنامه‌ها", "Feeney, Langworth and Tremblay", "نیجر"],
            ["پتسی", "patsy@example.com", "مدیر تضمین پویا", "Streich Group", "نیو"],
            ["کتی", "cathy@example.com", "مدیر داده‌های مشتری", "Ebert, Schamberger and Johnston", "مکزیک"],
            ["تایرون", "tyrone@example.com", "رابط ارشد پاسخگویی", "Raynor, Rolfson and Daugherty", "قطر"],
        ]
    }).render(document.getElementById("table-sorting"));


// Loading State Table
if (document.getElementById("table-loading-state"))
    new gridjs.Grid({
        columns: [{
            name: 'نام',
            width: '150px',
        }, {
            name: 'ایمیل',
            width: '250px',
        }, {
            name: 'موقعیت',
            width: '250px',
        }, {
            name: 'شرکت',
            width: '250px',
        }, {
            name: 'کشور',
            width: '150px',
        }],
        pagination: {
            limit: 5
        },language: {
            search: {
              placeholder: 'جستجو...'
            },
            sort: {
              sortAsc: 'مرتب‌سازی صعودی',
              sortDesc: 'مرتب‌سازی نزولی'
            },
            pagination: {
              previous: 'قبلی',
              next: 'بعدی',
              showing: 'نمایش',
              results: () => 'نتیجه'
            },
            loading: 'در حال بارگذاری...',
            noRecordsFound: 'رکوردی یافت نشد',
            error: 'خطایی رخ داده است'
          },
        sort: true,
        data: function () {
            return new Promise(function (resolve) {
                setTimeout(function () {
                    resolve([
                        ["جاناتان", "jonathan@example.com", "معمار ارشد پیاده‌سازی", "Hauck Inc", "واتیکان"],
                        ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقیت پیشرو", "Metz Inc", "ایران"],
                        ["شانون", "shannon@example.com", "همکار عملکردهای قدیمی", "Zemlak Group", "گرجستان جنوبی"],
                        ["رابرت", "robert@example.com", "تکنسین حساب‌های محصول", "Hoeger", "سان مارینو"],
                        ["نوئل", "noel@example.com", "مدیر داده‌های مشتری", "Howell - Rippin", "آلمان"],
                        ["تراسی", "traci@example.com", "مدیر هویت شرکتی", "Koelpin - Goldner", "وانواتو"],
                        ["کری", "kerry@example.com", "همکار ارشد برنامه‌ها", "Feeney, Langworth and Tremblay", "نیجر"],
                        ["پتسی", "patsy@example.com", "مدیر تضمین پویا", "Streich Group", "نیو"],
                        ["کتی", "cathy@example.com", "مدیر داده‌های مشتری", "Ebert, Schamberger and Johnston", "مکزیک"],
                        ["تایرون", "tyrone@example.com", "رابط ارشد پاسخگویی", "Raynor, Rolfson and Daugherty", "قطر"]
                    ])
                }, 2000);
            });
        }
    }).render(document.getElementById("table-loading-state"));


// Fixed Header
if (document.getElementById("table-fixed-header"))
    new gridjs.Grid({
        columns: [{
            name: 'نام',
            width: '150px',
        }, {
            name: 'ایمیل',
            width: '250px',
        }, {
            name: 'موقعیت',
            width: '250px',
        }, {
            name: 'شرکت',
            width: '250px',
        }, {
            name: 'کشور',
            width: '150px',
        }],language: {
            search: {
              placeholder: 'جستجو...'
            },
            sort: {
              sortAsc: 'مرتب‌سازی صعودی',
              sortDesc: 'مرتب‌سازی نزولی'
            },
            pagination: {
              previous: 'قبلی',
              next: 'بعدی',
              showing: 'نمایش',
              results: () => 'نتیجه'
            },
            loading: 'در حال بارگذاری...',
            noRecordsFound: 'رکوردی یافت نشد',
            error: 'خطایی رخ داده است'
          },
        sort: true,
        pagination: true,
        fixedHeader: true,
        height: '400px',
        data: [
            ["جاناتان", "jonathan@example.com", "معمار ارشد پیاده‌سازی", "Hauck Inc", "واتیکان"],
            ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقیت پیشرو", "Metz Inc", "ایران"],
            ["شانون", "shannon@example.com", "همکار عملکردهای قدیمی", "Zemlak Group", "گرجستان جنوبی"],
            ["رابرت", "robert@example.com", "تکنسین حساب‌های محصول", "Hoeger", "سان مارینو"],
            ["نوئل", "noel@example.com", "مدیر داده‌های مشتری", "Howell - Rippin", "آلمان"],
            ["تراسی", "traci@example.com", "مدیر هویت شرکتی", "Koelpin - Goldner", "وانواتو"],
            ["کری", "kerry@example.com", "همکار ارشد برنامه‌ها", "Feeney, Langworth and Tremblay", "نیجر"],
            ["پتسی", "patsy@example.com", "مدیر تضمین پویا", "Streich Group", "نیو"],
            ["کتی", "cathy@example.com", "مدیر داده‌های مشتری", "Ebert, Schamberger and Johnston", "مکزیک"],
            ["تایرون", "tyrone@example.com", "رابط ارشد پاسخگویی", "Raynor, Rolfson and Daugherty", "قطر"],
        ]
    }).render(document.getElementById("table-fixed-header"));


// Hidden Columns
if (document.getElementById("table-hidden-column"))
    new gridjs.Grid({
        columns: [{
            name: 'نام',
            width: '120px',
        }, {
                name: 'ایمیل',
                width: '250px',
            }, {
                name: 'موقعیت',
                width: '250px',
            }, {
                name: 'شرکت',
                width: '250px',
            },
            {
                name: 'کشور',
                hidden: true
            },
        ],
        pagination: {
            limit: 5
        },language: {
            search: {
              placeholder: 'جستجو...'
            },
            sort: {
              sortAsc: 'مرتب‌سازی صعودی',
              sortDesc: 'مرتب‌سازی نزولی'
            },
            pagination: {
              previous: 'قبلی',
              next: 'بعدی',
              showing: 'نمایش',
              results: () => 'نتیجه'
            },
            loading: 'در حال بارگذاری...',
            noRecordsFound: 'رکوردی یافت نشد',
            error: 'خطایی رخ داده است'
          },
        sort: true,
        data: [
            ["جاناتان", "jonathan@example.com", "معمار ارشد پیاده‌سازی", "Hauck Inc", "واتیکان"],
            ["هارولد", "harold@example.com", "هماهنگ‌کننده خلاقیت پیشرو", "Metz Inc", "ایران"],
            ["شانون", "shannon@example.com", "همکار عملکردهای قدیمی", "Zemlak Group", "گرجستان جنوبی"],
            ["رابرت", "robert@example.com", "تکنسین حساب‌های محصول", "Hoeger", "سان مارینو"],
            ["نوئل", "noel@example.com", "مدیر داده‌های مشتری", "Howell - Rippin", "آلمان"],
            ["تراسی", "traci@example.com", "مدیر هویت شرکتی", "Koelpin - Goldner", "وانواتو"],
            ["کری", "kerry@example.com", "همکار ارشد برنامه‌ها", "Feeney, Langworth and Tremblay", "نیجر"],
            ["پتسی", "patsy@example.com", "مدیر تضمین پویا", "Streich Group", "نیو"],
            ["کتی", "cathy@example.com", "مدیر داده‌های مشتری", "Ebert, Schamberger and Johnston", "مکزیک"],
            ["تایرون", "tyrone@example.com", "رابط ارشد پاسخگویی", "Raynor, Rolfson and Daugherty", "قطر"],
        ]
    }).render(document.getElementById("table-hidden-column"));