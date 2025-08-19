{{--
  Template Name: Trang chủ
--}}

@extends('layouts.app')

@section('content')
  <div id="fullpage">
    <div class="section" data-anchor="video" data-tooltip="Video" data-aos="fade-up" data-aos-duration="800">
      <x-video-section />
    </div>

    <div class="section" data-anchor="tong-quan" data-tooltip="Tổng quan" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
      <x-introduction-section />
    </div>

    <div class="section" data-anchor="vi-tri" data-tooltip="Vị trí" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
      <x-location-section />
    </div>

    <div class="section" data-anchor="mat-bang" data-tooltip="Mặt bằng" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
      <x-floor-plan-section />
    </div>

    <div class="section" data-anchor="loi-the" data-tooltip="Lợi thế" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
      <x-advantage-section />
    </div>

    <div class="section" data-anchor="doi-tac" data-tooltip="Đối tác" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
      <x-partner-section />
    </div>

    <div class="section" data-anchor="tin-tuc" data-tooltip="Tin tức" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
      <x-news-section />
    </div>

    <div class="section" data-anchor="lien-he" data-tooltip="Liên hệ" data-aos="fade-up" data-aos-duration="800" data-aos-delay="700">
      <x-contact-section />
    </div>
  </div>
@endsection
