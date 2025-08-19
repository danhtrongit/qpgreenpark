{{--
  Template Name: Tiện ích
--}}

@extends('layouts.app')

@section('content')
  <div data-fullpage>
    <div class="section" data-anchor="video" data-tooltip="Video">
      <x-video-section />
    </div>

    <div class="section" data-anchor="tien-ich" data-tooltip="Tiện ích">
      <x-utilities-section />
    </div>

    <div class="section" data-anchor="lien-he" data-tooltip="Liên hệ">
      <x-contact-section />
    </div>
  </div>
@endsection
