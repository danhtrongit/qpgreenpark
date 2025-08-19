{{-- Header Section --}}
<header class="banner fixed top-0 w-full z-40">
    <div class="container px-4">
        <div class="flex items-center justify-between">

            {{-- Mobile Menu Button --}}
            <div class="w-2/5">
                <button
                    id="open-off-canvas-menu"
                    class="cursor-pointer inline-flex items-center justify-center p-1 px-4 gap-1 border rounded-full transition-all hover:bg-primary-900"
                    aria-label="Mở menu điều hướng"
                >
                    <i class="fa-light fa-bars"></i>
                    <span class="text-sm uppercase">Menu</span>
                </button>
            </div>

            {{-- Logo --}}
            <a class="brand" href="{{ home_url('/') }}">
                <img
                    class="w-12 lg:w-20"
                    src="/wp-content/uploads/2025/08/logo.svg"
                    alt="{{ \App\get_company_name() }}"
                >
            </a>

            {{-- Contact Actions --}}
            <div class="w-2/5 flex justify-end">
                <div class="flex items-center gap-4">

                    {{-- Phone Contact --}}
                    <a href="tel:{{ \App\get_contact_phone_link() }}" class="group h-8 cursor-pointer overflow-hidden text-white">
                        <div class="transition-all duration-300 group-hover:-translate-y-8">
                            {{-- Default State --}}
                            <div class="flex h-8 items-center gap-2">
                                <div class="flex size-8 items-center justify-center rounded-full border border-white/50">
                                    <i class="fa-light fa-phone-volume text-sm"></i>
                                </div>
                                <span class="text-sm mb-0.5 hidden lg:block">{{ \App\get_contact_phone() }}</span>
                            </div>
                            {{-- Hover State --}}
                            <div class="flex h-8 items-center gap-2 text-secondary-dark">
                                <div class="flex size-8 items-center justify-center rounded-full border border-secondary-dark bg-secondary-dark text-white">
                                    <i class="fa-light fa-phone-volume text-sm"></i>
                                </div>
                                <span class="text-sm mb-0.5 hidden lg:block">{{ \App\get_contact_phone() }}</span>
                            </div>
                        </div>
                    </a>

                    {{-- Contact Form Link --}}
                    <a href="/lien-he" class="group h-8 cursor-pointer overflow-hidden text-white">
                        <div class="transition-all duration-300 group-hover:-translate-y-8">
                            {{-- Default State --}}
                            <div class="flex h-8 items-center gap-2">
                                <div class="flex size-8 items-center justify-center rounded-full border border-white/50">
                                    <i class="fa-light fa-envelope text-sm"></i>
                                </div>
                                <span class="text-sm hidden lg:block uppercase">Nhận tư vấn</span>
                            </div>
                            {{-- Hover State --}}
                            <div class="flex h-8 items-center gap-2 text-secondary-dark">
                                <div class="flex size-8 items-center justify-center rounded-full border border-secondary-dark bg-secondary-dark text-white">
                                    <i class="fa-light fa-envelope text-sm"></i>
                                </div>
                                <span class="text-sm hidden lg:block uppercase">Nhận tư vấn</span>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </div>
</header>
<x-off-canvas-menu/>
