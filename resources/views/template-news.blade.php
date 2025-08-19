{{--
  Template Name: Tin tức theo danh mục
--}}

@extends('layouts.app')

@section('content')
  <div data-fullpage>
    @php
      // Lấy danh mục thật từ WordPress
      // Có thể tuỳ chỉnh exclude theo slug nếu cần
      $exclude_slugs = ['uncategorized'];
      $categories = get_terms([
        'taxonomy'   => 'category',
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
      ]);
    @endphp

    @foreach($categories as $term)
      @php if (in_array($term->slug, $exclude_slugs)) continue; @endphp
      <div class="section" data-anchor="{{ $term->slug }}" data-tooltip="{{ $term->name }}" data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->index * 100 }}">
        <x-news-section :category-slug="$term->slug" :title="$term->name" :limit="8" />
      </div>
    @endforeach
  </div>
@endsection

