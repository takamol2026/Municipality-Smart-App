            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/assets/images/logo-dark.png') }}" alt="" height="22">
                        </span>
                    </a>
                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/assets/images/logo-light.png') }}" alt="" height="22">
                        </span>
                    </a>
                    <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                    <div class="vertical-menu-btn-wrapper header-item vertical-icon">
                        <button type="button" class="btn btn-sm px-0 fs-xl vertical-menu-btn topnav-hamburger shadow hamburger-icon" id="topnav-hamburger-icon">
                            <i class='bx bx-chevrons-right'></i>
                            <i class='bx bx-chevrons-left'></i>
                        </button>
                    </div>
                </div>
            
            
                <div id="scrollbar">
                    <div class="container-fluid">
            
                        <div id="two-column-menu">
                        </div>
                        <ul class="navbar-nav" id="navbar-nav">
            
                            <li class="nav-item">
                                <a href="#sidebarHospital" class="nav-link menu-link  collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarHospital">
                                    <i class=" bx bx-buildings"></i> <span data-key="t-hospital">بیمارستان</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarHospital">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="index.html" class="nav-link" data-key="t-dashboard">داشبورد</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="doctor-appointments.html" class="nav-link" data-key="t-appointments">قرار ملاقات ها</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="doctor-staff-list.html" class="nav-link" data-key="t-staff-list">فهرست کارکنان</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="doctor-list.html" class="nav-link" data-key="t-doctors">پزشکان</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="doctor-patients.html" class="nav-link" data-key="t-patients"> بیماران</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="doctor-department.html" class="nav-link" data-key="t-department">بخش</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarEcommerce" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce">
                                    <i class="bx bx-cart-alt"></i> <span data-key="t-ecommerce">تجارت الکترونیک</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEcommerce">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="dashboard-ecommerce.html" class="nav-link" data-key="t-dashboard"> داشبورد </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-products.html" class="nav-link" data-key="t-products"> محصولات </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-product-details.html" class="nav-link" data-key="t-product-overview"> نمای کلی محصول </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-add-product.html" class="nav-link" data-key="t-add-product"> افزودن محصول </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-cart.html" class="nav-link" data-key="t-shopping-cart"> سبد خرید </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-checkout.html" class="nav-link" data-key="t-checkout"> تسویه حساب </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-orders.html" class="nav-link" data-key="t-orders"> سفارشات </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-ecommerce-customers.html" class="nav-link" data-key="t-customers"> مشتریان </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                            <li class="nav-item">
                                <a href="apps-calendar.html" class="nav-link menu-link"> <i class="bx bx-calendar"></i> <span data-key="t-calendar">تقویم</span> </a>
                            </li>
            
                            <li class="nav-item">
                                <a href="apps-chat.html" class="nav-link menu-link"> <i class="bx bx-chat"></i> <span data-key="t-chat">چت</span> </a>
                            </li>
            
                            <li class="nav-item">
                                <a href="apps-email.html" class="nav-link menu-link"> <i class="bx bx-envelope"></i> <span data-key="t-email">ایمیل</span> </a>
                            </li>
            
                            <li class="nav-item">
                                <a href="#sidebarInvoices" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoices">
                                    <i class="bx bx-file"></i> <span data-key="t-invoices">فاکتورها</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarInvoices">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-invoices-list.html" class="nav-link" data-key="t-list-view">نمایش فهرست</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-overview.html" class="nav-link" data-key="t-overview">نمای کلی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="apps-invoices-create.html" class="nav-link" data-key="t-create-invoice">ایجاد فاکتور</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                                    <i class="bx bx-user-circle"></i> <span data-key="t-authentication"> احراز هویت</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAuth">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-signin.html" class="nav-link" role="button" data-key="t-signin"> وارد شوید </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-signup.html" class="nav-link" role="button" data-key="t-signup"> ثبت نام </a>
                                        </li>
            
                                        <li class="nav-item">
                                            <a href="auth-pass-reset.html" class="nav-link" role="button" data-key="t-password-reset">
                                                بازنشانی رمز عبور
                                            </a>
                                        </li>
            
                                        <li class="nav-item">
                                            <a href="auth-pass-change.html" class="nav-link" role="button" data-key="t-password-create">
                                                ایجاد رمز عبور
                                            </a>
                                        </li>
            
                                        <li class="nav-item">
                                            <a href="auth-lockscreen.html" class="nav-link" role="button" data-key="t-lock-screen">
                                                صفحه قفل
                                            </a>
                                        </li>
            
                                        <li class="nav-item">
                                            <a href="auth-logout.html" class="nav-link" role="button" data-key="t-logout"> خروج </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-success-msg.html" class="nav-link" role="button" data-key="t-success-message"> پیام موفقیت </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-twostep.html" class="nav-link" role="button" data-key="t-two-step-verification"> تأیید دو مرحله ای </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarErrors" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarErrors" data-key="t-errors"> خطاها </a>
                                            <div class="collapse menu-dropdown" id="sidebarErrors">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="auth-404.html" class="nav-link" data-key="t-404-error"> خطای 404 </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="auth-500.html" class="nav-link" data-key="t-500"> 500 </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="auth-503.html" class="nav-link" data-key="t-503"> 503 </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="auth-offline.html" class="nav-link" data-key="t-offline-page"> صفحه آفلاین </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarPages" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                                    <i class="bx bxs-contact"></i> <span data-key="t-pages"> صفحه </span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarPages">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="pages-starter.html" class="nav-link" data-key="t-starter"> استارتر </a>
                                        </li>
                                                                               <li class="nav-item">
                                            <a href="pages-profile.html" class="nav-link" data-key="t-profile"> پروفایل </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-profile-settings.html" class="nav-link" data-key="t-profile-setting"> تنظیمات پروفایل </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-timeline.html" class="nav-link" data-key="t-timeline"> خط زمانی </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-faqs.html" class="nav-link" data-key="t-faqs"> سوالات متداول </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-pricing.html" class="nav-link" data-key="t-pricing"> قیمت‌گذاری </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-maintenance.html" class="nav-link" data-key="t-maintenance"> نگهداری </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-coming-soon.html" class="nav-link" data-key="t-coming-soon"> به زودی </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-privacy-policy.html" class="nav-link" data-key="t-privacy-policy"> سیاست حفظ حریم خصوصی </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="pages-term-conditions.html" class="nav-link" data-key="t-term-conditions"> شرایط و ضوابط </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUI">
                                    <i class="bx bx-cube"></i> <span data-key="t-bootstrap-ui">رابط کاربری بوت‌استرپ</span>
                                </a>
                                <div class="collapse menu-dropdown mega-dropdown-menu" id="sidebarUI">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="ui-alerts.html" class="nav-link" data-key="t-alerts">هشدارها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-badges.html" class="nav-link" data-key="t-badges">نشان‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-buttons.html" class="nav-link" data-key="t-buttons">دکمه‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-colors.html" class="nav-link" data-key="t-colors">رنگ‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-cards.html" class="nav-link" data-key="t-cards">کارت‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-carousel.html" class="nav-link" data-key="t-carousel">چرخ‌فلک</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-dropdowns.html" class="nav-link" data-key="t-dropdowns">منوهای کشویی</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-grid.html" class="nav-link" data-key="t-grid">شبکه</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="ui-images.html" class="nav-link" data-key="t-images">تصاویر</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-tabs.html" class="nav-link" data-key="t-tabs">زبانه‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-accordions.html" class="nav-link" data-key="t-accordion-collapse">آکاردئون و جمع‌شونده</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-modals.html" class="nav-link" data-key="t-modals">مودال‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-offcanvas.html" class="nav-link" data-key="t-offcanvas">آف‌کانواس</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-placeholders.html" class="nav-link" data-key="t-placeholders">جای‌نگهدارها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-progress.html" class="nav-link" data-key="t-progress">پیشرفت</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-notifications.html" class="nav-link" data-key="t-notifications">اعلان‌ها</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="ui-media.html" class="nav-link" data-key="t-media-object">شیء رسانه‌ای</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-embed-video.html" class="nav-link" data-key="t-embed-video">ویدئو جاسازی‌شده</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-typography.html" class="nav-link" data-key="t-typography">تایپوگرافی</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-lists.html" class="nav-link" data-key="t-lists">لیست‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-links.html" class="nav-link" data-key="t-links">لینک‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-general.html" class="nav-link" data-key="t-general">عمومی</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-ribbons.html" class="nav-link" data-key="t-ribbons">روبان‌ها</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="ui-utilities.html" class="nav-link" data-key="t-utilities">ابزارها</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarAdvanceUI" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAdvanceUI">
                                    <i class="bx bx-layer"></i> <span data-key="t-advance-ui">رابط کاربری پیشرفته</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAdvanceUI">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="advance-ui-sweetalerts.html" class="nav-link" data-key="t-sweet-alerts">هشدارهای زیبا</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="advance-ui-nestable.html" class="nav-link" data-key="t-nestable-list">لیست تو در تو</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="advance-ui-scrollbar.html" class="nav-link" data-key="t-scrollbar">نوار پیمایش</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="advance-ui-swiper.html" class="nav-link" data-key="t-swiper-slider">اسلایدر سوایپر</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="advance-ui-ratings.html" class="nav-link" data-key="t-ratings">رتبه‌بندی‌ها</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="advance-ui-highlight.html" class="nav-link" data-key="t-highlight">برجسته‌سازی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="advance-ui-scrollspy.html" class="nav-link" data-key="t-scrollSpy">اسکرول‌اسپای</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                                                        <li class="nav-item">
                                <a class="nav-link menu-link" href="widgets.html">
                                    <i class="bx bx-pen"></i> <span data-key="t-widgets">ویجت‌ها</span>
                                </a>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarForms" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarForms">
                                    <i class="bx bx-copy-alt"></i> <span data-key="t-forms">فرم‌ها</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarForms">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="forms-elements.html" class="nav-link" data-key="t-basic-elements">عناصر پایه</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-select.html" class="nav-link" data-key="t-form-select">انتخاب فرم</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-checkboxs-radios.html" class="nav-link" data-key="t-checkboxes-radios">چک‌باکس‌ها و رادیوها</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-pickers.html" class="nav-link" data-key="t-pickers">انتخاب‌گرها</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-masks.html" class="nav-link" data-key="t-input-masks">ماسک‌های ورودی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-advanced.html" class="nav-link" data-key="t-advanced">پیشرفته</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-range-sliders.html" class="nav-link" data-key="t-range-slider">اسلایدر محدوده</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-validation.html" class="nav-link" data-key="t-validation">اعتبارسنجی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-wizard.html" class="nav-link" data-key="t-wizard">ویزارد</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-editors.html" class="nav-link" data-key="t-editors">ویرایشگرها</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-file-uploads.html" class="nav-link" data-key="t-file-uploads">آپلود فایل</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="forms-layouts.html" class="nav-link" data-key="t-form-layouts">چیدمان فرم</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                                                        <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarTables" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTables">
                                    <i class="bx bx-table"></i> <span data-key="t-tables">جداول</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarTables">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="tables-basic.html" class="nav-link" data-key="t-basic-tables">جداول پایه</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="tables-gridjs.html" class="nav-link" data-key="t-grid-js">گرید جی‌اس</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="tables-listjs.html" class="nav-link" data-key="t-list-js">لیست جی‌اس</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="tables-datatables.html" class="nav-link" data-key="t-datatables">دیتا تیبلز</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarCharts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCharts">
                                    <i class="bx bx-pie-chart-alt-2"></i> <span data-key="t-apexcharts">اپکس‌چارت‌ها</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarCharts">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="charts-apex-line.html" class="nav-link" data-key="t-line">خطی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-area.html" class="nav-link" data-key="t-area">ناحیه‌ای</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-column.html" class="nav-link" data-key="t-column">ستونی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-bar.html" class="nav-link" data-key="t-bar">میله‌ای</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-mixed.html" class="nav-link" data-key="t-mixed">ترکیبی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-timeline.html" class="nav-link" data-key="t-timeline">خط زمانی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-range-area.html" class="nav-link" data-key="t-range-area">ناحیه محدوده</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-funnel.html" class="nav-link" data-key="t-funnel">قیفی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-candlestick.html" class="nav-link" data-key="t-candlstick">شمعی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-boxplot.html" class="nav-link" data-key="t-boxplot">باکس‌پلات</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-bubble.html" class="nav-link" data-key="t-bubble">حبابی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-scatter.html" class="nav-link" data-key="t-scatter">پراکنده</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-heatmap.html" class="nav-link" data-key="t-heatmap">نقشه حرارتی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-treemap.html" class="nav-link" data-key="t-treemap">نقشه درختی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-pie.html" class="nav-link" data-key="t-pie">دایره‌ای</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-radialbar.html" class="nav-link" data-key="t-radialbar">میله‌ای شعاعی</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-radar.html" class="nav-link" data-key="t-radar">رادار</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="charts-apex-polar.html" class="nav-link" data-key="t-polar-area">ناحیه قطبی</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                                                        <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarIcons" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarIcons">
                                    <i class="bx bx-traffic-cone"></i> <span data-key="t-icons">آیکون‌ها</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarIcons">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="icons-remix.html" class="nav-link" data-key="t-remix">ریمیکس</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="icons-boxicons.html" class="nav-link" data-key="t-boxicons">باکس‌آیکون‌ها</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="icons-materialdesign.html" class="nav-link" data-key="t-material-design">طراحی متریال</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="icons-bootstrap.html" class="nav-link" data-key="t-bootstrap">بوت‌استرپ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="icons-phosphor.html" class="nav-link" data-key="t-phosphor">فسفر</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                            <li class="nav-item">
                                <a class="nav-link menu-link collapsed" href="#sidebarMaps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaps">
                                    <i class="bx bx-map-alt"></i> <span data-key="t-maps">نقشه‌ها</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarMaps">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="maps-google.html" class="nav-link" data-key="t-google">گوگل</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="maps-vector.html" class="nav-link" data-key="t-vector">وکتور</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="maps-leaflet.html" class="nav-link" data-key="t-leaflet">لیف‌لت</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                                                        <li class="nav-item">
                                <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                                    <i class="bx bx-share-alt"></i> <span data-key="t-multi-level">چند سطحی</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarMultilevel">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-level-1.1"> سطح ۱.۱ </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccount" data-key="t-level-1.2"> سطح
                                                ۱.۲
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarAccount">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link" data-key="t-level-2.1"> سطح ۲.۱ </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#sidebarCrm" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrm" data-key="t-level-2.2"> سطح ۲.۲
                                                        </a>
                                                        <div class="collapse menu-dropdown" id="sidebarCrm">
                                                            <ul class="nav nav-sm flex-column">
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link" data-key="t-level-3.1"> سطح ۳.۱
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link" data-key="t-level-3.2"> سطح ۳.۲
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
            
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            
                <div class="dropdown sidebar-user mt-4">
                    <button type="button" class="btn sidebar-user-button shadow-none w-100" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center overflow-hidden">
                            <img class="rounded-circle header-profile-user" src="{{ asset('assets/assets/images/users/32/avatar-1.jpg') }}" alt="Header Avatar">
                            <span class="text-start ms-xl-2 overflow-hidden flex-grow-1 sideba-user-content">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text text-truncate mb-0" data-key="t-dixie-allen">زهرا حبیبی</span>
                                <span class="d-none d-xl-block ms-1 fs-sm user-name-sub-text" data-key="t-founder">بنیانگذار</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">خوش اومدی دیکسی</h6>
                        <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-lg align-middle me-1"></i> <span class="align-middle">پروفایل</span></a>
                        <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-lg align-middle me-1"></i> <span class="align-middle">پیام ها</span></a>
                        <a class="dropdown-item" href="apps-tickets-overview.html"><i class="mdi mdi-calendar-check-outline text-muted fs-lg align-middle me-1"></i> <span class="align-middle">صفحه کار</span></a>
                        <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-lg align-middle me-1"></i> <span class="align-middle">کمک</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-lg align-middle me-1"></i> <span class="align-middle">تراز: <b>$8451.36</b></span></a>
                        <a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-success-subtle text-success mt-1 float-end">جدید</span><i class="mdi mdi-cog-outline text-muted fs-lg align-middle me-1"></i> <span class="align-middle">تنظیمات</span></a>
                        <a class="dropdown-item" href="auth-lockscreen.html"><i class="mdi mdi-lock text-muted fs-lg align-middle me-1"></i> <span class="align-middle">قفل صفحه</span></a>
                        <a class="dropdown-item" href="auth-logout.html"><i class="mdi mdi-logout text-muted fs-lg align-middle me-1"></i> <span class="align-middle" data-key="t-logout">خروج کردن</span></a>
                    </div>
                </div>
            
                <div class="sidebar-background"></div>
            </div>
