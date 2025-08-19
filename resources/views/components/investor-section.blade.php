@php
    use function App\get_chu_dau_tu;
    use function App\get_doi_tac_section;

    $chu_dau_tu = get_chu_dau_tu();
    $doi_tac_section = get_doi_tac_section();
@endphp

<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center overflow-hidden section-bg">


    <div class="grid lg:grid-cols-3 gap-8 lg:gap-16">

        <div class="lg:col-span-1">
            @if ($doi_tac_section['hinh_anh'] && $doi_tac_section['hinh_anh']['url'])
                <img class="w-full h-96 lg:h-screen object-cover" data-aos="zoom-in"
                    src="{{ $doi_tac_section['hinh_anh']['url'] }}" alt="{{ $doi_tac_section['alt_text'] }}">
            @else
                {{-- Fallback image if no ACF image is set --}}
                <img class="w-full h-96 lg:h-screen object-cover" data-aos="zoom-in"
                    src="/wp-content/uploads/2025/08/logo.svg" alt="{{ $doi_tac_section['alt_text'] }}">
            @endif
        </div>

        <div class="lg:col-span-2 lg:ml-8 flex flex-col justify-center overflow-hidden p-4 lg:p-0">

            <h2 class="text-2xl lg:text-4xl font-base uppercase mb-4" data-aos="fade-down" data-aos-duration="600"
                data-aos-delay="200">
                Chủ đầu tư
            </h2>

            <div class="flex items-center" data-aos="fade-up" data-aos-duration="600" data-aos-delay="400">
                <div class="size-3 rounded-full bg-secondary-darker"></div>
                <div class="flex-1 -mr-60 h-[1px] bg-gradient-to-r from-secondary-darker to-secondary-lighter">
                </div>
            </div>
            <img class="w-40 lg:w-60 lg:ml-20" src="{{ $chu_dau_tu['logo']['url'] }}"
                alt="{{ $chu_dau_tu['ten_cong_ty'] }}" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">
        </div>

    </div>
</div>
