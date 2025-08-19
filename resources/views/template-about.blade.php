{{--
  Template Name: Giới thiệu
--}}

@extends('layouts.app')

@section('content')
  <div data-fullpage>
    <div class="section" data-anchor="video" data-tooltip="Video">
      <x-video-section />
    </div>

    <div class="section" data-anchor="tong-quan" data-tooltip="Tổng quan">
      <x-overview-section />
    </div>

    <div class="section" data-anchor="loi-the" data-tooltip="Lợi thế">
      <x-advantage-section />
    </div>

    <div class="section" data-anchor="doi-tac" data-tooltip="Đối tác">
      <x-partner-section />
    </div>

    <div class="section" data-anchor="lien-he" data-tooltip="Liên hệ">
      <x-contact-section />
    </div>
  </div>
@endsection
