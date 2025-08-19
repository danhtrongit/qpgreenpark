@php
    $advantages = [
        [
            'title' => 'VỊ TRÍ ĐẮC ĐỊA',
            'description' =>
                'Tọa lạc tại Bình Mỹ, Bắc Tân Uyên, khu vực phát triển mạnh, có tiềm năng tăng giá trị bất động sản.',
            'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&h=400&fit=crop&crop=center',
        ],
        [
            'title' => 'THIẾT KẾ HIỆN ĐẠI',
            'description' =>
                'Kiến trúc vuông vức, mạnh mẽ, tối ưu công năng. Sử dụng mảng kính lớn và đường nét đứng tạo cảm giác sang trọng, cao ráo.',
            'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&h=400&fit=crop&crop=center',
        ],
        [
            'title' => 'SẢN PHẨM ĐA DẠNG',
            'description' =>
                'Cung cấp 6 mẫu nhà phố và 4 mẫu nhà thương mại, tạo nên một khu đô thị phong phú và sinh động.',
            'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600&h=400&fit=crop&crop=center',
        ],
        [
            'title' => 'KHÔNG GIAN XANH',
            'description' =>
                'Các mảng xanh tại ban công và sân thượng giúp không gian sống gần gũi với thiên nhiên, tràn đầy sức sống.',
            'image' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&h=400&fit=crop&crop=center',
        ],
        [
            'title' => 'VẬT LIỆU CHẤT LƯỢNG',
            'description' =>
                'Sử dụng vật liệu hiện đại như kính cường lực và khung nhôm Xingfa, đảm bảo độ bền và tính thẩm mỹ cao.',
            'image' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=600&h=400&fit=crop&crop=center',
        ],
        [
            'title' => 'PHONG THỦY HÀI HÒA',
            'description' =>
                'Thiết kế dựa trên yếu tố phong thủy ứng với chu kỳ 9, lựa chọn màu sắc mang lại may mắn và vượng khí.',
            'image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&h=400&fit=crop&crop=center',
        ],
    ];
@endphp

<div class="h-auto lg:min-h-screen relative overflow-hidden flex flex-col items-center justify-center">
    <div class="container p-4  py-12 lg:pt-16">

        <div class="grid mb-16 grid-cols-8 gap-8 max-w-4xl mx-auto items-end">

            <div class="hidden lg:block lg:col-span-3"></div>
            <div class="col-span-3 lg:col-span-2" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="200">
                <img src="/wp-content/uploads/2025/08/6-dac-quyen.svg" alt="">
            </div>
            <div class="col-span-5 lg:col-span-3" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                <h2 class="text-lg lg:text-2xl font-base uppercase mb-2 lg:mb-4 opacity-75">
                    Chỉ có tại
                </h2>
                <h1
                    class="text-2xl lg:text-4xl bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text font-semibold uppercase mb-4 lg:mb-8">
                    QP Green Park
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
                    <div class="relative rounded overflow-hidden">
                        <div class="absolute inset-0 bg-primary-950/50"></div>
                        <img class="w-full h-auto object-cover aspect-[4/5]" src="{{ $advantage['image'] }}"
                            alt="{{ $advantage['title'] }}">
                        <div class="absolute inset-0 flex flex-col justify-end p-4 pb-8">
                            <h3 class="text-3xl lg:text-5xl font-semibold text-secondary-mid mb-2">
                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                            </h3>
                            <h2 class="text-base font-semibold line-clamp-2 text-white uppercase mb-2">
                                {{ $advantage['title'] }}
                            </h2>
                            <p class="text-sm text-white line-clamp-3">
                                {{ $advantage['description'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
