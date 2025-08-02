@php
    $isNavbar = $isNavbar ?? true;
    $isSidebar = $isSidebar ?? true;
    $isFooter = $isFooter ?? true;
    $isContainer = $isContainer ?? true;
@endphp
<!DOCTYPE html>



<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="/vite.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfume Store Inventory</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery.min.js') }}?v={{ time() }}"></script>

    {{-- Scripts (Tailwind is loaded first) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Custom Tailwind Config --}}
    <script>

        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        function updateThemeButton() {
            if ($('html').hasClass('dark')) {
                // Currently in dark mode, so show the "switch to light" button
                $('#theme-toggle-button .theme-icon-container').eq(0).show(); // Show Sun
                $('#theme-toggle-button .theme-icon-container').eq(1).hide(); // Hide Moon
                $('#theme-toggle-button .theme-text-container').eq(0).show(); // Show "الوضع الفاتح"
                $('#theme-toggle-button .theme-text-container').eq(1).hide(); // Hide "الوضع الداكن"
            } else {
                // Currently in light mode, so show the "switch to dark" button
                $('#theme-toggle-button .theme-icon-container').eq(0).hide();  // Hide Sun
                $('#theme-toggle-button .theme-icon-container').eq(1).show();  // Show Moon
                $('#theme-toggle-button .theme-text-container').eq(0).hide(); // Hide "الوضع الفاتح"
                $('#theme-toggle-button .theme-text-container').eq(1).show(); // Show "الوضع الداكن"
            }
        }

        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                colors: {
                    primary: {
                        50: '#f5f3ff',
                        100: '#ede9fe',
                        200: '#ddd6fe',
                        300: '#c4b5fd',
                        400: '#a78bfa',
                        500: '#8b5cf6',
                        600: '#7c3aed',
                        700: '#6d28d9',
                        800: '#5b21b6',
                        900: '#4c1d95',
                        950: '#2e1065',
                    },
                    secondary: {
                        50: '#fdf8e9',
                        100: '#f7e9c1',
                        200: '#f1d98a',
                        300: '#eac253',
                        400: '#e4b02d',
                        500: '#d49614',
                        600: '#bd7e10',
                        700: '#a2660d',
                        800: '#8c530a',
                        900: '#7a4308',
                        950: '#412103',
                    },
                    accent: {
                        50: '#edfcf9',
                        100: '#d1f6ef',
                        200: '#a6ebdf',
                        300: '#6edad0',
                        400: '#34c0b8',
                        500: '#1aa39c',
                        600: '#158483',
                        700: '#146869',
                        800: '#145356',
                        900: '#144549',
                        950: '#07302e',
                    },
                },
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                    display: ['Poppins', 'sans-serif'],
                },
                }
            }
        }
    </script>
    @if($isContainer)
    {{-- CSS for Sidebar States --}}
        <style>
            /* Base transition for smooth resizing */
            #sidebar, #main-content {
                transition: all 0.3s ease-in-out;
            }

            /* Styles for when the sidebar is collapsed */
            body.sidebar-collapsed #sidebar {
                width: 5rem; /* 80px */
            }
            body.sidebar-collapsed #main-content {
                margin-right: 5rem; /* 80px */
            }
            body.sidebar-collapsed .sidebar-text {
                display: none;
            }
            body.sidebar-collapsed li:has(div.sidebar-text) {
                padding: 0rem;;
            }
            body.sidebar-collapsed .sidebar-item-container {
                justify-content: center;
            }
            body.sidebar-collapsed ul li button {
                display: none;
            }
            body ul li ul li a {
                justify-content: start;
                padding-right: 2rem;
            }
            /* body.sidebar-collapsed header {
                padding-right: 80px;
            }
            body header {
                padding-right: 250px;
            } */
            body.sidebar-collapsed ul li ul li a {
                justify-content: center;
                padding-right: 0rem;
            }
            body.sidebar-collapsed ul li ul li a span {
                display: none;
            }
            body.sidebar-collapsed #sidebar-toggle .chevron-icon {
                transform: rotate(180deg);
            }
            /* Styles for menu dropdown chevrons */
            .chevron-icon {
                transition: transform 0.2s ease-in-out;
            }
            .chevron-icon.rotated {
                transform: rotate(180deg);
            }
        </style>
    @endif
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-200">
    <div id="root">
        @if($isSidebar)
            @include('layouts.sidebar')
        @endif
        @if($isNavbar)
            @include('layouts.header')
        @endif

        {{-- Main Content Area with an ID for jQuery selection --}}
        <div id="main-content" class="{{ $isContainer ? 'rtl:ms-64' : 'container mx-auto px-4' }}">
            <main class="py-4 px-1">
                @yield('content')
            </main>
        </div>
        @if($isFooter)
            {{-- @include('layouts.footer') --}}
        @endif
    </div>

    {{-- jQuery and Custom Scripts --}}
    @if($isContainer)
        <script>
            $(document).ready(function() {
                // 1. Handle Main Sidebar Collapse/Expand
                $('#sidebar-toggle').on('click', function () {
                    const isCollapsed = $('body').hasClass('sidebar-collapsed');

                    // Toggle sidebar state
                    $('body').toggleClass('sidebar-collapsed');

                    if (!isCollapsed) {
                        // الآن سيتم إغلاق الشريط الجانبي
                        // افتح جميع القوائم غير المفتوحة
                        $('.menu-toggle-button').each(function () {
                            const submenu = $(this).next('ul');
                            if (!submenu.is(':visible')) {
                                submenu.slideDown(0); // افتح فورًا بدون أن يرى المستخدم الانزلاق
                                $(this).find('.chevron-icon').addClass('rotated');
                            }
                        });
                    } else {
                        // الآن سيتم فتح الشريط الجانبي
                        // أغلق جميع القوائم ما عدا التي تحتوي على عنصر نشط
                        $('.menu-toggle-button').each(function () {
                            const submenu = $(this).next('ul');
                            if (!submenu.find('.active').length) {
                                submenu.slideUp(0); // أغلق فورًا
                                $(this).find('.chevron-icon').removeClass('rotated');
                            }
                        });
                    }
                });


                // 2. Handle Individual Menu Dropdowns
                $('.menu-toggle-button').on('click', function() {
                    // Toggle the chevron icon rotation
                    $(this).find('.chevron-icon').toggleClass('rotated');

                    // Find the next 'ul' element (the submenu) and slide it up or down
                    $(this).next('ul').slideToggle('fast');
                });

                // Keep menus that were open in the original HTML open by default
                // To have them start closed, you can add `style="display:none;"` to the `<ul>` tags.
                $('.menu-toggle-button').each(function() {
                    if ($(this).next('ul').is(':visible')) {
                        $(this).find('.chevron-icon').addClass('rotated');
                    }
                });
                // --- NEW: Theme Toggle Logic ---

                // 1. Set the initial state of the button on page load
                updateThemeButton();

                // 2. Handle the click event
                $('#theme-toggle-button').on('click', function() {
                    // Toggle the 'dark' class on the <html> element
                    $('html').toggleClass('dark');

                    // Check the new state and save it to localStorage
                    if ($('html').hasClass('dark')) {
                        localStorage.setItem('theme', 'dark');
                    } else {
                        localStorage.setItem('theme', 'light');
                    }

                    // Update the button's appearance to reflect the change
                    updateThemeButton();
                });




                const $dropdown = $('#dropdown-menu');
                const $avatarBtn = $('#avatar-button');

                // عند الضغط على الزر: إظهار / إخفاء القائمة
                $avatarBtn.on('click', function (e) {
                    e.stopPropagation(); // منع انتشار الحدث لتفادي الإغلاق الفوري
                    $dropdown.toggleClass('hidden');
                });

                // عند الضغط خارج القائمة: إخفاؤها
                $(document).on('click', function () {
                    if (!$dropdown.hasClass('hidden')) {
                        $dropdown.addClass('hidden');
                    }
                });

                // منع إغلاق القائمة عند الضغط داخلها
                $dropdown.on('click', function (e) {
                    e.stopPropagation();
                });

            });
        </script>
    @endif
</body>
</html>
