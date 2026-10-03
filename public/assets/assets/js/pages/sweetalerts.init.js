/*
Template Name: Dosix - Admin & Dashboard Template
Author: Themesbrand
Website: https://Themesbrand.com/
Contact: Themesbrand@gmail.com
File: Sweatalerts init js
*/

//Basic
if (document.getElementById("sa-basic"))
    document.getElementById("sa-basic").addEventListener("click", function () {
        Swal.fire({
            title: 'هر کسی می‌تواند از کامپیوتر استفاده کند',
            customClass: {
                confirmButton: 'btn btn-primary w-xs mt-2',
            },
            buttonsStyling: false,
            showCloseButton: true
        })
    });

//A title with a text under
if (document.getElementById("sa-title"))
    document.getElementById("sa-title").addEventListener("click", function () {
        Swal.fire({
            title: "اینترنت؟",
            text: 'آیا هنوز هم وجود دارد؟',
            icon: 'question',
            customClass: {
                confirmButton: 'btn btn-primary w-xs mt-2',
            },
            buttonsStyling: false,
            showCloseButton: true
        })
    });

//Success Message
if (document.getElementById("sa-success"))
    document.getElementById("sa-success").addEventListener("click", function () {
        Swal.fire({
            title: 'آفرین!',
            text: 'شما دکمه را کلیک کردید!',
            icon: 'success',
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                cancelButton: 'btn btn-danger w-xs mt-2',
            },
            buttonsStyling: false,
            showCloseButton: true
        })
    });

//error Message
if (document.getElementById("sa-error"))
    document.getElementById("sa-error").addEventListener("click", function () {
        Swal.fire({
            title: 'اوه...',
            text: 'مشکلی پیش آمده است!',
            icon: 'error',
            customClass: {
                confirmButton: 'btn btn-primary w-xs mt-2',
            },
            buttonsStyling: false,
            footer: '<a href="">Why do I have this issue?</a>',
            showCloseButton: true
        })
    });

// long content
if (document.getElementById("sa-longcontent"))
    document.getElementById("sa-longcontent").addEventListener("click", function () {
        Swal.fire({
            imageUrl: 'https://placeholder.pics/svg/300x1500',
            imageHeight: 1500,
            imageAlt: 'A tall image',
            customClass: {
                confirmButton: 'btn btn-primary w-xs mt-2',
            },
            buttonsStyling: false,
            showCloseButton: true
        })
    });

//Warning Message
if (document.getElementById("sa-warning"))
    document.getElementById("sa-warning").addEventListener("click", function () {
        Swal.fire({
            title: "آیا مطمئن هستید؟",
            text: "شما نمی‌توانید این عملیات را برگردانید!",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                cancelButton: 'btn btn-danger w-xs mt-2',
            },
            confirmButtonText: "بله، حذف کن!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function (result) {
            if (result.value) {
                Swal.fire({
                    title: 'حذف شد!',
                    text: 'فایل شما حذف شده است.',
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-primary w-xs mt-2',
                    },
                    buttonsStyling: false
                })
            }
        });
    });

//Parameter
if (document.getElementById("sa-params"))
    document.getElementById("sa-params").addEventListener("click", function () {
        Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: "شما نمی‌توانید این عملیات را برگردانید!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'بله، حذفش کن!',
            cancelButtonText: 'نه، لغوش کن!',
            customClass: {
                confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                cancelButton: 'btn btn-danger w-xs mt-2',
            },
            buttonsStyling: false,
            showCloseButton: true
        }).then(function (result) {
            if (result.value) {
                Swal.fire({
                    title: 'حذف شد!',
                    text: 'فایل شما حذف شده است.',
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-primary w-xs mt-2',
                    },
                    buttonsStyling: false
                })
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                Swal.fire({
                    title: 'لغو شد',
                    text: 'فایل شما در امان است :)',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary mt-2',
                    },
                    buttonsStyling: false
                })
            }
        });
    });


//Custom Image
if (document.getElementById("sa-image"))
    document.getElementById("sa-image").addEventListener("click", function () {
        Swal.fire({
            title: 'چه عالی!',
            text: 'مودال با یک تصویر سفارشی.',
            imageUrl: 'assets/images/logo-sm.png',
            imageHeight: 40,
            customClass: {
                confirmButton: 'btn btn-primary w-xs mt-2',
            },
            buttonsStyling: false,
            animation: false,
            showCloseButton: true
        })
    });

//Auto Close Timer
if (document.getElementById("sa-close"))
    document.getElementById("sa-close").addEventListener("click", function () {
        var timerInterval;
        Swal.fire({
            title: 'هشدار بسته شدن خودکار!',
            html: 'در <strong></strong> ثانیه بسته خواهد شد.',
            timer: 2000,
            timerProgressBar: true,
            showCloseButton: true,
            didOpen: function () {
                Swal.showLoading()
                timerInterval = setInterval(function () {
                    var content = Swal.getHtmlContainer()
                    if (content) {
                        var b = content.querySelector('b')
                        if (b) {
                            b.textContent = Swal.getTimerLeft()
                        }
                    }
                }, 100)
            },
            onClose: function () {
                clearInterval(timerInterval)
            }
        }).then(function (result) {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('من توسط تایمر بسته شدم')
            }
        })
    });

//custom html alert
if (document.getElementById("custom-html-alert"))
    document.getElementById("custom-html-alert").addEventListener("click", function () {
        Swal.fire({
            title: '<i>مثال</i> <u>HTML</u>',
            icon: 'info',
            html: 'شما می‌توانید از <b>متن پررنگ</b>، ' +
                '<a href="//Themesbrand.in/">لینک‌ها</a> ' +
                'و سایر تگ‌های HTML استفاده کنید',
            showCloseButton: true,
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-success me-2',
                cancelButton: 'btn btn-danger',
            },
            buttonsStyling: false,
            confirmButtonText: '<i class="ri-thumb-up-fill align-bottom me-1"></i> عالی!',
            cancelButtonText: '<i class="ri-thumb-down-fill align-bottom"></i> لغو',
            showCloseButton: true
        })
    });

//dialog three buttons
if (document.getElementById("sa-dialog-three-btn"))
    document.getElementById("sa-dialog-three-btn").addEventListener("click", function () {
        Swal.fire({
            title: 'آیا می‌خواهید تغییرات را ذخیره کنید؟',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'ذخیره',
            customClass: {
                confirmButton: 'btn btn-success w-xs me-2',
                cancelButton: 'btn btn-danger w-xs',
                denyButton: 'btn btn-info w-xs me-2',
            },
            buttonsStyling: false,
            denyButtonText: 'ذخیره نکن',
            showCloseButton: true
        }).then(function (result) {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'ذخیره شد!',
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-primary w-xs',
                    },
                    buttonsStyling: false,
                })
            } else if (result.isDenied) {
                Swal.fire({
                    title: 'تغییرات ذخیره نشدند',
                    icon: 'info',
                    customClass: {
                        confirmButton: 'btn btn-primary w-xs',
                    },
                    buttonsStyling: false,
                })
            }
        })
    });

//position
if (document.getElementById("sa-position"))
    document.getElementById("sa-position").addEventListener("click", function () {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'کار شما ذخیره شد',
            showConfirmButton: false,
            timer: 1500,
            showCloseButton: true
        })
    });

//Custom width padding
if (document.getElementById("custom-padding-width-alert"))
    document.getElementById("custom-padding-width-alert").addEventListener("click", function () {
        Swal.fire({
            title: 'عرض سفارشی، فاصله‌گذاری، پس‌زمینه.',
            width: 600,
            padding: 100,
            customClass: {
                confirmButton: 'btn btn-primary w-xs',
            },
            buttonsStyling: false,
            background: 'var(--tb-secondary-bg) url(assets/images/modal-bg.jpg)'
        })
    });

//Ajax
if (document.getElementById("ajax-alert"))
    document.getElementById("ajax-alert").addEventListener("click", function () {
        Swal.fire({
            title: 'ارسال ایمیل برای اجرای درخواست ایجکس',
            input: 'email',
            showCancelButton: true,
            confirmButtonText: 'ارسال',
            showLoaderOnConfirm: true,
            customClass: {
                confirmButton: 'btn btn-primary w-xs me-2',
                cancelButton: 'btn btn-danger w-xs',
            },
            buttonsStyling: false,
            showCloseButton: true,
            preConfirm: function (email) {
                return new Promise(function (resolve, reject) {
                    setTimeout(function () {
                        if (email === 'taken@example.com') {
                            reject('این ایمیل قبلاً گرفته شده است.')
                        } else {
                            resolve()
                        }
                    }, 2000)
                })
            },
            allowOutsideClick: false
        }).then(function (email) {
            Swal.fire({
                icon: 'success',
                title: 'درخواست ایجکس به پایان رسید!',
                customClass: {
                    confirmButton: 'btn btn-primary w-xs',
                },
                buttonsStyling: false,
                html: 'ایمیل ارسال شده: ' + email
            })
        })
    });


// Custom SweatAlerts

//Custom success Message
if (document.getElementById("custom-sa-success"))
    document.getElementById("custom-sa-success").addEventListener("click", function () {
        Swal.fire({
            html: '<div class="mt-3">' +
                '<img src="assets/images/success-img.png" alt=""  height="150"></img>' +
                '<div class="mt-4 pt-2 fs-base">' +
                '<h4>آفرین!</h4>' +
                '<p class="text-muted mx-4 mb-0">آره، شما با موفقیت این پیام مهم را خواندید.</p>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            showConfirmButton: false,
            customClass: {
            cancelButton: 'btn btn-primary w-xs mb-1',
            },
            cancelButtonText: 'بازگشت',
            buttonsStyling: false,
            showCloseButton: true
        })
    });

//Custom error Message
if (document.getElementById("custom-sa-error"))
    document.getElementById("custom-sa-error").addEventListener("click", function () {
        Swal.fire({
            html: '<div class="mt-3">' +
                '<i class="bi bi-exclamation-triangle display-5 text-warning"></i>' +
                '<div class="mt-4 pt-2 fs-base">' +
                '<h4>اوه...! مشکلی پیش آمده است!</h4>' +
                '<p class="text-muted mx-4 mb-0">آدرس ایمیل شما نامعتبر است</p>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            showConfirmButton: false,
            customClass: {
                cancelButton: 'btn btn-primary w-xs mb-1',
            },
            cancelButtonText: 'رد کردن',
            buttonsStyling: false,
            showCloseButton: true
        })
    });

//Custom error Message
if (document.getElementById("custom-sa-warning"))
    document.getElementById("custom-sa-warning").addEventListener("click", function () {
        Swal.fire({
            html: '<div class="mt-3">' +
                '<i class="bi bi-trash3 display-5 text-danger"></i>' +
                '<div class="mt-4 pt-2 fs-base mx-5">' +
                '<h4> مطمئنی؟</h4>' +
                '<p class="text-muted mx-4 mb-0">آیا مطمئن هستید که می‌خواهید این حساب را حذف کنید؟</p>' +
                '</div>' +
                '</div>',
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary w-xs me-2 mb-1',
            },
            confirmButtonText: 'بله، حذفش کن!',
            customClass: {
                cancelButton: 'btn btn-danger w-xs mb-1',
            },
            buttonsStyling: false,
            showCloseButton: true
        })
    });

// custom Join Our Community
if (document.getElementById("custom-sa-community"))
    document.getElementById("custom-sa-community").addEventListener("click", function () {
        Swal.fire({
            title: 'به جامعه ما بپیوندید',
            html: 'شما می‌توانید از <b>متن بولد</b>، ' +
                '<a href="//Themesbrand.in/">لینک‌ها</a> ' +
                'و سایر تگ‌های HTML استفاده کنید',
            html: '<div class="mt-3 text-start">' +
                '<label for="input-email" class="form-label fs-sm">ایمیل</label>' +
                '<input type="email" class="form-control" id="input-email" placeholder="آدرس ایمیل را وارد کنید">' +
                '</div>',
            imageUrl: 'assets/images/logo-sm.png',
            footer: '<p class="fs-sm text-muted mb-0">حساب کاربری دارید؟ <a href="#" class="fw-semibold text-decoration-underline"> وارد شوید </a> </p>',
            imageHeight: 40,
            customClass: {
                confirmButton: 'btn btn-primary w-xs mb-2',
            },
            confirmButtonText: 'ثبت نام <i class="ri-arrow-right-line ms-1 align-bottom"></i>',
            buttonsStyling: false,
            showCloseButton: true
        })
    });

//Custom Email varification
if (document.getElementById("custom-sa-email-verify"))
    document.getElementById("custom-sa-email-verify").addEventListener("click", function () {
        Swal.fire({
            html: '<div class="mt-3">' +
                '<div class="avatar-lg mx-auto">' +
                '<div class="avatar-title bg-light text-success display-5 rounded-circle">' +
                '<i class="ri-mail-send-fill"></i>' +
                '</div>' +
                '</div>' +
                '<div class="mt-4 pt-2 fs-base">' +
                '<h4 class="fs-3xl fw-semibold">ایمیل خود را تأیید کنید</h4>' +
                '<p class="text-muted mb-0 mt-3">ما یک ایمیل تأیید به <span class="fw-medium">example@abc.com</span> ارسال کرده‌ایم، <br/> لطفاً آن را بررسی کنید.</p>' +
                '</div>' +
                '</div>',
            showCancelButton: false,
            customClass: {
                confirmButton: 'btn btn-primary mb-1',
            },
            confirmButtonText: 'تأیید ایمیل',
            buttonsStyling: false,
            footer: '<p class="fs-md text-muted mb-0">ایمیلی دریافت نکردید؟ <a href="#" class="fw-semibold text-decoration-underline">ارسال مجدد</a></p>',
            showCloseButton: true
        })
    });


//پیام اعلان سفارشی
if (document.getElementById("custom-sa-notification"))
    document.getElementById("custom-sa-notification").addEventListener("click", function () {
        Swal.fire({
            html: '<div class="mt-3">' +
                '<div class="avatar-lg mx-auto">' +
                '<img src="assets/images/users/avatar-2.jpg" class="rounded-circle img-thumbnail" alt="تصویر بندانگشتی">' +
                '</div>' +
                '<div class="mt-4 pt-2 fs-base">' +
                '<h4 class="fs-2xl fw-semibold">خوش آمدید <span class="fw-semibold">مایک مایر</span></h4>' +
                '<p class="text-muted mb-0 fs-sm">شما <span class="fw-semibold text-success">۲</span> اعلان دارید</p>' +
                '</div>' +
                '</div>',
            showCancelButton: false,
            customClass: {
                confirmButton: 'btn btn-primary mb-1',
            },
            confirmButtonText: 'نمایش بده <i class="ri-arrow-right-line ms-1 align-bottom"></i>',
            buttonsStyling: false,
            showCloseButton: true
        })
    });