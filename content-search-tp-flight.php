<?php
/**
 * @package WordPress
 * @subpackage Traveler
 * @since 1.0
 *
 * Content search flight
 *
 * Created by ShineTheme
 *
 */

wp_enqueue_script( 'bootstrap-datepicker.js' ); wp_enqueue_script( 'bootstrap-datepicker-lang.js' );
wp_enqueue_script('st.travelpayouts');

$fields = array(
    array(
        'title' => esc_html__('Origin', ST_TEXTDOMAIN),
        'name' => 'origin',
        'placeholder' => esc_html__('Origin', ST_TEXTDOMAIN),
        'layout_col' => '6',
        'layout2_col' => '6',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Destination', ST_TEXTDOMAIN),
        'name' => 'destination',
        'placeholder' => esc_html__('Destination', ST_TEXTDOMAIN),
        'layout_col' => '6',
        'layout2_col' => '6',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Depart date', ST_TEXTDOMAIN),
        'name' => 'depart',
        'placeholder' => esc_html__('Depart date', ST_TEXTDOMAIN),
        'layout_col' => '3',
        'layout2_col' => '3',
        'is_required' => 'on'
    ),
    array(
        'title' => esc_html__('Return date', ST_TEXTDOMAIN),
        'name' => 'return',
        'placeholder' => esc_html__('Return date', ST_TEXTDOMAIN),
        'layout_col' => '3',
        'layout2_col' => '3',
        'is_required' => 'off'
    ),
    array(
        'title' => esc_html__('Passengers/Class', ST_TEXTDOMAIN),
        'name' => 'passengers-class',
        'placeholder' => esc_html__('Passengers/Class', ST_TEXTDOMAIN),
        'layout_col' => '4',
        'layout2_col' => '4',
        'is_required' => 'off'
    )
);

$st_direction = !empty($st_direction) ? $st_direction : "horizontal";

$marker = st()->get_option('tp_marker', '111111');

if (!isset($field_size)) $field_size = '';
?>
<h2 class='mb20'><?php echo esc_html($st_title_search) ?></h2>
<?php $link = st()->get_option('custom_flight_search_link', ''); ?>
<form role="search" method="get" class="search main-search" autocomplete="off" action="https://jetradar.com/searches/new" target="_blank">
    <input type="hidden" name="marker" value="<?php echo esc_attr($marker); ?>">
    <div class="row">
        <?php
        if (!empty($fields)) {
            foreach ($fields as $key => $value) {
                $default = array(
                    'placeholder' => ''
                );
                $value = wp_parse_args($value, $default);
                $name = $value['name'];

                $size = '4';
                if ($st_style_search == "style_1") {
                    $size = $value['layout_col'];
                } else {
                    if (!empty($value['layout2_col'])) {
                        $size = $value['layout2_col'];
                    }
                }

                if ($st_direction == 'vertical') {
                    $size = '12';
                }
                $size_class = " col-md-" . $size . " col-lg-" . $size . " col-sm-12 col-xs-12 ";
                ?>
                <div class="<?php echo esc_attr($size_class); ?>">
                    <?php echo st()->load_template('travelpayouts_api/search/flight/field-' . $name, false, array('data' => $value, 'field_size' => $field_size, 'location_from' => 'a1', 'location_to' => 'a2', 'placeholder' => $value['placeholder'], 'st_direction' => $st_direction, 'is_required' => $value['is_required'])) ?>
                </div>
                <?php
            }
        } ?>
    </div>

    <button class="btn btn-primary btn-lg" type="submit"><?php echo esc_html__('Search For Flights', ST_TEXTDOMAIN); ?></button>
    <span class="api_info"><i class="fa fa-info-circle"></i> <?php echo esc_html__('Search flights API of ', ST_TEXTDOMAIN)?><a href="https://travelpayouts.com" target="_blank">TravelPayouts</a></span>
</form>
