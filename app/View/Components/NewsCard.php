<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use WP_Post;

class NewsCard extends Component
{
    public WP_Post $post;
    public string $imageUrl;
    public string $title;
    public string $permalink;
    public string $excerpt;
    public string $date;
    public string $day;
    public string $monthYear;

    /**
     * Create a new component instance.
     */
    public function __construct(WP_Post $post)
    {
        $this->post = $post;
        $this->imageUrl = get_the_post_thumbnail_url($post->ID, 'large') ?: '';
        $this->title = get_the_title($post->ID);
        $this->permalink = get_permalink($post->ID);
        $this->excerpt = wp_trim_words(get_the_excerpt($post->ID), 20, '...');
        $this->date = get_the_date('', $post->ID);

        // Format date for display
        $this->day = get_the_date('d', $post->ID);
        $this->monthYear = get_the_date('m.Y', $post->ID);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news-card');
    }
}
