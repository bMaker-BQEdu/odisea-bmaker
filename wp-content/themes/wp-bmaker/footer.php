

<!--        </div>-->
        <!-- /wrapper -->
        <!-- footer -->
        <footer class="footer bg-dark text-white">
            <div class="container d-flex flex-column-reverse flex-md-row justify-content-between py-4 py-md-5 text-center">
                <svg height="60px" width="188px" class="icon icon-logo_3 m-auto m-md-0"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-logo_3"></use></svg>
<!--                <img class="mx-auto m-md-0" width="140" src="--><?php //bloginfo('template_url'); ?><!--/img/odisea-bmaker-logo.png" />-->
                <div class="text-md-right">
                    <p class="font-weight-bold mb-1"><?php _e( 'Contacto', 'wpbmaker' ); ?></p>
                    <p><?php _e( 'hola@bmaker.es · 91 524 94 20', 'wpbmaker' ); ?></p>
                </div>
            </div><!-- /.container -->
            <div class="text-center border-top">
                    <?php wpbmakerfooter_nav(); ?>
<!--                <div class="text-center p-2">-->
<!--                    <p class="copyright">-->
<!--                        <small>&copy; --><?php //echo date('Y'); ?><!-- Copyright --><?php //bloginfo('name'); ?><!--.</small>-->
<!--                    </p>-->
<!--                </div>!-->
            </div><!-- /.container -->
        </footer>
        <!-- /footer -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

	</body>
</html>
