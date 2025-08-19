@php
    use function App\get_doi_tac_chien_luoc;
    use function App\get_doi_tac_phan_phoi;
    use function App\get_doi_tac_section;

    $doi_tac_chien_luoc = get_doi_tac_chien_luoc();
    $doi_tac_phan_phoi = get_doi_tac_phan_phoi();
    $doi_tac_section = get_doi_tac_section();
@endphp

<div class="h-auto lg:min-h-screen relative flex flex-col items-center justify-center overflow-hidden section-bg">
    <div class="container p-4 py-12 ">
        <h2 class="text-2xl text-center lg:text-4xl font-base uppercase mb-8" data-aos="fade-down">
            Đối tác phân phối
        </h2>
        <div class="owl-carousel owl-partner bg-white p-4 px-8 rounded mb-8" data-aos="fade-up">
            @if ($doi_tac_phan_phoi && count($doi_tac_phan_phoi) > 0)
                @foreach ($doi_tac_phan_phoi as $partner)
                    @if ($partner['logo'])
                        <div class="item">
                            @if ($partner['website'])
                                <a href="{{ $partner['website'] }}" target="_blank" rel="noopener">
                                    <img class="h-12 sm:h-14 lg:h-20 w-auto bg-white rounded object-contain hover:opacity-80 transition-opacity"
                                        src="{{ $partner['logo']['url'] }}" alt="{{ $partner['ten_cong_ty'] }}"
                                        title="{{ $partner['ten_cong_ty'] }}">
                                </a>
                            @else
                                <img class="h-12 sm:h-14 lg:h-20 w-auto bg-white rounded object-contain"
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
                        <img class="h-12 sm:h-14 lg:h-16 w-auto bg-white rounded object-contain"
                            src="/wp-content/uploads/2025/08/logo.svg" alt="QP Green Park">
                    </div>
                @endfor
            @endif
        </div>

         <h2 class="text-2xl text-center lg:text-4xl font-base uppercase mb-8" data-aos="fade-down">
            Đối tác chiến lược
        </h2>

        <div class="owl-carousel owl-partner p-4 px-8 bg-white/5 mb-8" data-aos="fade-up">
            @if ($doi_tac_chien_luoc && count($doi_tac_chien_luoc) > 0)
                @foreach ($doi_tac_chien_luoc as $partner)
                    @if ($partner['logo'])
                        <div class="item">
                            @if ($partner['website'])
                                <a href="{{ $partner['website'] }}" target="_blank" rel="noopener">
                                    <img class="h-12 sm:h-14 lg:h-20 w-auto bg-white rounded object-contain hover:opacity-80 transition-opacity"
                                        src="{{ $partner['logo']['url'] }}" alt="{{ $partner['ten_cong_ty'] }}"
                                        title="{{ $partner['ten_cong_ty'] }}">
                                </a>
                            @else
                                <img class="h-12 sm:h-14 lg:h-16 w-auto bg-white rounded object-contain"
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
                        <img class="h-12 sm:h-14 lg:h-16 w-auto bg-white rounded object-contain"
                            src="/wp-content/uploads/2025/08/logo.svg" alt="QP Green Park">
                    </div>
                @endfor
            @endif
        </div>
    </div>
</div>
