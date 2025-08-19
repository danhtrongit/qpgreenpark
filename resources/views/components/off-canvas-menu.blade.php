<div id="off-canvas-menu"
     class="fixed top-0 left-0 z-50 h-screen w-screen bg-primary-950 shadow-2xl overflow-hidden"
     tabindex="-1"
     aria-labelledby="off-canvas-menu-label"
     aria-modal="true"
     role="dialog">

    {{-- Decorative floating shapes --}}
    <div class="menu-shape-1"></div>
    <div class="menu-shape-2"></div>
    <div class="menu-shape-3"></div>

    <div class="container h-full mx-auto p-4 pt-16 flex flex-col relative z-10">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-8">
            <a class="brand" href="{{ home_url('/') }}">
                <img
                    class="w-40 lg:w-60 h-auto"
                    src="/wp-content/uploads/2025/08/logo-text.svg"
                    alt="{{ \App\get_company_name() }}"
                >
            </a>

            <button
                id="close-off-canvas-menu"
                class="bg-secondary-mid-lighter/5 rounded size-8 grid content-center p-2 hover:bg-secondary-mid-lighter/50 transition-all"
                aria-label="Đóng menu điều hướng"
            >
                <i class="fa-light fa-xmark"></i>
            </button>
        </div>

        {{-- Main Content Area --}}
        <div class="flex flex-1 items-center justify-center">
            <div class="w-full grid lg:grid-cols-2 items-center gap-8 lg:gap-16">

                {{-- Left Column: Logo & Social --}}
                <div class="col-span-1 text-center">
                    {{-- Company Logo --}}
                    <div class="mb-8 company-logo">
                        <img
                            class="w-40 lg:w-60 mx-auto h-auto"
                            src="/wp-content/uploads/2025/08/logo.svg"
                            alt="{{ \App\get_company_name() }}"
                        >
                    </div>

                    {{-- Contact Info --}}
                    <div class="mb-8 space-y-4 text-left max-w-sm mx-auto">
                        <div class="flex items-center gap-3 contact-item">
                            <div class="w-10 h-10 bg-secondary-mid/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fa-light fa-phone text-secondary-dark"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Hotline</p>
                                <a href="tel:{{ \App\get_contact_phone_link() }}" class="text-white hover:text-secondary-dark transition-colors">
                                    {{ \App\get_contact_phone() }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 contact-item">
                            <div class="w-10 h-10 bg-secondary-mid/20 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fa-light fa-envelope text-secondary-dark"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400">Email</p>
                                <a href="mailto:{{ \App\get_contact_email() }}" class="text-white hover:text-secondary-dark transition-colors">
                                    {{ \App\get_contact_email() }}
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    @if(\App\get_social_links())
                        <div class="space-x-4 flex justify-center social-links">
                            @foreach(\App\get_social_links() as $social)
                                <a href="{{ $social['url'] }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="flex size-10 items-center justify-center rounded-full bg-secondary-mid/10 text-white transition-all duration-300 hover:scale-110 hover:bg-secondary-mid"
                                   title="{{ $social['name'] }}">
                                    <i class="{{ $social['icon'] }} text-lg"></i>
                                </a>
                            @endforeach
                        </div>
                    @else
                        {{-- Fallback social icons if none configured --}}
                        <div class="space-x-4 flex justify-center social-links">
                            <a href="#" class="flex size-10 items-center justify-center rounded-full bg-secondary-mid/10 text-white transition-all duration-300 hover:scale-110 hover:bg-secondary-mid">
                                <i class="fa-brands fa-facebook-f text-lg"></i>
                            </a>
                            <a href="#" class="flex size-10 items-center justify-center rounded-full bg-secondary-mid/10 text-white transition-all duration-300 hover:scale-110 hover:bg-secondary-mid">
                                <i class="fa-brands fa-youtube text-lg"></i>
                            </a>
                            <a href="#" class="flex size-10 items-center justify-center rounded-full bg-secondary-mid/10 text-white transition-all duration-300 hover:scale-110 hover:bg-secondary-mid">
                                <i class="fa-brands fa-linkedin text-lg"></i>
                            </a>
                            <a href="#" class="flex size-10 items-center justify-center rounded-full bg-secondary-mid/10 text-white transition-all duration-300 hover:scale-110 hover:bg-secondary-mid">
                                <i class="fa-brands fa-instagram text-lg"></i>
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Right Column: Navigation Menu --}}
                <div class="col-span-1">
                    <nav aria-label="Menu điều hướng chính">
                        <h2 class="sr-only">Menu điều hướng</h2>
                        @if(has_nav_menu('primary_navigation'))
                            {!! wp_nav_menu([
                                'theme_location' => 'primary_navigation',
                                'menu_id' => 'off-canvas-navigation',
                                'menu_class' => 'grid lg:grid-cols-2 gap-4',
                                'container' => 'ul',
                                'walker' => new \App\Support\OffCanvasMenuWalker(),
                            ]) !!}
                        @else
                            {{-- Fallback menu with 2-column layout --}}
                            <ul class="grid lg:grid-cols-2 gap-4">
                                <li>
                                    <a href="{{ home_url('/') }}" class="block py-4 px-6 text-white text-lg font-medium transition-all duration-300 border-b-2 border-transparent hover:text-secondary-dark hover:border-secondary-dark">
                                        Trang chủ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ home_url('/gioi-thieu') }}" class="block py-4 px-6 text-white text-lg font-medium transition-all duration-300 border-b-2 border-transparent hover:text-secondary-dark hover:border-secondary-dark">
                                        Giới thiệu
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ home_url('/tien-ich') }}" class="block py-4 px-6 text-white text-lg font-medium transition-all duration-300 border-b-2 border-transparent hover:text-secondary-dark hover:border-secondary-dark">
                                        Tiện ích
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ home_url('/tin-tuc') }}" class="block py-4 px-6 text-white text-lg font-medium transition-all duration-300 border-b-2 border-transparent hover:text-secondary-dark hover:border-secondary-dark">
                                        Tin tức
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ home_url('/lien-he') }}" class="block py-4 px-6 text-white text-lg font-medium transition-all duration-300 border-b-2 border-transparent hover:text-secondary-dark hover:border-secondary-dark">
                                        Liên hệ
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ home_url('/thu-vien') }}" class="block py-4 px-6 text-white text-lg font-medium transition-all duration-300 border-b-2 border-transparent hover:text-secondary-dark hover:border-secondary-dark">
                                        Thư viện
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
