<?php
/*
*Template Name: Launcher 
*/
?>
<?php
get_header();
$launcher_placeholder_text = get_post_meta(get_the_ID(), 'Placeholder', true);
$launcher_btn_text = get_post_meta(get_the_ID(), 'Button Label', true);
$launcher_hint = get_post_meta(get_the_ID(), 'Hint', true);
?>

<body <?php body_class(); ?>>
    <div class="fh5co-loader"></div>

    <aside id="fh5co-aside" role="sidebar" class="text-center bg-img">
        <h1 id="fh5co-logo"><a href="<?php site_url(); ?> "><?php bloginfo('name'); ?></a></h1>
    </aside>

    <div id="fh5co-main-content">
        <div class="dt js-dt">
            <div class="dtc js-dtc">
                <div class="simply-countdown-one animate-box" data-animate-effect="fadeInUp"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="fh5co-intro animate-box">
                                    <h2><?php the_title(); ?></h2>
                                    <p><?php the_content(); ?></p>
                                </div>
                            </div>

                            <div class="col-lg-7 animate-box">
                                <form action="#" id="fh5co-subscribe">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="<?php esc_attr(_e($launcher_placeholder_text, 'launcher')); ?>">
                                        <input type="submit" value="<?php esc_attr(_e($launcher_btn_text, 'launcher')); ?>" class="btn btn-primary">
                                        <p class="tip"><?php esc_html(_e($launcher_hint, 'launcher')); ?></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="fh5co-footer">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    if (is_active_sidebar('footer-left')) {
                        dynamic_sidebar('footer-left');
                    }
                    ?>
                </div>
                <div class="col-md-6 fh5co-copyright">
                    <?php
                    if (is_active_sidebar('footer-rihgt')) {
                        dynamic_sidebar('footer-rihgt');
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
    <?php get_footer(); ?>