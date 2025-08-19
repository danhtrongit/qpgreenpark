<?php

/**
 * Theme Customizer settings for contact information
 */

namespace App;

/**
 * Add customizer settings for contact information
 *
 * @param WP_Customize_Manager $wp_customize
 */
add_action('customize_register', function ($wp_customize) {
    
    // Add Contact Information Section
    $wp_customize->add_section('contact_info', [
        'title'    => __('Thông tin liên hệ', 'qpgreenpark'),
        'priority' => 30,
    ]);

    // Company Name
    $wp_customize->add_setting('contact_company_name', [
        'default'           => 'QP Green Park',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('contact_company_name', [
        'label'   => __('Tên công ty', 'qpgreenpark'),
        'section' => 'contact_info',
        'type'    => 'text',
    ]);

    // Address
    $wp_customize->add_setting('contact_address', [
        'default'           => 'Tầng L16, Tòa Nhà Vietcombank, Số 5 Công Trường Mễ Linh, Phường Bến Nghé, Quận 1, TP. Hồ Chí Minh',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('contact_address', [
        'label'   => __('Địa chỉ', 'qpgreenpark'),
        'section' => 'contact_info',
        'type'    => 'textarea',
    ]);

    // Phone
    $wp_customize->add_setting('contact_phone', [
        'default'           => '(028) 35 28 28 28',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('contact_phone', [
        'label'   => __('Số điện thoại', 'qpgreenpark'),
        'section' => 'contact_info',
        'type'    => 'text',
    ]);

    // Phone Link (for tel: links)
    $wp_customize->add_setting('contact_phone_link', [
        'default'           => '02835282828',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('contact_phone_link', [
        'label'       => __('Số điện thoại (link)', 'qpgreenpark'),
        'description' => __('Số điện thoại không có dấu cách, dấu ngoặc (dùng cho link tel:)', 'qpgreenpark'),
        'section'     => 'contact_info',
        'type'        => 'text',
    ]);

    // Email
    $wp_customize->add_setting('contact_email', [
        'default'           => 'info@qpgroup.vn',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('contact_email', [
        'label'   => __('Email', 'qpgreenpark'),
        'section' => 'contact_info',
        'type'    => 'email',
    ]);

    // Fax
    $wp_customize->add_setting('contact_fax', [
        'default'           => '(028) 35 18 18 18',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('contact_fax', [
        'label'   => __('Fax', 'qpgreenpark'),
        'section' => 'contact_info',
        'type'    => 'text',
    ]);

    // Website
    $wp_customize->add_setting('contact_website', [
        'default'           => 'https://qpgroup.vn',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('contact_website', [
        'label'   => __('Website', 'qpgreenpark'),
        'section' => 'contact_info',
        'type'    => 'url',
    ]);

    // Add Social Media Section
    $wp_customize->add_section('social_media', [
        'title'    => __('Mạng xã hội', 'qpgreenpark'),
        'priority' => 31,
    ]);

    // Facebook
    $wp_customize->add_setting('social_facebook', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('social_facebook', [
        'label'   => __('Facebook URL', 'qpgreenpark'),
        'section' => 'social_media',
        'type'    => 'url',
    ]);

    // Instagram
    $wp_customize->add_setting('social_instagram', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('social_instagram', [
        'label'   => __('Instagram URL', 'qpgreenpark'),
        'section' => 'social_media',
        'type'    => 'url',
    ]);

    // YouTube
    $wp_customize->add_setting('social_youtube', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('social_youtube', [
        'label'   => __('YouTube URL', 'qpgreenpark'),
        'section' => 'social_media',
        'type'    => 'url',
    ]);

    // LinkedIn
    $wp_customize->add_setting('social_linkedin', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('social_linkedin', [
        'label'   => __('LinkedIn URL', 'qpgreenpark'),
        'section' => 'social_media',
        'type'    => 'url',
    ]);

    // Twitter/X
    $wp_customize->add_setting('social_twitter', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('social_twitter', [
        'label'   => __('Twitter/X URL', 'qpgreenpark'),
        'section' => 'social_media',
        'type'    => 'url',
    ]);

    // TikTok
    $wp_customize->add_setting('social_tiktok', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('social_tiktok', [
        'label'   => __('TikTok URL', 'qpgreenpark'),
        'section' => 'social_media',
        'type'    => 'url',
    ]);

    // Zalo
    $wp_customize->add_setting('social_zalo', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);

    $wp_customize->add_control('social_zalo', [
        'label'       => __('Zalo', 'qpgreenpark'),
        'description' => __('Số điện thoại Zalo (không có dấu cách, dấu ngoặc)', 'qpgreenpark'),
        'section'     => 'social_media',
        'type'        => 'text',
    ]);

});
