<?php get_header(); ?>
<main>
        <!-- section -->
        <section>
            <div class="main-banner text-center text-md-left text-white bg-primary">
                <div class="container">
                    <span class="font-weight-bold text-size-5 mb-3 mt-md-4 mb-md-3 my-lg-4 d-block"><?php _e( 'I Edición del concurso', 'wpbmaker' ); ?></span>
                    <h1 class="my-lg-3"><svg height="60" alt="<?php _e( 'ODISEA bMaker', 'wpbmaker' ); ?>" class="icon icon-logo"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-logo"></use></svg></h1>
                    <p class="font-weight-bold py-3 mb-3 mb-md-0"><?php _e( 'Participa en la Odisea bMaker,  consigue un aula maker para tu centro y contribuye a la igualdad de oportunidades en la educación', 'wpbmaker' ); ?></p>
                </div>
            </div>
            <?php
            $args = array( 'post_type' => 'winners',
                'numberposts' => '1',
                'post_status' => 'publish',
                'orderby'=> 'date');
            //'orderby'=> 'modified');
            $loop = new WP_Query( $args );

            if ($loop->have_posts()) : ?>
             <div class="winners-banner bg-gray-400 text-center py-5">
                 <div class="container">
                     <h2 class="font-weight-bold text-center"><?php _e( '¡Ya tenemos a los ganadores!', 'wpbmaker' ); ?></h2>
                     <ul class="row list-unstyled">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <li id="post-<?php the_ID(); ?>-primaria" <?php post_class('col-12 col-md-6'); ?>>
                            <div class="video-card text-left">
                                <?php
                                if( have_rows('videos_del_ganador_de_primaria') ):

                                    // loop through the rows of data
                                    while ( have_rows('videos_del_ganador_de_primaria') ) : the_row();
                                        // vars
                                        $iframe = get_sub_field('url');
                                        // use preg_match to find iframe src
                                        preg_match('/src="(.+?)"/', $iframe, $matches);
                                        $src = $matches[1];
                                        $teamName = get_sub_field('nombre_del_equipo');
                                        $description = get_sub_field('descripcion');

                                    endwhile;
                                endif; ?>
                                <div class="video-wrapper primaria">
                                    <iframe width="100%" height="258" src="<?php echo($src); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <h3 class="font-weight-bold"><?php _e( "El equipo ganador de primaria es…", "wpbmaker" )?> </h3>
                                <p class="team-name"><i><?php echo($teamName); ?></i></p>
                                <div class="description"><?php echo($description); ?></div>
                            </div>
                        </li>
                        <li id="post-<?php the_ID(); ?>-secundaria" <?php post_class('col-12 col-md-6'); ?>>
                            <div class="video-card text-left">
                                <?php
                                if( have_rows('videos_del_ganador_de_secundaria') ):

                                    // loop through the rows of data
                                    while ( have_rows('videos_del_ganador_de_secundaria') ) : the_row();
                                        // vars
                                        $iframe = get_sub_field('url');
                                        // use preg_match to find iframe src
                                        preg_match('/src="(.+?)"/', $iframe, $matches);
                                        $src = $matches[1];

                                        $teamName = get_sub_field('nombre_del_equipo');
                                        $description = get_sub_field('descripcion');

                                    endwhile;
                                endif; ?>
                                <div class="video-wrapper secundaria">
                                    <iframe width="100%" height="258" src="<?php echo($src); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <h3 class="font-weight-bold"><?php _e( "El equipo ganador de secundaria es…", "wpbmaker" )?> </h3>
                                <p class="team-name"><i><?php echo($teamName); ?></i></p>
                                <div class="description"><?php echo($description); ?></div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                     </ul>
                     <p class="winners-footer text-center m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer condimentum aliquet ex in dignissim. Cras sagittis, velit vitae imperdiet scelerisque, tortor lacus facilisis ipsum.</p>
                 </div>
                </div>
            <?php endif; ?>
            <div class="d-md-flex justify-content-between align-items-center row no-gutters mx-auto">
                <p class="pt-4 pb-3 px-3 col-12 col-md-6 pl-lg-5"><?php _e( 'El concurso consiste en desarrollar un proyecto bMaker que utilice técnicas de programación, robótica y/o 3D, disponibles en el website <a class="font-weight-bold" href="https://www.bmaker.es/">bMaker</a> que contribuya a crear un entorno más sostenible.', 'wpbmaker' ); ?></p>
                <picture class="img-fluid col-12 col-md-6">
                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                    <source srcset="<?php bloginfo('template_url'); ?>/img/home/home-section1-420px.jpg" media="(min-width: 1280px)">
                    <source srcset="<?php bloginfo('template_url'); ?>/img/home/home-section1-250px.jpg" media="(min-width: 768px)">
                    <!--[if IE 9]></video><![endif]-->
                    <img class="img-fluid d-block w-100" srcset="<?php bloginfo('template_url'); ?>/img/home/home-section1-240px.jpg" alt="…" />
                </picture>
            </div>
            <div class="bg-gray-400 text-center py-5 px-0 px-md-5 px-lg-5">
                <div class="container">
                    <h2 class="d-none d-md-block text-size-4 font-weight-bold mb-md-5"><?php _e( 'Instrucciones', 'wpbmaker' ); ?></h2>
                    <ol class="ordered-list text-md-left list-unstyled m-0 mx-auto row">
                        <li class="col-12 col-md-6 pt-3 px-3 pb-1 d-lg-flex align-items-center">
                            <svg height="80px" width="80px" class="icon icon-icon-com-form"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-icon-com-form"></use></svg>
                            <div class="ml-lg-3">
                                <p class="font-weight-bold mt-3"><?php _e( 'Inscribe al equipo', 'wpbmaker' ); ?></p>
                                <p><?php _e( 'A través del formulario de inscripción.', 'wpbmaker' ); ?></p>
                            </div>
                        </li>
                        <li class="col-12 col-md-6 pt-3 px-3 pb-1 d-lg-flex align-items-center">
                            <svg height="80px" width="80px" class="icon icon-icon-com-pencil-ruler"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-icon-com-pencil-ruler"></use></svg>
                            <div class="ml-lg-3">
                                <p class="font-weight-bold mt-3"><?php _e( 'Realiza el proyecto', 'wpbmaker' ); ?></p>
                                <p><?php _e( 'Construir un proyecto contribuyendo a crear un entorno más sostenible.', 'wpbmaker' ); ?></p>
                            </div>
                        </li>
                        <li class="col-12 col-md-6 pt-3 px-3 pb-1 d-lg-flex align-items-center">
                            <svg height="80px" width="80px" class="icon icon-icon-com-diary"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-icon-com-diary"></use></svg>
                            <div class="ml-lg-3">
                                <p class="font-weight-bold mt-3"><?php _e( 'Comparte tus hitos', 'wpbmaker' ); ?></p>
                                <p><?php _e( 'Escribe y publica los tres hitos para contarle al mundo qué tal os va al concurso.', 'wpbmaker' ); ?></p>
                            </div>
                        </li>
                        <li class="col-12 col-md-6 pt-3 px-3 pb-1 d-lg-flex align-items-center">
                            <svg height="80px" width="80px" class="icon icon-icon-com-camera"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-icon-com-camera"></use></svg>
                            <div class="ml-lg-3">
                                <p class="font-weight-bold mt-3"><?php _e( 'Graba y envía el proyecto', 'wpbmaker' ); ?></p>
                                <p><?php _e( 'Graba en vídeo el resultado final, súbelo a youtube y envíanos la URL.', 'wpbmaker' ); ?></p>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="container inscription-banner">
                <div class="d-flex flex-column flex-md-row-reverse align-items-center justify-content-md-end">
                    <?php if (get_option('users_can_register')) { ?>
                    <img class="my-5" width="300px" src="<?php bloginfo('template_url'); ?>/img/home/home-section3.svg" />
                    <div class="col-md-6 text-center text-md-left mb-4">
                        <h2 class="text-size-4 font-weight-bold"><?php _e( 'Inscríbete', 'wpbmaker' ); ?></h2>
                        <p class="my-3"><?php _e( 'No pierdas la oportunidad de ganar un aula Maker, inscribiéndote antes del 15 de noviembre', 'wpbmaker' ); ?></p>
                        <a href="" class="btn btn-primary"><span class="font-weight-bold"><?php _e( '¡Ir al formulario de inscripción!', 'wpbmaker' ); ?></span></a>
                    </div>
                    <?php } else { ?>
                        <img class="my-5" width="300px" src="<?php bloginfo('template_url'); ?>/img/home/home-section-3-2.svg" />
                        <div class="col-md-6 text-center text-md-left mb-4">
                            <h2 class="text-size-4 font-weight-bold"><?php _e( 'Inscríbete', 'wpbmaker' ); ?></h2>
                            <p class="my-3"><?php _e( 'Lo sentimos ya no se admiten más inscripciones, pero nos gustaría contar contigo para la próxima edición de Odisea bMaker, así que visita de vez en cuando <a class="font-weight-bold" href="https://www.bmaker.es">www.bMaker.es</a> para enterarte de cuando será.', 'wpbmaker' ); ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="commitment-banner bg-primary text-center text-white pt-5">
                <div class="container">
                    <h2 class="font-weight-bold mb-3 mb-md-4 mb-lg-5"><?php _e( 'Compromiso bMaker', 'wpbmaker' ); ?></h2>
                    <ul class="d-flex flex-column flex-md-row justify-content-center list-unstyled text-size-1 p-3 m-0">
                        <li class="mb-4 px-md-3 px-lg-5">
                            <svg class="text-white" height="118px" width="118px" class="icon icon-icon-com-world"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-icon-com-world"></use></svg>
                            <p class="mt-4"><?php _e( 'Odisea bMaker es un concurso con el que desde Macmillan Education buscamos contribuir positivamente a los Objetivos de Desarrollo Sostenible (ODS), incrementando el nivel de desarrollo educativo en nuestra sociedad.', 'wpbmaker' ); ?></p>
                        </li>
                        <li class="mb-4 px-md-3 px-lg-5">
                            <svg class="text-white" height="118px" width="118px" class="icon icon-icon-com-friends"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-icon-com-friends"></use></svg>
                            <p class="mt-4"><?php _e( 'Mediante nuestro premio solidario a la fundación Balia queremos fomentar la igualdad de oportunidades acercando los conocimientos de las nuevas tecnologías a los sectores más vulnerables de nuestra sociedad.', 'wpbmaker' ); ?></p>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /section -->
</main>
<?php get_footer(); ?>
