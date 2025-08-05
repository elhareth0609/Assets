@php
    $isNavbar = $isNavbar ?? true;
    $isSidebar = $isSidebar ?? true;
    $isFooter = $isFooter ?? true;
    $isContainer = $isContainer ?? true;
@endphp

<!DOCTYPE html>
<html lang="ar" dir="rtl" class="dark">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg+xml" href="/vite.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Perfume Store Inventory</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery.min.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}?v={{ time() }}"></script>

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

    {{-- CSS Styles --}}
    @if ($isContainer)
        <style>
            /* Base transition for smooth resizing */
            #sidebar, #main-content {
                transition: all 0.3s ease-in-out;
            }

            /* Desktop Sidebar Collapse Styles */
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
                padding: 0rem;
            }
            body.sidebar-collapsed .sidebar-item-container {
                justify-content: center;
            }
            /* body.sidebar-collapsed ul li button {
                display: none;
            }*/
            body.sidebar-collapsed ul li .submenu {
                display: none;
            }
            body ul li ul li a {
                justify-content: start;
                padding-right: 2rem;
            }
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

            /* Mobile Responsive Styles */
            .sidebar-transition {
                transition: transform 0.3s ease-in-out;
            }

            .sidebar-overlay {
                transition: opacity 0.3s ease-in-out;
            }
        </style>
        <style>
            /* Hide sidebar on small screens by default */
            @media (max-width: 1023px) {
                #sidebar {
                    transform: translateX(100%);
                }

                #sidebar.show-mobile {
                    transform: translateX(0);
                }

                /* Adjust main content for mobile */
                #main-content {
                    margin-right: 0 !important;
                }
            }

            /* Ensure sidebar is visible on large screens */
            @media (min-width: 1024px) {
                #sidebar {
                    transform: translateX(0) !important;
                }

                /* Default margin for large screens */
                #main-content {
                    margin-right: 16rem; /* 256px - sidebar width */
                }
            }

            /* Chevron animation */
            .chevron-icon {
                transition: transform 0.2s ease-in-out;
            }
            .chevron-icon.rotated {
                transform: rotate(180deg);
            }
        </style>
    @endif
    @yield('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden sidebar-overlay"></div>

    @if($isSidebar)
        @include('layouts.sidebar')
    @endif

    @if($isNavbar)
        @include('layouts.header')
    @endif

    {{-- Main Content Area --}}
    <div id="main-content" class="min-h-screen">
        @yield('content')
    </div>

    @if($isFooter)
        {{-- @include('layouts.footer') --}}
    @endif

    {{-- JavaScript --}}
    <script>
        $(document).ready(function() {
            // Initialize theme button
            if (typeof updateThemeButton === 'function') {
                updateThemeButton();
            }

            $('#theme-toggle-button').on('click', function () {
                $('html').toggleClass('dark');
                if ($('html').hasClass('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
                updateThemeButton();
            });

            // Desktop sidebar toggle functionality
            $('#sidebar-toggle').on('click', function() {
                $('body').toggleClass('sidebar-collapsed');

                // Save state to localStorage
                const isCollapsed = $('body').hasClass('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', isCollapsed);
            });

            // Restore sidebar state from localStorage
            if (localStorage.getItem('sidebar-collapsed') === 'true') {
                $('body').addClass('sidebar-collapsed');
            }
        });

        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const avatarButton = document.getElementById('avatar-button');
            const dropdownMenu = document.getElementById('dropdown-menu');

            // Toggle mobile menu
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', () => {
                    sidebar.classList.add('show-mobile');
                    sidebarOverlay.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                });
            }

            // Close mobile menu
            function closeMobileMenu() {
                if (sidebar) sidebar.classList.remove('show-mobile');
                if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
                document.body.style.overflow = '';
            }

            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', closeMobileMenu);
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', closeMobileMenu);
            }

            // Avatar dropdown functionality
            if (avatarButton && dropdownMenu) {
                avatarButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!avatarButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            }

            // Collapsible menu functionality
            document.querySelectorAll('.menu-toggle-button').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const submenu = button.nextElementSibling;
                    const chevron = button.querySelector('.chevron-icon');

                    if (!submenu) return;

                    // Check if submenu is currently collapsed
                    const isCollapsed = submenu.style.maxHeight === '0px' || submenu.style.maxHeight === '';

                    if (isCollapsed) {
                        // Expand the submenu
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        if (chevron) chevron.style.transform = 'rotate(180deg)';
                        button.setAttribute('aria-expanded', 'true');
                    } else {
                        // Collapse the submenu
                        submenu.style.maxHeight = '0px';
                        if (chevron) chevron.style.transform = 'rotate(0deg)';
                        button.setAttribute('aria-expanded', 'false');
                    }
                });
            });

            // Initialize submenu states on page load
            document.querySelectorAll('.submenu').forEach(submenu => {
                const currentUrl = window.location.href;
                const hasActiveLink = Array.from(submenu.querySelectorAll('a')).some(link => {
                    const href = link.getAttribute('href');
                    return href && currentUrl.includes(href);
                });

                if (hasActiveLink) {
                    // Expand if contains active link
                    submenu.style.maxHeight = submenu.scrollHeight + 'px';
                    const toggleButton = submenu.previousElementSibling;
                    if (toggleButton) {
                        const chevron = toggleButton.querySelector('.chevron-icon');
                        if (chevron) chevron.style.transform = 'rotate(180deg)';
                        toggleButton.setAttribute('aria-expanded', 'true');
                    }
                } else {
                    // Collapse by default
                    submenu.style.maxHeight = '0px';
                    const toggleButton = submenu.previousElementSibling;
                    if (toggleButton) {
                        const chevron = toggleButton.querySelector('.chevron-icon');
                        if (chevron) chevron.style.transform = 'rotate(0deg)';
                        toggleButton.setAttribute('aria-expanded', 'false');
                    }
                }
            });

            // Handle window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    // Large screen - ensure sidebar is visible and overlay is hidden
                    if (sidebar) sidebar.classList.remove('show-mobile');
                    if (sidebarOverlay) sidebarOverlay.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });

            // Close mobile menu when clicking on links
            document.querySelectorAll('#sidebar a').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 1024) {
                        closeMobileMenu();
                    }
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
