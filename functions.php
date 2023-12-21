<?php
if (site_url() == "http://localhost/theme/module-1") {
    define('VERSION', time());
} else {
    define('VERSION', wp_get_theme()->get('version'));
}

function launcher_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    load_theme_textdomain('launcher');
}
add_action('after_setup_theme', 'launcher_theme_setup');

function launcher_assets()
{
    if (is_page()) {
        $launcher_template_name = basename(get_page_template());
        if ($launcher_template_name == 'launcher.php') {
            wp_enqueue_style('launcher', get_stylesheet_uri(), null, VERSION);
            wp_enqueue_style('animate-css', get_theme_file_uri('/assets/css/animate.css'));
            wp_enqueue_style('icomoon-css', get_theme_file_uri('/assets/css/icomoon.css'));
            wp_enqueue_style('bootstrap-css', get_theme_file_uri('/assets/css/bootstrap.css'));
            wp_enqueue_style('custom-css', get_theme_file_uri('/assets/css/style.css'), null, VERSION);
            //Enqueue Scripts
            wp_enqueue_script('easing-js', get_theme_file_uri('assets/js/jquery.easing.1.3.js'), array('jquery'), '0.0.1', true);
            wp_enqueue_script('bootstrap-min-js', get_theme_file_uri('/assets/js/bootstrap.min.js'), array('jquery'), null, true);
            wp_enqueue_script('waypointsmin-js', get_theme_file_uri('/assets/js/jquery.waypoints.min.js'), array('jquery'), null, true);
            wp_enqueue_script('simple-counter-js', get_theme_file_uri('/assets/js/simplyCountdown.js'), array('jquery'), null, true);
            wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/main.js'), array('jquery'), VERSION, true);

            //Extract Launcher Data and Pass to Js
            $launcher_year = get_post_meta(get_the_ID(), 'Year', true);
            $launcher_month = get_post_meta(get_the_ID(), 'Month', true);
            $launcher_day = get_post_meta(get_the_ID(), 'Day', true);
            wp_localize_script('main-js', 'launcherdate', array(
                "year"        => $launcher_year,
                "month"       => $launcher_month,
                "day"         => $launcher_day
            ));
        } else {
            wp_enqueue_style('launcher', get_stylesheet_uri(), null, VERSION);
            wp_enqueue_style('bootstrap-css', get_theme_file_uri('/assets/css/bootstrap.css'));
        }
    }
}
add_action('wp_enqueue_scripts', 'launcher_assets');

//Register Widgets
function launcher_widgets()
{
    register_sidebar(
        array(
            'name'          => __('Footer Right', 'launcher'),
            'id'            => 'footer-rihgt',
            'description'   => __('widgets in this area will be shown on footer left', 'launcher'),
        )
    );
    register_sidebar(
        array(
            'name'          => __('Footer Left', 'launcher'),
            'id'            => 'footer-left',
            'description'   => __('widgets in this area will be shown on footer right', 'launcher'),

            'before_widget' => '<li id="%1s" class="text-right widget %2s">',
            'after_widget'  => '</li>',
            'before_title'  => '<ul id="fh5co-social">',
            'after_title'   => '</ul>',
        )
    );
}

add_action('widgets_init', 'launcher_widgets');

//add background on leftside
function launcher_styles()
{
    if (is_page()) {
        $launcher_feture_image = get_the_post_thumbnail_url(null, 'large');
?>
        <style>
            .bg-img {
                background-image: url(<?php echo $launcher_feture_image; ?>);
            }
        </style>
<?php
    }
}
add_action('wp_head', 'launcher_styles');
