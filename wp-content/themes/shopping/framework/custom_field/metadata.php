<?php

/**
 * Initialize the meta boxes. See /option-tree/assets/theme-mode/demo-meta-boxes.php for reference
 *
 */
add_action('admin_init', 'eweb_meta_boxes');

if (!function_exists('eweb_meta_boxes')) {

    function eweb_meta_boxes() {

        $meta_boxes = array();
        //tạo metabox
        $meta_boxes_product = array(
            'id' => 'setting-for-product',
            'title' => __('Cấu hình thêm', 'eweb'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id'          => 'on_off_km',
                    'label'       => __( 'Sản phẩm Khuyến Mãi', 'ew' ),
                    'desc'        => '',
                    'std'         => 'off',
                    'type'        => 'on-off',
                    'operator'    => 'and'
                ),
                array(
                    'id' => 'khuyen_mai',
                    'label' => __('Thông tin khuyến mãi', 'eweb'),
                    'desc' => '',
                    'type' => 'textarea',
                ),
                // array(
                //     'id'          => 'is_hot_product',
                //     'label'       => 'Sản phẩm HOT',
                //     'desc'        => '',
                //     'type'        => 'checkbox',
                //     'choices'     => array(
                //         array(
                //         'value'       => 'hot_product',
                //         'label'       => 'Đây có phải là sản phẩm HOT? (Check: Yes - Uncheck: No)',
                //         )
                //     )
                // ),
            ),
        );

        $s_hour = $s_min = $s_sec = array();

        foreach (range(0, 23) as $n) {
            if ($n < 10)
                $n = '0' . $n;
            $s_hour[] = array(
                'value' => $n,
                'label' => $n
            );
        }

        foreach (range(0, 60) as $n) {
            if ($n < 10)
                $n = '0' . $n;
            $s_min[] = array(
                'value' => $n,
                'label' => $n
            );
            $s_sec[] = array(
                'value' => $n,
                'label' => $n
            );
        }

        $meta_boxes_downtime = array(
            'id' => 'setting-downtime',
            'title' => __('Sales Countdown', 'eweb'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'side',
            'priority' => 'high',
            'fields' => array(
                array(
                    'id' => 'countdown',
                    'label' => __('Countdown', 'eweb'),
                    'desc' => '',
                    'std' => 'off',
                    'type' => 'on-off'
                ),
                array(
                    'id' => 'count_date',
                    'label' => __('Ngày', 'eweb'),
                    'desc' => '',
                    'std' => date('Y-m-d'),
                    'type' => 'date-picker',
                ),
                array(
                    'id' => 'count_hour',
                    'label' => __('Giờ', 'eweb'),
                    'desc' => '',
                    'std' => '00',
                    'type' => 'select',
                    'choices' => $s_hour
                ),
                array(
                    'id' => 'count_min',
                    'label' => __('Phút', 'eweb'),
                    'desc' => '',
                    'std' => '00',
                    'type' => 'select',
                    'choices' => $s_min
                ),
                array(
                    'id' => 'count_sec',
                    'label' => __('Giây', 'eweb'),
                    'desc' => '',
                    'std' => '00',
                    'type' => 'select',
                    'choices' => $s_sec
                ),
            ),
        );
        ot_register_meta_box($meta_boxes_product);
        ot_register_meta_box($meta_boxes_downtime);
    }

}