<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsSection extends Component
{
    public $posts;
    public $title;
    public $categorySlug;
    public $limit;

    /**
     * Create a new component instance.
     */
    public function __construct($categorySlug = null, $title = null, $limit = 8)
    {
        $this->categorySlug = $categorySlug ?: null;
        $this->limit = (int) $limit;
        $this->title = $title ?? $this->resolveTitle($this->categorySlug);
        $this->posts = $this->getPosts();
    }

    /**
     * Resolve heading title based on category slug
     */
    private function resolveTitle($slug)
    {
        if (!$slug) {
            return __('Tin tức', 'sage');
        }
        $term = get_category_by_slug($slug);
        return $term ? $term->name : ucwords(str_replace('-', ' ', $slug));
    }

    /**
     * Get posts for a category or latest posts
     */
    private function getPosts()
    {
        $args = [
            'numberposts' => $this->limit ?: 8,
            'post_type' => 'post',
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
        ];

        if (!empty($this->categorySlug)) {
            // Filter by category slug
            $args['category_name'] = $this->categorySlug;
        }

        $posts = get_posts($args);

        // Optional debug logging
        if (defined('WP_DEBUG') && WP_DEBUG) {
            error_log('=== DEBUG NEWS SECTION ===');
            foreach ($posts as $post) {
                error_log(sprintf(
                    'ID: %d, Title: %s, Categories: %s',
                    $post->ID,
                    $post->post_title,
                    implode(',', wp_get_post_categories($post->ID))
                ));
            }
        }

        return $posts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news-section');
    }
}
