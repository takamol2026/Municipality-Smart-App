/*
   Template Name: Dosix - Admin & Dashboard Template
   Author: Themesbrand
   Website: https://Themesbrand.com/
   Contact: Themesbrand@gmail.com
   File: invoice list init js
*/

var qty = 0;
var rate = 0;
var Invoices = [
    {
        invoice_no: '24301901',
        logo_img: 'assets/images/logo-light.png',
        customer: 'تمز برند',
        email: "themesbrand@dosix.com", 
        createDate: "28 فروردین، 1402",
        dueDate: "06 اردیبهشت، 1402",
        invoice_amount: 381.76,
        status: 'پرداخت شده',
        billing_address: {
            full_name: 'تمز برند',
            address: 'خیابان آدیپیسینگ 5114، پونو، ایالات متحده 46782',
            phone: '(926) 817-7835',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'قمر پین',
            address: 'خیابان نان 534-1477، بری سنت ادموندز، فرانسه 10846',
            phone: '(926) 817-7835',
            tax: '123456789'
        },
        products: [{
            product_name: 'سوئیشرت مردانه (صورتی)',
            product_details: 'سوئیشرت چاپ گرافیکی مردانه و زنانه',
            rates: (rate = 119.99),
            quantity: (qty = 2),
            amount: (rate * qty)
        },
        {
            product_name: 'ساعت هوشمند نویز نویزفیت اندور',
            product_details: 'نمایشگر لمسی رنگی TFT 32.5 میلی‌متر (1.28 اینچ)',
            rates: (rate = 94.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        },
        {
            product_name: 'ظرف شیشه‌ای خواربار 350 میلی‌لیتری',
            product_details: 'ظرف شیشه‌ای خواربار (بسته 3 تایی، سفید)',
            rates: (rate = 24.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 381.76
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789'
        },
        order_summary: {
            sub_total: 359.96,
            estimated_tex: 64.79,
            discount: 107.99,
            shipping_charge: 65.00,
            total_amount: 381.76,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301902',
        logo_img: 'assets/images/logo-light.png',
        customer: 'آیان بوون',
        email: "ayaan@dosix.com",
        createDate: "21 مارس، 2023",
        dueDate: "21 مارس، 2023",
        invoice_amount: 359.77,
        status: 'پرداخت نشده',
        billing_address: {
            full_name: 'آیان بوون',
            address: 'P.O. Box 900 Ireland, 6694 Ullamcorper Avenue Port Pirie 37176',
            phone: '1-862-423-3347',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'قمر پین',
            address: '7288 Dignissim Rd. Villa Alegre Germany 891315',
            phone: '1-862-423-3347',
            tax: '123456789'
        },
        products: [{
            product_name: 'سوئیشرت مردانه (صورتی)',
            product_details: 'سوئیشرت چاپ گرافیکی مردانه و زنانه',
            rates: (rate = 119.99),
            quantity: (qty = 2),
            amount: (rate * qty)
        },
        {
            product_name: 'ساعت هوشمند نویز نویزفیت اندور',
            product_details: 'نمایشگر لمسی رنگی TFT 32.5 میلی‌متر (1.28 اینچ)',
            rates: (rate = 94.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 359.77
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 334.97,
            estimated_tex: 60.29,
            discount: 100.49,
            shipping_charge: 65.00,
            total_amount: 359.77,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301903',
        logo_img: 'assets/images/logo-light.png',
        customer: 'زکری استوکس',
        email: "zachary@dosix.com",
        createDate: "16 مارس، 2023",
        dueDate: "21 مارس، 2023",
        invoice_amount: 276.18,
        status: 'پرداخت شده',
        billing_address: {
            full_name: 'زکری استوکس',
            address: 'Ap #957-7519 Vel, Belgium St. Diêm Điền 88188-296',
            phone: '1-634-649-4101',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'مکنزی پیترسون',
            address: '572-7561 Tempus Ave Alajuela Spain 86558',
            phone: '1-634-649-4101',
            tax: '123456789'
        },
        products: [{
            product_name: 'سوئیشرت مردانه (صورتی)',
            product_details: 'سوئیشرت چاپ گرافیکی مردانه و زنانه',
            rates: (rate = 119.99),
            quantity: (qty = 2),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 276.18
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 239.98,
            estimated_tex: 43.20,
            discount: 71.99,
            shipping_charge: 65.00,
            total_amount: 276.18,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301904',
        logo_img: 'assets/images/logo-light.png',
        customer: 'نلسون شادن',
        email: "nelson@dosix.com",
        createDate: "27 فوریه، 2023",
        dueDate: "05 مارس، 2023",
        invoice_amount: 509.34,
        status: 'در انتظار',
        billing_address: {
            full_name: 'نلسون شادن',
            address: '983-8399 Egestas, Rd Spain. Penza 6596',
            phone: '(922) 264-4841',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'امرسون ریگز',
            address: '916-4370 Aliquet Avenue Nordhorn Spain 3200',
            phone: '(922) 264-4841',
            tax: '123456789'
        },
        products: [{
            product_name: 'سوئیشرت مردانه (صورتی)',
            product_details: 'سوئیشرت چاپ گرافیکی مردانه و زنانه',
            rates: (rate = 119.99),
            quantity: (qty = 2),
            amount: (rate * qty)
        },
        {
            product_name: 'ساعت هوشمند نویز نویزفیت اندور',
            product_details: 'نمایشگر لمسی رنگی TFT 32.5 میلی‌متر (1.28 اینچ)',
            rates: (rate = 94.99),
            quantity: (qty = 2),
            amount: (rate * qty)
        },
        {
            product_name: 'ظرف شیشه‌ای خواربار 350 میلی‌لیتری',
            product_details: 'ظرف شیشه‌ای خواربار (بسته 3 تایی، سفید)',
            rates: (rate = 24.99),
            quantity: (qty = 3),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 509.34
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 504.93,
            estimated_tex: 90.89,
            discount: 151.48,
            shipping_charge: 65.00,
            total_amount: 509.34,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301905',
        logo_img: 'assets/images/logo-light.png',
        customer: 'اوفلیا استوبر',
        email: "ophelia@dosix.com",
        createDate: "06 آوریل، 2023",
        dueDate: "12 آوریل، 2023",
        invoice_amount: 170.58,
        status: 'پرداخت نشده',
        billing_address: {
            full_name: 'اوفلیا استوبر',
            address: 'Ap #552-1397 Ac Rd Germany. Barmouth 8574',
            phone: '1-434-874-6805',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'بریتانی دنیل',
            address: 'P.O. Box 998, 9293 Quisque Avenue Puerto Montt Poland 82862',
            phone: '1-434-874-6805',
            tax: '123456789'
        },
        products: [{
            product_name: 'ساعت هوشمند نویز نویزفیت اندور',
            product_details: 'نمایشگر لمسی رنگی TFT 32.5 میلی‌متر (1.28 اینچ)',
            rates: (rate = 94.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        },
        {
            product_name: 'ظرف شیشه‌ای خواربار 350 میلی‌لیتری',
            product_details: 'ظرف شیشه‌ای خواربار (بسته 3 تایی، سفید)',
            rates: (rate = 24.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 170.58
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 119.98,
            estimated_tex: 21.60,
            discount: 35.99,
            shipping_charge: 65.00,
            total_amount: 170.58
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301906',
        logo_img: 'assets/images/logo-light.png',
        customer: 'سارای اشمیت',
        email: "sarai@dosix.com",
        createDate: "20 فوریه، 2023",
        dueDate: "26 فوریه، 2023",
        invoice_amount: 254.18,
        status: 'پرداخت شده',
        billing_address: {
            full_name: 'سارای اشمیت',
            address: '5642 Aliquam, Avenue Zielona Costa Rica Góra 21204',
            phone: '1-546-878-8131',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'سالوادور کارنی',
            address: '715-6973 Non St. Samara Peru 10513',
            phone: '1-546-878-8131',
            tax: '123456789'
        },
        products: [{
            product_name: 'سوئیشرت مردانه (صورتی)',
            product_details: 'سوئیشرت چاپ گرافیکی مردانه و زنانه',
            rates: (rate = 119.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        },
        {
            product_name: 'ساعت هوشمند نویز نویزفیت اندور',
            product_details: 'نمایشگر لمسی رنگی TFT 32.5 میلی‌متر (1.28 اینچ)',
            rates: (rate = 94.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 254.18
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 214.98,
            estimated_tex: 38.70,
            discount: 64.49,
            shipping_charge: 65.00,
            total_amount: 254.18,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301907',
        logo_img: 'assets/images/logo-light.png',
        customer: 'دیوندری هول',
        email: "deondre@dosix.com",
        createDate: "13 فوریه، 2023",
        dueDate: "19 فوریه، 2023",
        invoice_amount: 86.99,
        status: 'پرداخت شده',
        billing_address: {
            full_name: 'دیوندری هول',
            address: 'P.O. Box 332 Italy, 5256 Dignissim St. Juazeiro do Norte 646442',
            phone: '(587) 848-3170',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'کیران هلند',
            address: '150-7530 Egestas Av. Panchià Russian Federation 16807',
            phone: '(587) 848-3170',
            tax: '123456789'
        },
        products: [
        {
            product_name: 'ظرف شیشه‌ای خواربار 350 میلی‌لیتری',
            product_details: 'ظرف شیشه‌ای خواربار (بسته 3 تایی، سفید)',
            rates: (rate = 24.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 86.99
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 24.99,
            estimated_tex: 4.50,
            discount: 7.50,
            shipping_charge: 65.00,
            total_amount: 86.99,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301908',
        logo_img: 'assets/images/logo-light.png',
        customer: 'نلسون شادن',
        email: "nelson@dosix.com",
        createDate: "01 فوریه، 2023",
        dueDate: "07 فوریه، 2023",
        invoice_amount: 213.49,
        status: 'پرداخت نشده',
        billing_address: {
            full_name: 'نلسون شادن',
            address: '2935 Senectus Av. Tvedestrand Germany 66479',
            phone: '(287) 406-9128',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'یوشیو اسکینر',
            address: '101-9784 Metus Rd. Minitonas Mexico 19-154',
            phone: '(287) 406-9128',
            tax: '123456789'
        },
        products: [{
            product_name: 'سوئیشرت مردانه (صورتی)',
            product_details: 'سوئیشرت چاپ گرافیکی مردانه و زنانه',
            rates: (rate = 119.99),
            quantity: (qty = 2),
            amount: (rate * qty)
        },
        {
            product_name: 'ساعت هوشمند نویز نویزفیت اندور',
            product_details: 'نمایشگر لمسی رنگی TFT 32.5 میلی‌متر (1.28 اینچ)',
            rates: (rate = 94.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        },
        {
            product_name: 'ظرف شیشه‌ای خواربار 350 میلی‌لیتری',
            product_details: 'ظرف شیشه‌ای خواربار (بسته 3 تایی، سفید)',
            rates: (rate = 24.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 415.96
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 359.96,
            estimated_tex: 44.99,
            discount: 53.99,
            shipping_charge: 65.00,
            total_amount: 415.96,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301909',
        logo_img: 'assets/images/logo-light.png',
        customer: 'پرزی مارک',
        email: "prezy@dosix.com",
        createDate: "29 ژانویه، 2023",
        dueDate: "06 فوریه، 2023",
        invoice_amount: 381.76,
        status: 'پرداخت شده',
        billing_address: {
            full_name: 'پرزی مارک',
            address: '414-240 Odio. Rd Vietnam. Louisville 41715',
            phone: '1-681-342-7158',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'لینوس پیتس',
            address: 'Ap #280-7347 Libero. Rd. Yurimaguas Italy 881484',
            phone: '1-681-342-7158',
            tax: '123456789'
        },
        products: [{
            product_name: 'سوئیشرت مردانه (صورتی)',
            product_details: 'سوئیشرت چاپ گرافیکی مردانه و زنانه',
            rates: (rate = 119.99),
            quantity: (qty = 2),
            amount: (rate * qty)
        },
        {
            product_name: 'ساعت هوشمند نویز نویزفیت اندور',
            product_details: 'نمایشگر لمسی رنگی TFT 32.5 میلی‌متر (1.28 اینچ)',
            rates: (rate = 94.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        },
        {
            product_name: 'ظرف شیشه‌ای خواربار 350 میلی‌لیتری',
            product_details: 'ظرف شیشه‌ای خواربار (بسته 3 تایی، سفید)',
            rates: (rate = 24.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 381.76
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 359.96,
            estimated_tex: 64.79,
            discount: 107.99,
            shipping_charge: 65.00,
            total_amount: 381.76,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301910',
        logo_img: 'assets/images/logo-light.png',
        customer: 'دومنیک داک',
        email: "domenic@dosix.com",
        createDate: "17 ژانویه، 2023",
        dueDate: "23 ژانویه، 2023",
        invoice_amount: 276.18,
        status: 'بازپرداخت',
        billing_address: {
            full_name: 'دومنیک داک',
            address: 'Ap #322-2982 Lacinia Road India Moss 309511',
            phone: '1-514-596-7650',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'اتو فارل',
            address: 'Ap #827-2319 Eu Ave Bima Norway 1663',
            phone: '1-514-596-7650',
            tax: '123456789'
        },
        products: [{
            product_name: 'سوئیشرت مردانه (صورتی)',
            product_details: 'سوئیشرت چاپ گرافیکی مردانه و زنانه',
            rates: (rate = 119.99),
            quantity: (qty = 2),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'ویزا',
            card_holder_name: 'ریس جیکوبز',
            card_number: '4024007179348742',
            total_amount: 276.18
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 239.98,
            estimated_tex: 43.20,
            discount: 71.99,
            shipping_charge: 65.00,
            total_amount: 276.18,
        },
        notes: 'تمام حساب‌ها باید ظرف 7 روز از دریافت فاکتور پرداخت شوند. پرداخت از طریق چک یا کارت اعتباری یا پرداخت مستقیم آنلاین انجام می‌شود. اگر حساب ظرف 7 روز پرداخت نشود، جزئیات اعتباری ارائه شده به عنوان تأیید کار انجام شده، با هزینه توافق شده ذکر شده در بالا شارژ خواهد شد.',
        sign_img: 'assets/images/invoice-signature.svg',
    },{
        invoice_no: '24301911',
        logo_img: 'assets/images/logo-light.png',
        customer: 'پاکی ادواردز',
        email: "sdwards@dosix.com",
        createDate: "17 ژانویه، 2023",
        dueDate: "23 ژانویه، 2023",
        invoice_amount: 170.58,
        status: 'پرداخت شده',
        billing_address: {
            full_name: 'پاکی ادواردز',
            address: '2935 Senectus Av. Tvedestrand Germany 66479',
            phone: '(287) 406-9128',
            tax: '123456789'
        },
        shipping_address: {
            full_name: 'یوشیو اسکینر',
            address: '101-9784 Metus Rd. Minitonas Mexico 19-154',
            phone: '(287) 406-9128',
            tax: '123456789'
        },
        products: [{
            product_name: 'ساعت هوشمند نویز نویزفیت اندور',
            product_details: 'نمایشگر لمسی رنگی TFT 32.5 میلی‌متر (1.28 اینچ)',
            rates: (rate = 94.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        },
        {
            product_name: 'ظرف شیشه‌ای خواربار 350 میلی‌لیتری',
            product_name: '350 ml Glass Grocery Container',
            product_details: 'Glass Grocery Container (Pack of 3, White)',
            rates: (rate = 24.99),
            quantity: (qty = 1),
            amount: (rate * qty)
        }],
        payment_details: {
            payment_method: 'VISA',
            card_holder_name: 'Reese Jacobs',
            card_number: '4024007179348742',
            total_amount: 170.58
        },
        company_details: {
            legal_registration_no: "987654",
            email: 'dosix@themesbrand.com',
            website: 'www.themesbrand.com',
            contact_no: '+(01) 234 6789',
        },
        order_summary: {
            sub_total: 119.98,
            estimated_tex: 21.60,
            discount: 35.99,
            shipping_charge: 65.00,
            total_amount: 170.58
        },
        notes: 'All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or credit card or direct payment online. If account is not paid within 7 days the credits details supplied as confirmation of work undertaken will be charged the agreed quoted fee noted above.',
        sign_img: 'assets/images/invoice-signature.svg',
    }
]


// checkAll
var checkAll = document.getElementById("checkAll");
if (checkAll) {
    checkAll.onclick = function () {
        var checkboxes = document.querySelectorAll('.form-check-all input[type="checkbox"]');
        var checkedCount = document.querySelectorAll('.form-check-all input[type="checkbox"]:checked').length;
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
            if (checkboxes[i].checked) {
                checkboxes[i].closest("tr").classList.add("table-active");
            } else {
                checkboxes[i].closest("tr").classList.remove("table-active");
            }

            if (checkboxes[i].closest("tr").classList.contains("table-active")) {
                (checkedCount > 0) ? document.getElementById("remove-actions").classList.add("d-none") : document.getElementById("remove-actions").classList.remove("d-none");
            } else {
                (checkedCount > 0) ? document.getElementById("remove-actions").classList.add("d-none") : document.getElementById("remove-actions").classList.remove("d-none");
            }
        }
    };
}

if ((localStorage.getItem("invoices-list") === null) && (localStorage.getItem("new_data_object") === null)) {
    Invoices = Invoices;
} else if ((localStorage.getItem("invoices-list") === null) && (localStorage.getItem("new_data_object") !== null)) {
    var invoice_new_obj = JSON.parse(localStorage.getItem("new_data_object"));
    Invoices.push(invoice_new_obj);
    localStorage.removeItem("new_data_object");
} else {
    Invoices = [];
    Invoices = JSON.parse(localStorage.getItem("invoices-list"));
    if (localStorage.getItem("new_data_object") !== null) {
        var invoice_new_obj = JSON.parse(localStorage.getItem("new_data_object"));
        Invoices.push(invoice_new_obj);
        localStorage.removeItem("new_data_object");
    }
    localStorage.removeItem("invoices-list");
}

//ist form-check-all
Array.from(Invoices).forEach(function (raw) {
    let badge;
    switch (raw.status) {
        case 'Paid':
            badge = "success";
            break;
        case 'Pending':
            badge = "warning";
            break;
        case 'Unpaid':
            badge = "danger";
            break;
        case 'Refund':
            badge = "danger";
    }

    var tableRawData = '<tr>\
        <td>\
            <div class="form-check">\
                <input class="form-check-input" type="checkbox" name="chk_child" value="#TBS'+raw.invoice_no+'">\
                <label class="form-check-label"></label>\
            </div>\
        </td>\
        <td class="invoice_id"><a href="apps-invoices-overview.html">#TBS'+raw.invoice_no+'</a></td>\
        <td class="customer_name">'+raw.customer+'</td>\
        <td class="email">'+raw.email+'</td>\
        <td class="create_date">'+raw.createDate+'</td>\
        <td class="due_date">'+raw.dueDate+'</td>\
        <td class="amount">$'+(raw.invoice_amount)+'</td>\
        <td class="status"><span class="badge bg-'+badge+'-subtle text-'+badge+'">'+raw.status+'</span></td>\
        <td>\
            <ul class="d-flex gap-2 list-unstyled mb-0">\
                <li>\
                    <a href="javascript:void(0);" class="btn btn-subtle-primary btn-icon btn-sm" onclick="ViewInvoice(this);"  data-view-id="'+raw.invoice_no+'"><i class="ph-eye"></i></a>\
                </li>\
                <li>\
                    <a href="javascript:void(0);" class="btn btn-subtle-secondary btn-icon btn-sm" onclick="EditInvoice(this);" data-edit-id="'+raw.invoice_no+'"><i class="ph-pencil"></i></a>\
                </li>\
                <li>\
                    <a href="#deleteRecordModal" data-bs-toggle="modal" class="btn btn-subtle-danger btn-icon btn-sm remove-item-btn"><i class="ph-trash"></i></a>\
                </li>\
            </ul>\
        </td>\
    </tr>';

    document.getElementById('invoice-list-data').innerHTML += tableRawData;
});



//invoiceList Table
var perPage = 10;
var options = {
    valueNames: [
        "invoice_id",
        "customer_name",
        "email",
        "amount",
        "create_date",
        "due_date",
        "status"
    ],
    page: perPage,
    pagination: true,
    plugins: [
        ListPagination({
            left: 2,
            right: 2,
        }),
    ],
};

// Init list
var invoiceList = new List("invoiceList", options).on("updated", function (list) {
    list.matchingItems.length == 0 ?
        (document.getElementsByClassName("noresult")[0].style.display = "block") :
        (document.getElementsByClassName("noresult")[0].style.display = "none");
    var isFirst = list.i == 1;
    var isLast = list.i > list.matchingItems.length - list.page;
    // make the Prev and Nex buttons disabled on first and last pages accordingly
    document.querySelector(".pagination-prev.disabled") ?
        document.querySelector(".pagination-prev.disabled").classList.remove("disabled") : "";
    document.querySelector(".pagination-next.disabled") ?
        document.querySelector(".pagination-next.disabled").classList.remove("disabled") : "";
    if (isFirst) {
        document.querySelector(".pagination-prev").classList.add("disabled");
    }
    if (isLast) {
        document.querySelector(".pagination-next").classList.add("disabled");
    }
    if (list.matchingItems.length <= perPage) {
        document.getElementById("pagination-element").style.display = "none";
    } else {
        document.getElementById("pagination-element").style.display = "flex";
    }

    if (list.matchingItems.length > 0) {
        document.getElementsByClassName("noresult")[0].style.display = "none";
    } else {
        document.getElementsByClassName("noresult")[0].style.display = "block";
    }
}); 

document.querySelector(".pagination-next").addEventListener("click", function () {
    document.querySelector(".pagination.listjs-pagination") ?
        document.querySelector(".pagination.listjs-pagination").querySelector(".active") && document.querySelector(".pagination.listjs-pagination").querySelector(".active").nextElementSibling != null ?
            document.querySelector(".pagination.listjs-pagination").querySelector(".active").nextElementSibling.children[0].click() : "" : "";
});

document.querySelector(".pagination-prev").addEventListener("click", function () {
    document.querySelector(".pagination.listjs-pagination") ?
        document.querySelector(".pagination.listjs-pagination").querySelector(".active") && document.querySelector(".pagination.listjs-pagination").querySelector(".active").previousSibling != null ?
            document.querySelector(".pagination.listjs-pagination").querySelector(".active").previousSibling.children[0].click() : "" : "";
});

var removeBtns = document.getElementsByClassName("remove-item-btn");
refreshCallbacks();
isCheckboxCheck();

function ViewInvoice(data) {
    var invoice_no = data.getAttribute('data-view-id');
    localStorage.setItem("invoices-list", JSON.stringify(Invoices));
    localStorage.setItem("option", "view-invoice");
    localStorage.setItem("invoice_no", invoice_no);
    window.location.assign("apps-invoices-overview.html")
}

function EditInvoice(data) {
    var invoice_no = data.getAttribute('data-edit-id');
    localStorage.setItem("invoices-list", JSON.stringify(Invoices));
    localStorage.setItem("option", "edit-invoice");
    localStorage.setItem("invoice_no", invoice_no);
    window.location.assign("apps-invoices-create.html")
}

function isCheckboxCheck() {
    Array.from(document.getElementsByName("chk_child")).forEach(function (x) {
        x.addEventListener("change", function (e) {
            if (x.checked == true) {
                e.target.closest("tr").classList.add("table-active");
            } else {
                e.target.closest("tr").classList.remove("table-active");
            }
  
            var checkedCount = document.querySelectorAll('[name="chk_child"]:checked').length;
            if (e.target.closest("tr").classList.contains("table-active")) {
                (checkedCount > 0) ? document.getElementById("remove-actions").classList.remove("d-none"): document.getElementById("remove-actions").classList.add("d-none");
            } else {
                (checkedCount > 0) ? document.getElementById("remove-actions").classList.remove("d-none"): document.getElementById("remove-actions").classList.add("d-none");
            }
        });
    });
}

function refreshCallbacks() {
    Array.from(removeBtns).forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.target.closest("tr").children[1].innerText;
            itemId = e.target.closest("tr").children[1].innerText;
            var itemValues = invoiceList.get({
                invoice_id: itemId,
            });

            Array.from(itemValues).forEach(function (x) {
                deleteId = new DOMParser().parseFromString(x._values.invoice_id, "text/html");

                var isElem = deleteId.body.firstElementChild;
                var isDeleteId = deleteId.body.firstElementChild.innerHTML;
                if (isDeleteId == itemId) {
                    document.getElementById("delete-record").addEventListener("click", function () {
                        invoiceList.remove("invoice_id", isElem.outerHTML);
                        document.getElementById("deleteRecord-close").click();
                    });
                }
            });
        });
    });
}

// Delete Multiple Records
function deleteMultiple() {
    ids_array = [];
    var items = document.getElementsByName('chk_child');
    for (i = 0; i < items.length; i++) {
        if (items[i].checked == true) {
            ids_array.push(items[i].value);
        }
    }
    
    if (typeof ids_array !== 'undefined' && ids_array.length > 0) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            customClass: {
                confirmButton: 'btn btn-primary w-xs me-2 mt-2',
                cancelButton: 'btn btn-danger w-xs mt-2',
            },
            confirmButtonText: "Yes, delete it!",
            buttonsStyling: false,
            showCloseButton: true
        }).then(function (result) {
            if (result.value) {
                for (i = 0; i < ids_array.length; i++) {
                    invoiceList.remove("invoice_id", `<a href="apps-invoices-overview.html">${ids_array[i]}</a>`);
                }
                document.getElementById("remove-actions").classList.add("d-none");
                document.getElementById("checkAll").checked = false;
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your data has been deleted.',
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-info w-xs mt-2',
                    },
                    buttonsStyling: false
                });
            }
        });
    } else {
        Swal.fire({
            title: 'Please select at least one checkbox',
            customClass: {
                confirmButton: 'btn btn-info',
            },
            buttonsStyling: false,
            showCloseButton: true
        });
    }
}