<?php

get_header();

$data = get_post_meta(get_the_ID(), 'com5anker_data', true);

?>
<section id="primary" class="content-area">
	<main id="main" class="site-main">
		<wls-boat id="<?php echo esc_attr($data->id); ?>"></wls-boat>
	</main>
</section>
<?php
get_footer();
