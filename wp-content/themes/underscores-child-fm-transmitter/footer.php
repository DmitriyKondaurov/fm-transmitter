<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="container contacts">
            <div class="row">
                <span>Черкассы | Новая Почта</span><br>
                <span>ул. Благовесная 379 отд. №8</span><br>
                <div class="phone" >
                    <a href="viber://add?number=380978314414" class="tel"><span class="viber">Viber:</span>
                        +380978314414</a>
                </div>
                <ul class="social">
                    <li>
                        <a class="facebook-icon" href="https://www.facebook.com/" target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
                    </li>
                    <li>
                        <a class="facebook-icon" href="https://plus.google.com" target="_blank">
                            <i class="fa fa-google-plus" aria-hidden="true"></i></i>Google+</a>
                    </li>
                    <li>
                        <a class="facebook-icon" href="https://twitter.com/" target="_blank">
                            <i class="fa fa-instagram" aria-hidden="true"></i>Instagram</a>
                    </li>
                </ul>
            </div>
        </div>
		<div class="site-info">

			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'underscores' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'CMS: %s', 'underscores' ), 'WordPress' );
			?></a>

			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Proudly produced by %s', 'underscores' ), 'Kondaurov Dmytro' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script id="bx24_form_button" data-skip-moving="true">
    (function(w,d,u,b){w['Bitrix24FormObject']=b;w[b] = w[b] || function(){arguments[0].ref=u;
        (w[b].forms=w[b].forms||[]).push(arguments[0])};
        if(w[b]['forms']) return;
        var s=d.createElement('script');s.async=1;s.src=u+'?'+(1*new Date());
        var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
    })(window,document,'https://kondashop.bitrix24.ua/bitrix/js/crm/form_loader.js','b24form');

    b24form({"id":"8","lang":"ru","sec":"9l9llj","type":"button","click":""});
</script>
</body>
</html>
