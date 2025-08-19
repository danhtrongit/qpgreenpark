<?php

/**
 * Admin page registration for Partners
 */

namespace App;

/**
 * Register admin pages
 */
add_action('admin_menu', function () {
    // Partners admin page
    add_menu_page(
        __('Đối tác', 'qpgreenpark'),           // Page title
        __('Đối tác', 'qpgreenpark'),           // Menu title
        'manage_options',                        // Capability
        'partners',                              // Menu slug
        __NAMESPACE__ . '\\render_partners_page', // Callback function
        'dashicons-groups',                      // Icon
        30                                       // Position
    );

    // Utilities admin page
    add_menu_page(
        __('Tiện ích', 'qpgreenpark'),           // Page title
        __('Tiện ích', 'qpgreenpark'),           // Menu title
        'manage_options',                        // Capability
        'utilities',                             // Menu slug
        __NAMESPACE__ . '\\render_utilities_page', // Callback function
        'dashicons-admin-tools',                 // Icon
        31                                       // Position
    );

    // Library admin page
    add_menu_page(
        __('Thư viện', 'qpgreenpark'),           // Page title
        __('Thư viện', 'qpgreenpark'),           // Menu title
        'manage_options',                        // Capability
        'library',                               // Menu slug
        __NAMESPACE__ . '\\render_library_page', // Callback function
        'dashicons-format-gallery',              // Icon
        32                                       // Position
    );

    // Location admin page
    add_menu_page(
        __('Vị trí', 'qpgreenpark'),             // Page title
        __('Vị trí', 'qpgreenpark'),             // Menu title
        'manage_options',                        // Capability
        'location',                              // Menu slug
        __NAMESPACE__ . '\\render_location_page', // Callback function
        'dashicons-location',                    // Icon
        32                                       // Position
    );

    // Advantages admin page
    add_menu_page(
        __('Lợi thế', 'qpgreenpark'),            // Page title
        __('Lợi thế', 'qpgreenpark'),            // Menu title
        'manage_options',                        // Capability
        'advantages',                            // Menu slug
        __NAMESPACE__ . '\\render_advantages_page', // Callback function
        'dashicons-star-filled',                 // Icon
        33                                       // Position
    );

    // Floor Plan admin page
    add_menu_page(
        __('Mặt bằng', 'qpgreenpark'),           // Page title
        __('Mặt bằng', 'qpgreenpark'),           // Menu title
        'manage_options',                        // Capability
        'floorplan',                             // Menu slug
        __NAMESPACE__ . '\\render_floorplan_page', // Callback function
        'dashicons-grid-view',                   // Icon
        34                                       // Position
    );
});

/**
 * Render the Partners admin page
 */
function render_partners_page() {
    // Handle form submission
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['partners_nonce'], 'partners_save')) {
        // Save ACF fields
        if (function_exists('acf_save_post')) {
            $_POST['acf']['_acfnonce'] = wp_create_nonce('acf_nonce');
            acf_save_post('options');
        }

        echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã lưu thành công!', 'qpgreenpark') . '</p></div>';
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p><?php _e('Quản lý thông tin các đối tác của dự án QP Green Park.', 'qpgreenpark'); ?></p>

        <div class="partners-admin-content">
            <h2><?php _e('Hướng dẫn sử dụng', 'qpgreenpark'); ?></h2>
            <ul>
                <li><?php _e('Sử dụng các trường bên dưới để cập nhật thông tin chủ đầu tư và các đối tác.', 'qpgreenpark'); ?></li>
                <li><?php _e('Chủ đầu tư: Thông tin công ty chủ đầu tư chính của dự án.', 'qpgreenpark'); ?></li>
                <li><?php _e('Đối tác chiến lược: Danh sách các đối tác chiến lược quan trọng.', 'qpgreenpark'); ?></li>
                <li><?php _e('Đối tác phân phối: Danh sách các đối tác phân phối chính thức.', 'qpgreenpark'); ?></li>
            </ul>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field('partners_save', 'partners_nonce'); ?>

            <?php
            // Display ACF fields for options page
            if (function_exists('acf_form')) {
                acf_form([
                    'post_id' => 'options',
                    'field_groups' => ['group_chu_dau_tu', 'group_doi_tac_chien_luoc', 'group_doi_tac_phan_phoi'],
                    'form' => false,
                    'return' => '',
                ]);
            }
            ?>

            <?php submit_button(__('Lưu thay đổi', 'qpgreenpark')); ?>
        </form>
    </div>

    <style>
        .partners-admin-content {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
        }
        .partners-admin-content h2 {
            margin-top: 0;
            color: #23282d;
        }
        .partners-admin-content ul {
            margin-left: 20px;
        }
        .partners-admin-content li {
            margin-bottom: 8px;
            line-height: 1.5;
        }
    </style>
    <?php
}

/**
 * Render the Utilities admin page
 */
function render_utilities_page() {
    // Handle form submission
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['utilities_nonce'], 'utilities_save')) {
        // Save ACF fields
        if (function_exists('acf_save_post')) {
            $_POST['acf']['_acfnonce'] = wp_create_nonce('acf_nonce');
            acf_save_post('options');
        }

        echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã lưu thành công!', 'qpgreenpark') . '</p></div>';
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p><?php _e('Quản lý thông tin các tiện ích của dự án QP Green Park.', 'qpgreenpark'); ?></p>

        <div class="utilities-admin-content">
            <h2><?php _e('Hướng dẫn sử dụng', 'qpgreenpark'); ?></h2>
            <ul>
                <li><?php _e('Sử dụng các trường bên dưới để cập nhật thông tin tiện ích của dự án.', 'qpgreenpark'); ?></li>
                <li><?php _e('Tiêu đề section: Tiêu đề chính của phần tiện ích.', 'qpgreenpark'); ?></li>
                <li><?php _e('Mô tả: Mô tả ngắn gọn về các tiện ích.', 'qpgreenpark'); ?></li>
                <li><?php _e('Danh sách tiện ích: Thêm các tiện ích với hình ảnh và tên gọi.', 'qpgreenpark'); ?></li>
            </ul>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field('utilities_save', 'utilities_nonce'); ?>

            <?php
            // Display ACF fields for options page
            if (function_exists('acf_form')) {
                acf_form([
                    'post_id' => 'options',
                    'field_groups' => ['group_tien_ich'],
                    'form' => false,
                    'return' => '',
                ]);
            }
            ?>

            <?php submit_button(__('Lưu thay đổi', 'qpgreenpark')); ?>
        </form>
    </div>

    <style>
        .utilities-admin-content {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
        }
        .utilities-admin-content h2 { margin-top: 0; color: #23282d; }
        .utilities-admin-content ul { margin-left: 20px; }
        .utilities-admin-content li { margin-bottom: 8px; line-height: 1.5; }
    </style>
    <?php
}

/**
 * Render the Location admin page
 */
function render_location_page() {
    // Handle form submission
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['location_nonce'], 'location_save')) {
        // Save ACF fields
        if (function_exists('acf_save_post')) {
            $_POST['acf']['_acfnonce'] = wp_create_nonce('acf_nonce');
            acf_save_post('options');
        }

        echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã lưu thành công!', 'qpgreenpark') . '</p></div>';
    }

    // Handle demo seed (force, no redirect)
    if (isset($_POST['seed_demo']) && wp_verify_nonce($_POST['location_seed_nonce'], 'location_seed')) {
        if (!function_exists('update_field')) {
            echo '<div class="notice notice-error is-dismissible"><p>' . __('ACF chưa sẵn sàng để seed dữ liệu.', 'qpgreenpark') . '</p></div>';
        } else {
            // Seed demo data
            update_field('field_vi_tri_tieu_de', 'Vị trí dự án', 'option');
            update_field('field_vi_tri_phu_de', 'Tâm điểm thịnh vượng', 'option');
            update_field('field_vi_tri_mo_ta', 'Tọa lạc tại xã Bình Mỹ, huyện Bắc Tân Uyên, QP Green Park thừa hưởng lợi thế từ sự phát triển mạnh mẽ của hạ tầng giao thông và quy hoạch đô thị trong khu vực. Dự án nằm liền kề các tuyến giao thông huyết mạch như DT742 và DT747, tạo điều kiện thuận lợi cho cư dân kết nối nhanh chóng đến TP.HCM, Đồng Nai, Bình Phước cũng như các khu công nghiệp trọng điểm. Đây là lợi thế nổi bật, góp phần nâng cao tiềm năng khai thác, gia tăng giá trị đầu tư và tạo nền tảng vững chắc cho an cư lâu dài.', 'option');
            update_field('field_vi_tri_link_chi_tiet', '/vi-tri', 'option');
            update_field('field_vi_tri_text_nut', 'Xem chi tiết', 'option');

            echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã seed dữ liệu demo thành công!', 'qpgreenpark') . '</p></div>';
        }
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <div class="location-admin-content">
            <h2>Quản lý thông tin vị trí dự án</h2>
            <p>Cấu hình thông tin về vị trí và lợi thế địa lý của dự án QP Green Park.</p>
            <ul>
                <li><strong>Tiêu đề & Phụ đề:</strong> Thiết lập tiêu đề chính và phụ đề cho section vị trí</li>
                <li><strong>Mô tả:</strong> Nội dung mô tả chi tiết về vị trí và lợi thế</li>
                <li><strong>Hình ảnh:</strong> Hình ảnh minh họa vị trí dự án</li>
                <li><strong>Liên kết:</strong> Đường dẫn và text cho nút "Xem chi tiết"</li>
            </ul>
        </div>

        <!-- Demo Seed Form -->
        <form method="post" action="" style="margin-bottom: 20px;">
            <?php wp_nonce_field('location_seed', 'location_seed_nonce'); ?>
            <input type="submit" name="seed_demo" class="button button-secondary"
                   value="<?php echo esc_attr(__('Seed dữ liệu demo', 'qpgreenpark')); ?>"
                   onclick="return confirm('Bạn có chắc chắn muốn seed dữ liệu demo? Điều này sẽ ghi đè dữ liệu hiện tại.');" />
            <small style="margin-left: 10px; color: #666;">
                <?php _e('Tạo dữ liệu mẫu cho phần vị trí', 'qpgreenpark'); ?>
            </small>
        </form>

        <hr style="margin: 20px 0;" />

        <!-- Main Form -->
        <form method="post" action="">
            <?php wp_nonce_field('location_save', 'location_nonce'); ?>

            <?php
            // Display ACF fields for options page
            if (function_exists('acf_form')) {
                acf_form([
                    'post_id' => 'options',
                    'field_groups' => ['group_vi_tri'],
                    'form' => false,
                    'return' => '',
                ]);
            }
            ?>

            <?php submit_button(__('Lưu thay đổi', 'qpgreenpark')); ?>
        </form>
    </div>

    <style>
        .location-admin-content {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
        }
        .location-admin-content h2 {
            margin-top: 0;
            color: #23282d;
        }
        .location-admin-content ul {
            margin-left: 20px;
        }
        .location-admin-content li {
            margin-bottom: 8px;
            line-height: 1.5;
        }
    </style>
    <?php
}

/**
 * Render the Advantages admin page
 */
function render_advantages_page() {
    // Handle form submission
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['advantages_nonce'], 'advantages_save')) {
        // Save ACF fields
        if (function_exists('acf_save_post')) {
            $_POST['acf']['_acfnonce'] = wp_create_nonce('acf_nonce');
            acf_save_post('options');
        }

        echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã lưu thành công!', 'qpgreenpark') . '</p></div>';
    }

    // Handle demo seed (force, no redirect)
    if (isset($_POST['seed_demo']) && wp_verify_nonce($_POST['advantages_seed_nonce'], 'advantages_seed')) {
        if (!function_exists('update_field')) {
            echo '<div class="notice notice-error is-dismissible"><p>' . __('ACF chưa sẵn sàng để seed dữ liệu.', 'qpgreenpark') . '</p></div>';
        } else {
            // Title & subtitle
            update_field('field_loi_the_tieu_de', 'Chỉ có tại', 'option');
            update_field('field_loi_the_phu_de', 'QP Green Park', 'option');

            // Demo advantages data
            $demo_advantages = [
                [
                    'field_loi_the_tieu_de_item' => 'VỊ TRÍ ĐẮC ĐỊA',
                    'field_loi_the_mo_ta' => 'Tọa lạc tại Bình Mỹ, Bắc Tân Uyên, khu vực phát triển mạnh, có tiềm năng tăng giá trị bất động sản.',
                ],
                [
                    'field_loi_the_tieu_de_item' => 'THIẾT KẾ HIỆN ĐẠI',
                    'field_loi_the_mo_ta' => 'Kiến trúc vuông vức, mạnh mẽ, tối ưu công năng. Sử dụng mảng kính lớn và đường nét đứng tạo cảm giác sang trọng, cao ráo.',
                ],
                [
                    'field_loi_the_tieu_de_item' => 'SẢN PHẨM ĐA DẠNG',
                    'field_loi_the_mo_ta' => 'Cung cấp 6 mẫu nhà phố và 4 mẫu nhà thương mại, tạo nên một khu đô thị phong phú và sinh động.',
                ],
                [
                    'field_loi_the_tieu_de_item' => 'KHÔNG GIAN XANH',
                    'field_loi_the_mo_ta' => 'Các mảng xanh tại ban công và sân thượng giúp không gian sống gần gũi với thiên nhiên, tràn đầy sức sống.',
                ],
                [
                    'field_loi_the_tieu_de_item' => 'VẬT LIỆU CHẤT LƯỢNG',
                    'field_loi_the_mo_ta' => 'Sử dụng vật liệu hiện đại như kính cường lực và khung nhôm Xingfa, đảm bảo độ bền và tính thẩm mỹ cao.',
                ],
                [
                    'field_loi_the_tieu_de_item' => 'PHONG THỦY HÀI HÒA',
                    'field_loi_the_mo_ta' => 'Thiết kế dựa trên yếu tố phong thủy ứng với chu kỳ 9, lựa chọn màu sắc mang lại may mắn và vượng khí.',
                ],
            ];

            update_field('field_loi_the_danh_sach', $demo_advantages, 'option');

            echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã seed dữ liệu demo thành công!', 'qpgreenpark') . '</p></div>';
        }
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <div class="advantages-admin-content">
            <h2>Quản lý lợi thế dự án</h2>
            <p>Cấu hình thông tin về các lợi thế nổi bật của dự án QP Green Park.</p>
            <ul>
                <li><strong>Tiêu đề & Phụ đề:</strong> Thiết lập tiêu đề chính và phụ đề cho section lợi thế</li>
                <li><strong>Danh sách lợi thế:</strong> Thêm/sửa/xóa các lợi thế với hình ảnh, tiêu đề và mô tả</li>
                <li><strong>Thứ tự hiển thị:</strong> Sắp xếp thứ tự hiển thị các lợi thế</li>
            </ul>
        </div>

        <!-- Demo Seed Form -->
        <form method="post" action="" style="margin-bottom: 20px;">
            <?php wp_nonce_field('advantages_seed', 'advantages_seed_nonce'); ?>
            <input type="submit" name="seed_demo" class="button button-secondary"
                   value="<?php echo esc_attr(__('Seed dữ liệu demo', 'qpgreenpark')); ?>"
                   onclick="return confirm('Bạn có chắc chắn muốn seed dữ liệu demo? Điều này sẽ ghi đè dữ liệu hiện tại.');" />
            <small style="margin-left: 10px; color: #666;">
                <?php _e('Tạo dữ liệu mẫu cho phần lợi thế (chỉ tiêu đề và mô tả, không có hình ảnh)', 'qpgreenpark'); ?>
            </small>
        </form>

        <hr style="margin: 20px 0;" />

        <form method="post" action="">
            <?php wp_nonce_field('advantages_save', 'advantages_nonce'); ?>

            <?php
            // Display ACF fields for options page
            if (function_exists('acf_form')) {
                acf_form([
                    'post_id' => 'options',
                    'field_groups' => ['group_loi_the'],
                    'form' => false,
                    'return' => '',
                ]);
            }
            ?>

            <?php submit_button(__('Lưu thay đổi', 'qpgreenpark')); ?>
        </form>
    </div>

    <style>
        .advantages-admin-content {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
        }
        .advantages-admin-content h2 {
            margin-top: 0;
            color: #23282d;
        }
        .advantages-admin-content ul {
            margin-left: 20px;
        }
        .advantages-admin-content li {
            margin-bottom: 8px;
            line-height: 1.5;
        }
    </style>
    <?php
}

/**
 * Render the Floor Plan admin page
 */
function render_floorplan_page() {
    // Handle form submission (Save)
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['floorplan_nonce'], 'floorplan_save')) {
        if (function_exists('acf_save_post')) {
            $_POST['acf']['_acfnonce'] = wp_create_nonce('acf_nonce');
            acf_save_post('options');
        }
        echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã lưu thành công!', 'qpgreenpark') . '</p></div>';
    }

    // Handle demo seed (force, no redirect)
    if (isset($_POST['seed_demo']) && wp_verify_nonce($_POST['floorplan_seed_nonce'], 'floorplan_seed')) {
        if (!function_exists('update_field')) {
            echo '<div class="notice notice-error is-dismissible"><p>' . __('ACF chưa sẵn sàng để seed dữ liệu.', 'qpgreenpark') . '</p></div>';
        } else {
            // Title & subtitle
            update_field('field_mat_bang_tieu_de', 'Mặt bằng tổng thể', 'option');
            update_field('field_mat_bang_phu_de', 'Sơ đồ dự án', 'option');

            $floors = function ($pairs) {
                $rows = [];
                foreach ($pairs as $p) {
                    $rows[] = [
                        'field_mat_bang_ten_tang' => $p[0],
                        'field_mat_bang_dt_tang' => $p[1],
                    ];
                }
                return $rows;
            };

            $rows = [
                [ 'field_mat_bang_ten'=>'Mẫu TH.T1 - Căn giữa','field_mat_bang_loai'=>'townhouse','field_mat_bang_ma_mau'=>'TH.T1','field_mat_bang_vi_tri'=>'can-giua','field_mat_bang_quy_cach'=>'1 trệt, 2 lầu, 1 tum mái','field_mat_bang_kich_thuoc_dat'=>'5.0m x 20.0m','field_mat_bang_dien_tich_dat'=>100.00,'field_mat_bang_tong_xd'=>256.84,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',77.50],['Tầng 2',81.22],['Tầng 3',77.50],['Tầng tum mái',20.62]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu TH.T2 - Căn giữa','field_mat_bang_loai'=>'townhouse','field_mat_bang_ma_mau'=>'TH.T2','field_mat_bang_vi_tri'=>'can-giua','field_mat_bang_quy_cach'=>'1 trệt, 2 lầu, 1 tum mái','field_mat_bang_kich_thuoc_dat'=>'5.0m x 20.0m','field_mat_bang_dien_tich_dat'=>100.00,'field_mat_bang_tong_xd'=>256.84,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',77.50],['Tầng 2',81.22],['Tầng 3',77.50],['Tầng tum mái',20.62]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu TH.C1 - Căn góc','field_mat_bang_loai'=>'townhouse','field_mat_bang_ma_mau'=>'TH.C1','field_mat_bang_vi_tri'=>'can-goc','field_mat_bang_quy_cach'=>'1 trệt, 2 lầu, 1 tum mái','field_mat_bang_kich_thuoc_dat'=>'8.5m x 20.0m','field_mat_bang_dien_tich_dat'=>157.50,'field_mat_bang_tong_xd'=>320.18,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',90.66],['Tầng 2',106.58],['Tầng 3',95.09],['Tầng tum mái',27.86]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu TH.C2 - Căn góc','field_mat_bang_loai'=>'townhouse','field_mat_bang_ma_mau'=>'TH.C2','field_mat_bang_vi_tri'=>'can-goc','field_mat_bang_quy_cach'=>'1 trệt, 2 lầu, 1 tum mái','field_mat_bang_kich_thuoc_dat'=>'8.5m x 20.0m','field_mat_bang_dien_tich_dat'=>157.50,'field_mat_bang_tong_xd'=>296.62,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',85.73],['Tầng 2',99.61],['Tầng 3',85.47],['Tầng tum mái',25.81]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu TH.T3 - Căn giữa','field_mat_bang_loai'=>'townhouse','field_mat_bang_ma_mau'=>'TH.T3','field_mat_bang_vi_tri'=>'can-giua','field_mat_bang_quy_cach'=>'1 trệt, 2 lầu, 1 tum mái','field_mat_bang_kich_thuoc_dat'=>'5m x 14m','field_mat_bang_dien_tich_dat'=>70.0,'field_mat_bang_tong_xd'=>198.2,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',60.0],['Tầng 2',63.6],['Tầng 3',60.0],['Tầng tum mái',14.6]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu TH.T4 - Căn giữa','field_mat_bang_loai'=>'townhouse','field_mat_bang_ma_mau'=>'TH.T4','field_mat_bang_vi_tri'=>'can-giua','field_mat_bang_quy_cach'=>'1 trệt, 2 lầu, 1 tum mái','field_mat_bang_kich_thuoc_dat'=>'5m x 14m','field_mat_bang_dien_tich_dat'=>70.0,'field_mat_bang_tong_xd'=>198.2,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',60.0],['Tầng 2',63.6],['Tầng 3',60.0],['Tầng tum mái',14.6]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu SH.T1 - Căn giữa','field_mat_bang_loai'=>'shophouse','field_mat_bang_ma_mau'=>'SH.T1','field_mat_bang_vi_tri'=>'can-giua','field_mat_bang_quy_cach'=>'1 trệt, 4 lầu, 1 tum, mái','field_mat_bang_kich_thuoc_dat'=>'7m x 19m','field_mat_bang_dien_tich_dat'=>133.0,'field_mat_bang_tong_xd'=>515.6,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',101.4],['Tầng 2',99.1],['Tầng 3',101.4],['Tầng 4',94.9],['Tầng 5',94.9],['Tầng tum',24.0]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu SH.T2 - Căn giữa','field_mat_bang_loai'=>'shophouse','field_mat_bang_ma_mau'=>'SH.T2','field_mat_bang_vi_tri'=>'can-giua','field_mat_bang_quy_cach'=>'1 trệt, 4 lầu, 1 tum, mái','field_mat_bang_kich_thuoc_dat'=>'7m x 19m','field_mat_bang_dien_tich_dat'=>133.0,'field_mat_bang_tong_xd'=>515.1,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',101.2],['Tầng 2',98.9],['Tầng 3',101.2],['Tầng 4',94.9],['Tầng 5',94.9],['Tầng tum',24.0]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu SH.C1 - Căn góc','field_mat_bang_loai'=>'shophouse','field_mat_bang_ma_mau'=>'SH.C1','field_mat_bang_vi_tri'=>'can-goc','field_mat_bang_quy_cach'=>'1 trệt, 4 lầu, 1 tum, mái','field_mat_bang_kich_thuoc_dat'=>'11.5m x 19m','field_mat_bang_dien_tich_dat'=>206.0,'field_mat_bang_tong_xd'=>571.1,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',112.8],['Tầng 2',112.8],['Tầng 3',112.8],['Tầng 4',100.7],['Tầng 5',95.9],['Tầng tum',36.3]]) ],
                [ 'field_mat_bang_ten'=>'Mẫu SH.C2 - Căn góc','field_mat_bang_loai'=>'shophouse','field_mat_bang_ma_mau'=>'SH.C2','field_mat_bang_vi_tri'=>'can-goc','field_mat_bang_quy_cach'=>'1 trệt, 4 lầu, 1 tum, mái','field_mat_bang_kich_thuoc_dat'=>'11.5m x 19m','field_mat_bang_dien_tich_dat'=>206.0,'field_mat_bang_tong_xd'=>573.4,'field_mat_bang_dien_tich_tang'=>$floors([['Tầng 1',113.1],['Tầng 2',113.1],['Tầng 3',113.1],['Tầng 4',101.4],['Tầng 5',96.6],['Tầng tum',36.3]]) ],
            ];

            update_field('field_mat_bang_danh_sach', $rows, 'option');
            update_option('floorplan_demo_seeded', 1);
            echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã seed dữ liệu demo cho Mặt bằng.', 'qpgreenpark') . '</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p><?php _e('Quản lý thông tin mặt bằng của dự án QP Green Park.', 'qpgreenpark'); ?></p>

        <div class="floorplan-admin-content">
            <h2><?php _e('Hướng dẫn sử dụng', 'qpgreenpark'); ?></h2>
            <ul>
                <li><?php _e('Cập nhật tiêu đề, phụ đề và danh sách các mặt bằng.', 'qpgreenpark'); ?></li>
                <li><?php _e('Mỗi mục mặt bằng gồm: Tên, Mô tả, Hình ảnh, File PDF/URL.', 'qpgreenpark'); ?></li>
                <li><?php _e('Dữ liệu sẽ hiển thị tại trang Template "Mặt bằng".', 'qpgreenpark'); ?></li>
            </ul>
        </div>

        <!-- Seed Demo Form -->
        <form method="post" action="" style="margin-top:12px;">
            <?php wp_nonce_field('floorplan_seed', 'floorplan_seed_nonce'); ?>
            <input type="hidden" name="seed_demo" value="1" />
            <?php submit_button(__('Seed dữ liệu demo', 'qpgreenpark'), 'secondary', 'seed_demo_btn', false); ?>
            <span style="margin-left:8px; color:#555;">(Thực hiện seed dữ liệu demo theo mẫu đã định nghĩa)</span>
        </form>

        <?php if (isset($_GET['seeded'])): ?>
            <div class="notice notice-info is-dismissible" style="margin-top:12px;"><p><?php _e('Đang seed dữ liệu, vui lòng tải lại trang…', 'qpgreenpark'); ?></p></div>
        <?php endif; ?>

        <hr style="margin: 20px 0;" />

        <!-- Main Form -->
        <form method="post" action="">
            <?php wp_nonce_field('floorplan_save', 'floorplan_nonce'); ?>

            <?php
            // Display ACF fields for options page
            if (function_exists('acf_form')) {
                acf_form([
                    'post_id' => 'options',
                    'field_groups' => ['group_mat_bang'],
                    'form' => false,
                    'return' => '',
                ]);
            }
            ?>

            <?php submit_button(__('Lưu thay đổi', 'qpgreenpark')); ?>
        </form>
    </div>

    <style>
        .floorplan-admin-content {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
        }
        .floorplan-admin-content h2 { margin-top: 0; color: #23282d; }
        .floorplan-admin-content ul { margin-left: 20px; }
        .floorplan-admin-content li { margin-bottom: 8px; line-height: 1.5; }
    </style>
    <?php
}

/**
 * Render the Library admin page
 */
function render_library_page() {
    // Handle form submission
    if (isset($_POST['submit']) && wp_verify_nonce($_POST['library_nonce'], 'library_save')) {
        // Save ACF fields
        if (function_exists('acf_save_post')) {
            $_POST['acf']['_acfnonce'] = wp_create_nonce('acf_nonce');
            acf_save_post('options');
        }

        echo '<div class="notice notice-success is-dismissible"><p>' . __('Đã lưu thành công!', 'qpgreenpark') . '</p></div>';
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p><?php _e('Quản lý thông tin thư viện hình ảnh và tài liệu của dự án QP Green Park.', 'qpgreenpark'); ?></p>

        <div class="library-admin-content">
            <h2><?php _e('Hướng dẫn sử dụng', 'qpgreenpark'); ?></h2>
            <ul>
                <li><?php _e('Sử dụng các trường bên dưới để cập nhật thông tin thư viện.', 'qpgreenpark'); ?></li>
                <li><?php _e('Bối cảnh 3D: Quản lý hình ảnh tổng thể dự án với hiệu ứng 3D.', 'qpgreenpark'); ?></li>
                <li><?php _e('Tài liệu dự án: Quản lý các file PDF và tài liệu kỹ thuật.', 'qpgreenpark'); ?></li>
                <li><?php _e('Mỗi mục có thể bao gồm hình ảnh, tiêu đề, mô tả và file đính kèm.', 'qpgreenpark'); ?></li>
            </ul>
        </div>

        <form method="post" action="">
            <?php wp_nonce_field('library_save', 'library_nonce'); ?>

            <?php
            // Display ACF fields for options page
            if (function_exists('acf_form')) {
                acf_form([
                    'post_id' => 'options',
                    'field_groups' => ['group_boi_canh_3d', 'group_tai_lieu_du_an'],
                    'form' => false,
                    'return' => '',
                ]);
            }
            ?>

            <?php submit_button(__('Lưu thay đổi', 'qpgreenpark')); ?>
        </form>
    </div>

    <style>
        .library-admin-content {
            background: #fff;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ccd0d4;
            border-radius: 4px;
        }
        .library-admin-content h2 {
            margin-top: 0;
            color: #23282d;
        }
        .library-admin-content ul {
            margin-left: 20px;
        }
        .library-admin-content li {
            margin-bottom: 8px;
            line-height: 1.5;
        }
    </style>
    <?php
}

/**
 * Enqueue ACF scripts on admin pages
 */
add_action('admin_enqueue_scripts', function ($hook) {
    if (!in_array($hook, ['toplevel_page_partners', 'toplevel_page_utilities', 'toplevel_page_location', 'toplevel_page_advantages', 'toplevel_page_library', 'toplevel_page_floorplan'])) {
        return;
    }

    if (function_exists('acf_enqueue_scripts')) {
        acf_enqueue_scripts();
    }
});

/**
 * Register ACF JSON save and load paths
 */
add_filter('acf/settings/save_json', function ($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function ($paths) {
    // Remove original path (optional)
    unset($paths[0]);

    // Add new path
    $paths[] = get_stylesheet_directory() . '/acf-json';

    return $paths;
});

/**
 * Display sync notice for ACF field groups
 */
add_action('admin_notices', function () {
    // Only show on admin pages
    if (!isset($_GET['page']) || !in_array($_GET['page'], ['partners', 'utilities', 'location', 'advantages', 'library', 'floorplan'])) {
        return;
    }

    // Check if there are local field groups that need syncing
    if (function_exists('acf_get_local_field_groups')) {
        $local_field_groups = acf_get_local_field_groups();
        $needs_sync = false;

        foreach ($local_field_groups as $key => $field_group) {
            $db_field_group = acf_get_field_group($key);
            if (!$db_field_group) {
                $needs_sync = true;
                break;
            }
        }

        if ($needs_sync) {
            echo '<div class="notice notice-info is-dismissible">';
            echo '<p><strong>ACF Field Groups:</strong> ';
            echo 'Có field groups mới cần được đồng bộ. ';
            echo 'Vào <a href="' . admin_url('edit.php?post_type=acf-field-group&page=acf-tools') . '">ACF Tools → Sync</a> để đồng bộ.';
            echo '</p>';
            echo '</div>';
        }
    }
    });
