<?php

/**
 * Helper functions for theme
 */

namespace App;

/**
 * Get contact information from customizer
 */

/**
 * Get company name
 *
 * @return string
 */
function get_company_name() {
    return get_theme_mod('contact_company_name', 'QP Green Park');
}

/**
 * Get contact address
 *
 * @return string
 */
function get_contact_address() {
    return get_theme_mod('contact_address', 'Tầng L16, Tòa Nhà Vietcombank, Số 5 Công Trường Mễ Linh, Phường Bến Nghé, Quận 1, TP. Hồ Chí Minh');
}

/**
 * Get contact phone (formatted for display)
 *
 * @return string
 */
function get_contact_phone() {
    return get_theme_mod('contact_phone', '(028) 35 28 28 28');
}

/**
 * Get contact phone link (for tel: links)
 *
 * @return string
 */
function get_contact_phone_link() {
    return get_theme_mod('contact_phone_link', '02835282828');
}

/**
 * Get contact email
 *
 * @return string
 */
function get_contact_email() {
    return get_theme_mod('contact_email', 'info@qpgroup.vn');
}

/**
 * Get contact fax
 *
 * @return string
 */
function get_contact_fax() {
    return get_theme_mod('contact_fax', '(028) 35 18 18 18');
}

/**
 * Get website URL
 *
 * @return string
 */
function get_contact_website() {
    return get_theme_mod('contact_website', 'https://qpgroup.vn');
}

/**
 * Social media helper functions
 */

/**
 * Get Facebook URL
 *
 * @return string
 */
function get_social_facebook() {
    return get_theme_mod('social_facebook', '');
}

/**
 * Get Instagram URL
 *
 * @return string
 */
function get_social_instagram() {
    return get_theme_mod('social_instagram', '');
}

/**
 * Get YouTube URL
 *
 * @return string
 */
function get_social_youtube() {
    return get_theme_mod('social_youtube', '');
}

/**
 * Get LinkedIn URL
 *
 * @return string
 */
function get_social_linkedin() {
    return get_theme_mod('social_linkedin', '');
}

/**
 * Get Twitter/X URL
 *
 * @return string
 */
function get_social_twitter() {
    return get_theme_mod('social_twitter', '');
}

/**
 * Get TikTok URL
 *
 * @return string
 */
function get_social_tiktok() {
    return get_theme_mod('social_tiktok', '');
}

/**
 * Partner helper functions
 */

/**
 * Get investor/developer information
 *
 * @return array
 */
function get_chu_dau_tu() {
    return [
        'logo' => get_field('chu_dau_tu_logo', 'option'),
        'ten_cong_ty' => get_field('chu_dau_tu_ten_cong_ty', 'option') ?: 'QP Green Park',
        'mo_ta' => get_field('chu_dau_tu_mo_ta', 'option'),
        'website' => get_field('chu_dau_tu_website', 'option'),
    ];
}

/**
 * Get strategic partners list
 *
 * @return array
 */
function get_doi_tac_chien_luoc() {
    return get_field('doi_tac_chien_luoc_danh_sach', 'option') ?: [];
}

/**
 * Get distribution partners list
 *
 * @return array
 */
function get_doi_tac_phan_phoi() {
    return get_field('doi_tac_phan_phoi_danh_sach', 'option') ?: [];
}

/**
 * Get Zalo phone number
 *
 * @return string
 */
function get_social_zalo() {
    return get_theme_mod('social_zalo', '');
}

/**
 * Get all social media links as array
 *
 * @return array
 */
function get_social_links() {
    $social_links = [];
    
    if ($facebook = get_social_facebook()) {
        $social_links['facebook'] = [
            'url' => $facebook,
            'icon' => 'fa-brands fa-facebook-f',
            'name' => 'Facebook'
        ];
    }
    
    if ($instagram = get_social_instagram()) {
        $social_links['instagram'] = [
            'url' => $instagram,
            'icon' => 'fa-brands fa-instagram',
            'name' => 'Instagram'
        ];
    }
    
    if ($youtube = get_social_youtube()) {
        $social_links['youtube'] = [
            'url' => $youtube,
            'icon' => 'fa-brands fa-youtube',
            'name' => 'YouTube'
        ];
    }
    
    if ($linkedin = get_social_linkedin()) {
        $social_links['linkedin'] = [
            'url' => $linkedin,
            'icon' => 'fa-brands fa-linkedin-in',
            'name' => 'LinkedIn'
        ];
    }
    
    if ($twitter = get_social_twitter()) {
        $social_links['twitter'] = [
            'url' => $twitter,
            'icon' => 'fa-brands fa-x-twitter',
            'name' => 'Twitter/X'
        ];
    }
    
    if ($tiktok = get_social_tiktok()) {
        $social_links['tiktok'] = [
            'url' => $tiktok,
            'icon' => 'fa-brands fa-tiktok',
            'name' => 'TikTok'
        ];
    }
    
    if ($zalo = get_social_zalo()) {
        $social_links['zalo'] = [
            'url' => 'https://zalo.me/' . $zalo,
            'icon' => 'fa-solid fa-z',
            'name' => 'Zalo'
        ];
    }
    
    return $social_links;
}

/**
 * Display social media links
 *
 * @param string $class_wrapper CSS class for wrapper
 * @param string $class_link CSS class for each link
 * @param bool $show_text Whether to show text or just icons
 * @return string
 */
function display_social_links($class_wrapper = 'flex gap-4', $class_link = 'text-white hover:text-secondary-dark transition-colors', $show_text = false) {
    $social_links = get_social_links();
    
    if (empty($social_links)) {
        return '';
    }
    
    $output = '<div class="' . esc_attr($class_wrapper) . '">';
    
    foreach ($social_links as $key => $social) {
        $output .= '<a href="' . esc_url($social['url']) . '" target="_blank" rel="noopener noreferrer" class="' . esc_attr($class_link) . '" title="' . esc_attr($social['name']) . '">';
        $output .= '<i class="' . esc_attr($social['icon']) . '"></i>';
        if ($show_text) {
            $output .= '<span class="ml-2">' . esc_html($social['name']) . '</span>';
        }
        $output .= '</a>';
    }
    
    $output .= '</div>';
    
    return $output;
}
