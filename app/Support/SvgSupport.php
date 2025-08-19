<?php

namespace App\Support;

/**
 * SVG Support Class
 * 
 * Provides comprehensive SVG upload and display support for WordPress
 */
class SvgSupport
{
    /**
     * Initialize SVG support
     */
    public static function init()
    {
        // Enable SVG uploads
        add_filter('upload_mimes', [self::class, 'addSvgMimeType']);
        
        // Fix SVG display in media library
        add_filter('wp_prepare_attachment_for_js', [self::class, 'fixSvgMediaLibraryDisplay'], 10, 3);
        
        // Sanitize SVG uploads
        add_filter('wp_handle_upload_prefilter', [self::class, 'sanitizeSvgUpload']);
        
        // Fix SVG thumbnails in admin
        add_action('admin_head', [self::class, 'fixSvgThumbnails']);
        
        // Enable SVG in image functions
        add_filter('wp_get_attachment_image_src', [self::class, 'enableSvgInImageFunctions'], 10, 4);
        
        // Add SVG support to WordPress image functions
        add_filter('wp_get_attachment_image_attributes', [self::class, 'addSvgImageAttributes'], 10, 3);
        
        // Fix SVG dimensions
        add_filter('wp_get_attachment_metadata', [self::class, 'generateSvgMetadata'], 10, 2);
    }

    /**
     * Add SVG to allowed mime types
     *
     * @param array $mimes
     * @return array
     */
    public static function addSvgMimeType($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    /**
     * Fix SVG display in media library
     *
     * @param array $response
     * @param \WP_Post $attachment
     * @param array $meta
     * @return array
     */
    public static function fixSvgMediaLibraryDisplay($response, $attachment, $meta)
    {
        if ($response['mime'] === 'image/svg+xml') {
            $svg_path = get_attached_file($attachment->ID);
            
            if (file_exists($svg_path)) {
                $dimensions = self::getSvgDimensions($svg_path);
                
                $response['width'] = $dimensions['width'];
                $response['height'] = $dimensions['height'];
                
                // Ensure sizes array exists
                if (empty($response['sizes'])) {
                    $response['sizes'] = [
                        'full' => [
                            'url' => $response['url'],
                            'width' => $dimensions['width'],
                            'height' => $dimensions['height'],
                            'orientation' => $dimensions['width'] > $dimensions['height'] ? 'landscape' : 'portrait'
                        ]
                    ];
                }
            }
        }
        
        return $response;
    }

    /**
     * Sanitize SVG uploads for security
     *
     * @param array $file
     * @return array
     */
    public static function sanitizeSvgUpload($file)
    {
        if ($file['type'] === 'image/svg+xml') {
            $svg_content = file_get_contents($file['tmp_name']);
            
            // Validate SVG structure
            if (!self::isValidSvg($svg_content)) {
                $file['error'] = __('Invalid SVG file.', 'sage');
                return $file;
            }
            
            // Check for dangerous content
            if (self::containsDangerousContent($svg_content)) {
                $file['error'] = __('SVG contains potentially dangerous content.', 'sage');
                return $file;
            }
            
            // Sanitize and save cleaned SVG
            $cleaned_svg = self::sanitizeSvgContent($svg_content);
            file_put_contents($file['tmp_name'], $cleaned_svg);
        }
        
        return $file;
    }

    /**
     * Fix SVG thumbnails in admin area
     */
    public static function fixSvgThumbnails()
    {
        echo '<style>
            .attachment-266x266[src$=".svg"], 
            .attachment-thumbnail[src$=".svg"] { 
                width: 100%; 
                height: auto; 
            }
            .media-icon img[src$=".svg"] {
                width: 100%;
                height: auto;
            }
        </style>';
    }

    /**
     * Enable SVG in WordPress image functions
     *
     * @param array|false $image
     * @param int $attachment_id
     * @param string|array $size
     * @param bool $icon
     * @return array|false
     */
    public static function enableSvgInImageFunctions($image, $attachment_id, $size, $icon)
    {
        if (get_post_mime_type($attachment_id) === 'image/svg+xml') {
            $svg_path = get_attached_file($attachment_id);
            $svg_url = wp_get_attachment_url($attachment_id);
            
            if ($svg_path && file_exists($svg_path)) {
                $dimensions = self::getSvgDimensions($svg_path);
                
                return [
                    $svg_url,
                    $dimensions['width'],
                    $dimensions['height'],
                    false
                ];
            }
        }
        
        return $image;
    }

    /**
     * Add proper attributes to SVG images
     *
     * @param array $attr
     * @param \WP_Post $attachment
     * @param string|array $size
     * @return array
     */
    public static function addSvgImageAttributes($attr, $attachment, $size)
    {
        if (get_post_mime_type($attachment) === 'image/svg+xml') {
            $attr['class'] = isset($attr['class']) ? $attr['class'] . ' svg-image' : 'svg-image';
        }
        
        return $attr;
    }

    /**
     * Generate metadata for SVG files
     *
     * @param array $metadata
     * @param int $attachment_id
     * @return array
     */
    public static function generateSvgMetadata($metadata, $attachment_id)
    {
        if (get_post_mime_type($attachment_id) === 'image/svg+xml') {
            $svg_path = get_attached_file($attachment_id);
            
            if (file_exists($svg_path)) {
                $dimensions = self::getSvgDimensions($svg_path);
                
                $metadata = [
                    'width' => $dimensions['width'],
                    'height' => $dimensions['height'],
                    'file' => basename($svg_path)
                ];
            }
        }
        
        return $metadata;
    }

    /**
     * Get SVG dimensions from file
     *
     * @param string $svg_path
     * @return array
     */
    private static function getSvgDimensions($svg_path)
    {
        $svg_content = file_get_contents($svg_path);
        $default_dimensions = ['width' => 150, 'height' => 150];
        
        if (!$svg_content) {
            return $default_dimensions;
        }
        
        // Try to get dimensions from SVG attributes
        if (preg_match('/width=["\']([0-9.]+)["\']/', $svg_content, $width_match) &&
            preg_match('/height=["\']([0-9.]+)["\']/', $svg_content, $height_match)) {
            return [
                'width' => (int) $width_match[1],
                'height' => (int) $height_match[1]
            ];
        }
        
        // Try to get dimensions from viewBox
        if (preg_match('/viewBox=["\']([0-9.\s-]+)["\']/', $svg_content, $viewbox_match)) {
            $viewbox = explode(' ', trim($viewbox_match[1]));
            if (count($viewbox) === 4) {
                return [
                    'width' => (int) $viewbox[2],
                    'height' => (int) $viewbox[3]
                ];
            }
        }
        
        return $default_dimensions;
    }

    /**
     * Check if SVG content is valid
     *
     * @param string $svg_content
     * @return bool
     */
    private static function isValidSvg($svg_content)
    {
        return strpos($svg_content, '<svg') !== false && 
               strpos($svg_content, '</svg>') !== false;
    }

    /**
     * Check for dangerous content in SVG
     *
     * @param string $svg_content
     * @return bool
     */
    private static function containsDangerousContent($svg_content)
    {
        $dangerous_elements = [
            'script', 'object', 'embed', 'iframe', 'link', 'meta', 'form'
        ];
        
        $dangerous_attributes = [
            'onload', 'onerror', 'onclick', 'onmouseover', 'onmouseout',
            'onmousedown', 'onmouseup', 'onfocus', 'onblur', 'onchange',
            'onsubmit', 'onreset', 'onselect', 'onkeydown', 'onkeypress',
            'onkeyup', 'javascript:'
        ];
        
        foreach ($dangerous_elements as $element) {
            if (stripos($svg_content, '<' . $element) !== false) {
                return true;
            }
        }
        
        foreach ($dangerous_attributes as $attribute) {
            if (stripos($svg_content, $attribute) !== false) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Sanitize SVG content
     *
     * @param string $svg_content
     * @return string
     */
    private static function sanitizeSvgContent($svg_content)
    {
        // Remove XML declaration and DOCTYPE if present
        $svg_content = preg_replace('/<\?xml.*?\?>/i', '', $svg_content);
        $svg_content = preg_replace('/<!DOCTYPE.*?>/i', '', $svg_content);
        
        // Remove comments
        $svg_content = preg_replace('/<!--.*?-->/s', '', $svg_content);
        
        // Remove dangerous elements
        $dangerous_elements = [
            'script', 'object', 'embed', 'iframe', 'link', 'meta', 'form'
        ];
        
        foreach ($dangerous_elements as $element) {
            $svg_content = preg_replace('/<' . $element . '.*?<\/' . $element . '>/is', '', $svg_content);
            $svg_content = preg_replace('/<' . $element . '.*?\/>/is', '', $svg_content);
        }
        
        return trim($svg_content);
    }
}
