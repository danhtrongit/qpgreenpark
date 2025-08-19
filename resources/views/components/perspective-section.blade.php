@php
    // Get ACF data from options page
    $perspective_title = get_field('boi_canh_3d_tieu_de', 'option') ?: 'Tổng thể dự án';
    $perspective_subtitle = get_field('boi_canh_3d_phu_de', 'option') ?: 'Bối cảnh 3d';
    $perspective_list = get_field('boi_canh_3d_danh_sach', 'option') ?: [];

    // Fallback data if no ACF data is available
    if (empty($perspective_list)) {
        $perspective_list = [
            [
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
                'tieu_de_hinh' => '',
                'mo_ta' => '',
            ],
            [
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
                'tieu_de_hinh' => '',
                'mo_ta' => '',
            ],
            [
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
                'tieu_de_hinh' => '',
                'mo_ta' => '',
            ],
            [
                'hinh_anh' => ['url' => '/wp-content/uploads/2025/08/TPV-PICKLEBALL-1.jpg'],
                'tieu_de_hinh' => '',
                'mo_ta' => '',
            ],
        ];
    }
@endphp

<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center">

    <div class="container text-center p-4 py-16">

        <h2
            class="text-2xl font-base bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text uppercase mb-4"
            data-aos="fade-down" data-aos-duration="600" data-aos-delay="200">
            {{ $perspective_subtitle }}
        </h2>
        <h1 class="text-4xl font-bold uppercase mb-8 lg:mb-16" data-aos="fade-up" data-aos-duration="600" data-aos-delay="400">{{ $perspective_title }}</h1>


        {{-- Perspective carousel with navigation --}}
        <div class="perspective-carousel-wrapper relative" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
            <div class="owl-carousel owl-perspective">
                @foreach ($perspective_list as $index => $item)
                    @php
                        $image_url = $item['hinh_anh']['url'] ?? ($item['image']['url'] ?? '');
                        $image_title = $item['tieu_de_hinh'] ?? "Tổng thể dự án - Hình " . ($index + 1);
                        $image_alt = $item['tieu_de_hinh'] ?? "Perspective " . ($index + 1);
                    @endphp
                    <div class="item group relative perspective-item overflow-hidden rounded-2xl">
                        <img class="w-full h-auto object-cover transition-transform duration-500 group-hover:scale-110"
                             src="{{ $image_url }}"
                             alt="{{ $image_alt }}">

                        {{-- Fancybox link with enhanced hover effect --}}
                        <a href="{{ $image_url }}"
                           data-fancybox="perspective-gallery"
                           data-caption="{{ $image_title }}"
                           class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">

                            {{-- Plus icon with animation - perfectly centered --}}
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                                <div class="size-16 rounded-full bg-secondary-lighter/90 backdrop-blur-sm border-2 border-secondary-lighter shadow-lg flex items-center justify-center transform scale-75 group-hover:scale-100 transition-all duration-300">
                                    <i class="fa-light fa-plus text-white text-2xl font-bold"></i>
                                </div>

                                {{-- Ripple effect --}}
                                <div class="absolute inset-0 rounded-full bg-secondary-lighter/30 animate-ping opacity-0 group-hover:opacity-100"></div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Navigation overlay bottom right --}}
            <div class="absolute -bottom-16 right-1/2 translate-x-1/2 flex items-center gap-4 z-10">
                <button type="button" class="perspective-prev slide-prev">
                    <i class="fa-light fa-arrow-left text-lg"></i>
                </button>

                <div class="text-white font-bold text-xl">
                    <span class="perspective-current text-secondary-lighter">01</span>
                    <span class="text-white/60"> / </span>
                    <span class="perspective-total text-white/60">{{ count($perspective_list) < 10 ? '0' . count($perspective_list) : count($perspective_list) }}</span>
                </div>

                <button type="button" class="perspective-next slide-next">
                    <i class="fa-light fa-arrow-right text-lg"></i>
                </button>
            </div>
        </div>

    </div>


</div>
