@php
    // Get ACF data for location
    $section_title = get_field('vi_tri_tieu_de', 'option') ?: 'Vị trí dự án';
    $section_subtitle = get_field('vi_tri_phu_de', 'option') ?: 'Tâm điểm thịnh vượng';
    $section_description = get_field('vi_tri_mo_ta', 'option') ?: 'Tọa lạc tại xã Bình Mỹ, huyện Bắc Tân Uyên, QP Green Park thừa hưởng lợi thế từ sự phát triển mạnh mẽ của hạ tầng giao thông và quy hoạch đô thị trong khu vực. Dự án nằm liền kề các tuyến giao thông huyết mạch như DT742 và DT747, tạo điều kiện thuận lợi cho cư dân kết nối nhanh chóng đến TP.HCM, Đồng Nai, Bình Phước cũng như các khu công nghiệp trọng điểm. Đây là lợi thế nổi bật, góp phần nâng cao tiềm năng khai thác, gia tăng giá trị đầu tư và tạo nền tảng vững chắc cho an cư lâu dài.';
    $section_image = get_field('vi_tri_hinh_anh', 'option');
    $detail_link = get_field('vi_tri_link_chi_tiet', 'option') ?: '/vi-tri';
    $button_text = get_field('vi_tri_text_nut', 'option') ?: 'Xem chi tiết';
    $show_button = get_field('vi_tri_hien_thi_nut', 'option');

    // Default image if not set
    $default_image = '/wp-content/uploads/2025/08/vi-tri.svg';
    $image_url = $section_image ? $section_image['url'] : $default_image;
    $image_alt = $section_image ? $section_image['alt'] : $section_title;

    // Show button by default if not explicitly set to false
    $show_button = $show_button !== false;
@endphp

<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center overflow-hidden section-bg">
        <div class="container p-4 py-12 lg:pt-16">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-y-8 items-center">
                <div class="col-span-2" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                    <h2 class="text-lg lg:text-2xl font-base uppercase mb-4">
                        {{ $section_title }}
                    </h2>
                    <h1
                        class="text-3xl lg:text-4xl bg-gradient-to-r from-secondary-darker to-secondary-lighter inline-block text-transparent bg-clip-text font-semibold uppercase mb-8">
                        {{ $section_subtitle }}
                    </h1>
                    <p class="mb-8">{!! $section_description !!}</p>

                    @if($show_button)
                    <a class="inline-flex relative overflow-hidden items-center gap-2 border p-1 pl-4 rounded-full group hover:gap-4 transition-all" href="{{ $detail_link }}" data-aos="fade-up" data-aos-duration="600" data-aos-delay="600">
                        <span class="w-full -z-1 h-full absolute left-0 top-0 -translate-x-full bg-gradient-to-r from-secondary-darker to-secondary-mid group-hover:translate-x-0 transition-all"></span>
                        <span class="relative z-2 uppercase">{{ $button_text }}</span>
                        <span class="relative z-2 bg-gradient-to-r from-secondary-darker to-secondary-lighter size-8 flex items-center justify-center rounded-full group-hover:from-primary-950 group-hover:to-primary-900">
                            <i class="fa-light fa-arrow-right"></i>
                        </span>
                    </a>
                    @endif
                </div>
                <div class="col-span-3" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                    <img class="w-full h-auto" src="{{ $image_url }}"
                        alt="{{ $image_alt }}">
                </div>
            </div>
        </div>
</div>
