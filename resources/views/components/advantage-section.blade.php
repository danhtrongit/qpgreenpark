@php
    // Get ACF data for advantages
    $section_title = get_field('loi_the_tieu_de', 'option') ?: 'Chỉ có tại';
    $section_subtitle = get_field('loi_the_phu_de', 'option') ?: 'QP Green Park';
    $section_icon = get_field('loi_the_hinh_anh_icon', 'option');
    $advantages_data = get_field('loi_the_danh_sach', 'option') ?: [];

    // Fallback data if ACF is not configured
    $fallback_advantages = [
        [
            'tieu_de' => 'VỊ TRÍ ĐẮC ĐỊA',
            'mo_ta' => 'Tọa lạc tại Bình Mỹ, Bắc Tân Uyên, khu vực phát triển mạnh, có tiềm năng tăng giá trị bất động sản.',
            'hinh_anh' => ['url' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&h=400&fit=crop&crop=center'],
        ],
        [
            'tieu_de' => 'THIẾT KẾ HIỆN ĐẠI',
            'mo_ta' => 'Kiến trúc vuông vức, mạnh mẽ, tối ưu công năng. Sử dụng mảng kính lớn và đường nét đứng tạo cảm giác sang trọng, cao ráo.',
            'hinh_anh' => ['url' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&h=400&fit=crop&crop=center'],
        ],
        [
            'tieu_de' => 'SẢN PHẨM ĐA DẠNG',
            'mo_ta' => 'Cung cấp 6 mẫu nhà phố và 4 mẫu nhà thương mại, tạo nên một khu đô thị phong phú và sinh động.',
            'hinh_anh' => ['url' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600&h=400&fit=crop&crop=center'],
        ],
        [
            'tieu_de' => 'KHÔNG GIAN XANH',
            'mo_ta' => 'Các mảng xanh tại ban công và sân thượng giúp không gian sống gần gũi với thiên nhiên, tràn đầy sức sống.',
            'hinh_anh' => ['url' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop&crop=center'],
        ],
        [
            'tieu_de' => 'VẬT LIỆU CHẤT LƯỢNG',
            'mo_ta' => 'Sử dụng vật liệu hiện đại như kính cường lực và khung nhôm Xingfa, đảm bảo độ bền và tính thẩm mỹ cao.',
            'hinh_anh' => ['url' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=600&h=400&fit=crop&crop=center'],
        ],
        [
            'tieu_de' => 'PHONG THỦY HÀI HÒA',
            'mo_ta' => 'Thiết kế dựa trên yếu tố phong thủy ứng với chu kỳ 9, lựa chọn màu sắc mang lại may mắn và vượng khí.',
            'hinh_anh' => ['url' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&h=400&fit=crop&crop=center'],
        ],
    ];

    // Use ACF data if available, otherwise use fallback
    $advantages = !empty($advantages_data) ? $advantages_data : $fallback_advantages;

    // Default icon if not set
    $default_icon = '/wp-content/uploads/2025/08/6-dac-quyen.svg';
    $icon_url = $section_icon ? $section_icon['url'] : $default_icon;
@endphp

<div class="h-auto lg:min-h-screen relative overflow-hidden flex flex-col items-center justify-center">
    <div class="container p-4  py-12 lg:pt-16">

        <div class="grid mb-16 grid-cols-8 gap-8 max-w-4xl mx-auto items-end">

            <div class="hidden lg:block lg:col-span-3"></div>
            <div class="col-span-3 lg:col-span-2" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="200">
                <img src="{{ $icon_url }}" alt="{{ $section_title }} {{ $section_subtitle }}">
            </div>
            <div class="col-span-5 lg:col-span-3" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                <h2 class="text-lg lg:text-2xl font-base uppercase mb-2 lg:mb-4 opacity-75">
                    {{ $section_title }}
                </h2>
                <h1
                    class="text-2xl lg:text-4xl bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text font-semibold uppercase mb-4 lg:mb-8">
                    {{ $section_subtitle }}
                </h1>

                <div class="flex items-center">
                    <div class="size-3 rounded-full bg-secondary-darker"></div>
                    <div class="flex-1 -mr-60 h-0.5 bg-gradient-to-r from-secondary-darker to-secondary-lighter">
                    </div>
                </div>
            </div>
        </div>


        <!-- Advantage Owl Carousel -->
        <div class="owl-carousel owl-advantage" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
            @foreach ($advantages as $index => $advantage)
                <div class="item">
                    <div class="relative overflow-hidden">

                        <div class="flex flex-col justify-center items-center mb-4">
                            <h3 class="text-3xl lg:text-5xl font-semibold font-sans text-transparent [text-shadow:0_5px_15px_rgba(0,0,0,0.2)]
  [-webkit-text-stroke:1px_#c0933a] mb-2">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </h3>
                            <p class="text-base line-clamp-2 text-white uppercase">
                                {{ $advantage['tieu_de'] }}
                            </p>
                        </div>
                        <img class="w-full rounded h-auto object-cover aspect-square" src="{{ $advantage['hinh_anh']['url'] }}"
                            alt="{{ $advantage['tieu_de'] }}">
                        
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
