        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/assets/js/plugins.js') }}"></script>
        <!-- App js -->
        <script src="{{ asset('assets/assets/js/app.js') }}"></script>
        <script>
            (function () {
                var defaults = @json(\App\Support\ThemePreference::defaults());
                var keys = Object.keys(defaults);
                var panel = document.getElementById('theme-settings-offcanvas');
                var timer = null;

                function token() {
                    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                }

                function currentTheme() {
                    var data = Object.assign({}, defaults);

                    keys.forEach(function (key) {
                        if (key === 'data-layout-auto') {
                            data[key] = sessionStorage.getItem(key) === 'true' ? 'true' : 'false';
                            return;
                        }

                        var value = document.documentElement.getAttribute(key);

                        if (value) {
                            data[key] = value;
                        }
                    });

                    return data;
                }

                function persist(theme) {
                    Object.keys(theme).forEach(function (key) {
                        sessionStorage.setItem(key, theme[key]);
                    });

                    fetch(@json(route('theme.update')), {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token(),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin',
                        keepalive: true,
                        body: JSON.stringify(theme)
                    });
                }

                function save() {
                    window.clearTimeout(timer);
                    timer = window.setTimeout(function () {
                        persist(currentTheme());
                    }, 50);
                }

                window.addEventListener('pagehide', function () {
                    if (timer !== null) {
                        window.clearTimeout(timer);
                        timer = null;
                        persist(currentTheme());
                    }
                });

                panel?.addEventListener('change', function (event) {
                    if (event.target && event.target.name && Object.prototype.hasOwnProperty.call(defaults, event.target.name)) {
                        document.documentElement.setAttribute(event.target.name, event.target.value);
                        save();
                    }
                });

                document.getElementById('light-dark-mode')?.addEventListener('click', function (event) {
                    if (event.target.closest('[data-mode]')) {
                        window.setTimeout(save, 0);
                    }
                });

                document.getElementById('vertical-hover')?.addEventListener('click', function () {
                    window.setTimeout(save, 0);
                });

                document.getElementById('reset-layout')?.addEventListener('click', function (event) {
                    event.preventDefault();
                    event.stopImmediatePropagation();

                    fetch(@json(route('theme.reset')), {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': token(),
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        credentials: 'same-origin',
                        keepalive: true
                    }).finally(function () {
                        sessionStorage.clear();
                        window.location.reload();
                    });
                }, true);
            })();
        </script>
