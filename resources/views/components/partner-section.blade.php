@php
    use function App\get_chu_dau_tu;
    use function App\get_doi_tac_chien_luoc;
    use function App\get_doi_tac_phan_phoi;
    use function App\get_doi_tac_section;

    $chu_dau_tu = get_chu_dau_tu();
    $doi_tac_chien_luoc = get_doi_tac_chien_luoc();
    $doi_tac_phan_phoi = get_doi_tac_phan_phoi();
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

            <div class="flex items-center">
                <div class="size-3 rounded-full bg-secondary-darker"></div>
                <div class="flex-1 -mr-60 h-[1px] bg-gradient-to-r from-secondary-darker to-secondary-lighter">
                </div>
            </div>
            <img class="w-40 lg:w-60 lg:ml-20" src="{{ $chu_dau_tu['logo']['url'] }}"
                alt="{{ $chu_dau_tu['ten_cong_ty'] }}" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">

            <div class="w-full overflow-hidden">
                <div class="owl-carousel owl-partner">
                @if ($doi_tac_phan_phoi && count($doi_tac_phan_phoi) > 0)
                    @foreach ($doi_tac_phan_phoi as $partner)
                        @if ($partner['logo'])
                            <div class="item">
                                @if ($partner['website'])
                                    <a href="{{ $partner['website'] }}" target="_blank" rel="noopener">
                                        <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain hover:opacity-80 transition-opacity"
                                            src="{{ $partner['logo']['url'] }}" alt="{{ $partner['ten_cong_ty'] }}"
                                            title="{{ $partner['ten_cong_ty'] }}">
                                    </a>
                                @else
                                    <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain"
                                        src="{{ $partner['logo']['url'] }}" alt="{{ $partner['ten_cong_ty'] }}"
                                        title="{{ $partner['ten_cong_ty'] }}">
                                @endif
                            </div>
                        @endif
                    @endforeach
                @else
                    {{-- Fallback content if no partners are set --}}
                    @for ($i = 0; $i < 5; $i++)
                        <div class="item">
                            <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain"
                                src="/wp-content/uploads/2025/08/logo.svg" alt="QP Green Park">
                        </div>
                    @endfor
                @endif
                </div>
            </div>

            <div class="w-full overflow-hidden mt-4">
                <div class="owl-carousel owl-partner">
                @if ($doi_tac_chien_luoc && count($doi_tac_chien_luoc) > 0)
                    @foreach ($doi_tac_chien_luoc as $partner)
                        @if ($partner['logo'])
                            <div class="item">
                                @if ($partner['website'])
                                    <a href="{{ $partner['website'] }}" target="_blank" rel="noopener">
                                        <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain hover:opacity-80 transition-opacity"
                                            src="{{ $partner['logo']['url'] }}" alt="{{ $partner['ten_cong_ty'] }}"
                                            title="{{ $partner['ten_cong_ty'] }}">
                                    </a>
                                @else
                                    <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain"
                                        src="{{ $partner['logo']['url'] }}" alt="{{ $partner['ten_cong_ty'] }}"
                                        title="{{ $partner['ten_cong_ty'] }}">
                                @endif
                            </div>
                        @endif
                    @endforeach
                @else
                    {{-- Fallback content if no partners are set --}}
                    @for ($i = 0; $i < 5; $i++)
                        <div class="item">
                            <img class="h-12 sm:h-14 lg:h-16 w-auto mx-auto object-contain"
                                src="/wp-content/uploads/2025/08/logo.svg" alt="QP Green Park">
                        </div>
                    @endfor
                @endif
                </div>
            </div>
        </div>

    </div>
</div>
