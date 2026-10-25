        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/assets/images/municipality_logo.jpg') }}">
        
        <!-- Fonts css load -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
        
        <script>
            (function () {
                var theme = @json(\App\Support\ThemePreference::all());
                var root = document.documentElement;

                Object.keys(theme).forEach(function (key) {
                    if (!theme[key]) {
                        return;
                    }

                    sessionStorage.setItem(key, theme[key]);

                    if (key !== 'data-layout-auto') {
                        root.setAttribute(key, theme[key]);
                    }
                });

                root.classList.toggle('mode-auto', theme['data-layout-auto'] === 'true');

                var snapshot = {};
                Array.from(root.attributes).forEach(function (attribute) {
                    if (attribute.nodeName && attribute.nodeName !== 'undefined') {
                        snapshot[attribute.nodeName] = attribute.nodeValue;
                    }
                });
                sessionStorage.setItem('defaultAttribute', JSON.stringify(snapshot));
            })();
        </script>
        <!-- Layout config Js -->
        <script src="{{ asset('assets/assets/js/layout.js') }}"></script>
        @php
            $isRtl = config('locales.supported.'.app()->getLocale().'.dir', 'rtl') === 'rtl';
        @endphp
        <!-- Bootstrap Css -->
        <link href="{{ asset($isRtl ? 'assets/assets/css/bootstrap-rtl.min.css' : 'assets/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <!-- Icons Css -->
        <link href="{{ asset('assets/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
        <!-- App Css-->
        <link href="{{ asset($isRtl ? 'assets/assets/css/app-rtl.min.css' : 'assets/assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
        <!-- custom Css-->
        <link href="{{ asset($isRtl ? 'assets/assets/css/custom-rtl.min.css' : 'assets/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css">
        @if (app()->getLocale() === 'ps')
            <link href="{{ asset('assets/assets/css/pashto-font.css') }}" rel="stylesheet" type="text/css">
        @endif
