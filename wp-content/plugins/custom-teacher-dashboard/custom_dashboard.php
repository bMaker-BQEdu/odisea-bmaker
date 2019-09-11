<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="wrap">
<!--    <h1>--><?php //_e( 'Bienvenido al concurso de bMaker' ); ?><!--</h1>-->

    <div id="welcome-panel" class="steps-wrap">
        <div class="welcome-panel-content">
            <h2><?php _e( 'Hitos y video/s de la odisea' ); ?></h2>
            <table class="steps-lst" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>Hitos y vídeos</th>
                        <th>Fechas</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hito 1: ¿Ya tienes equipo? Educación inclusiva y aprendizaje cooperativo</td>
                        <td>09 al 15 de Diciembre</td>
                        <td>
                            <a class="button button-primary button-hero add-etapa01" href='./post-new.php?post_type=etapa01'>Editar</a>
<!--                            <a class="button button-link edit-etapa01" href='./edit.php?post_type=etapa01'>Ver hito 1</a>-->
                        </td>
                    </tr>
                    <tr>
                        <td>Hito 3: ¿Cuál es el problema de sostenibilidad que quieres solucionar? ¿Por qué poner soluciones al entorno?</td>
                        <td>17 al 23 de Febrero</td>
                        <td>
                            <a class="button button-primary button-hero add-etapa03" href='./post-new.php?post_type=etapa03'>Editar</a>
<!--                            <a class="button button-link edit-etapa03" href='./edit.php?post_type=etapa03'>Ver hito 2</a>-->
                        </td>
                    </tr>
                    <tr>
                        <td>Video/s del resultado final</td>
                        <td></td>
                        <td>
                            <a class="button button-primary button-hero add-etapaextra" href='./post-new.php?post_type=etapaextra'>Editar</a>
<!--                            <a class="button button-link edit-etapaextra" href='./edit.php?post_type=etapaextra'>Ver vídeo/s</a>-->
                        </td>
                    </tr>
                    <tr>
                        <td>Hito 5: Cuéntanos tu experiencia.</td>
                        <td>13 al 19 de Abril</td>
                        <td>
                            <a class="button button-primary button-hero add-etapa05" href='./post-new.php?post_type=etapa05'>Editar</a>
<!--                            <a class="button button-link edit-etapa05" href='./edit.php?post_type=etapa05'>Ver hito 5</a>-->
                        </td>
                    </tr>
                </tbody>

            </table>
<!--            <div class="welcome-panel-column-container">-->
<!--                <div class="welcome-panel-column">-->
<!--                    <h3>--><?php //_e( 'Primera etapa' ); ?><!--</h3>-->
<!--                    <p>--><?php //_e( 'Entrega en Octubre' ); ?><!--</p>-->
<!--                    <a class="button button-primary button-hero" href='./post-new.php?post_type=etapa01'>Añadir Etapa 1</a>-->
<!--                    <p><a class="button button-link" href='./edit.php?post_type=etapa01'>Ver Etapa 1</a></p>-->
<!--                </div>-->
<!--                <div class="welcome-panel-column">-->
<!--                    <h3>--><?php //_e( 'Segunda etapa' ); ?><!--</h3>-->
<!--                    <p>--><?php //_e( 'Entrega en Noviembre' ); ?><!--</p>-->
<!--                    <a class="button button-primary button-hero" href='./post-new.php?post_type=etapa02'>Añadir Etapa 2</a>-->
<!--                    <p><a class="button button-link" href='./edit.php?post_type=etapa02'>Ver Etapa 2</a></p>-->
<!--                </div>-->
<!--                <div class="welcome-panel-column welcome-panel-last">-->
<!--                    <h3>--><?php //_e( 'Tercera etapa' ); ?><!--</h3>-->
<!--                    <p>--><?php //_e( 'Entrega en Diciembre' ); ?><!--</p>-->
<!--                    <a class="button button-primary button-hero" href='./post-new.php?post_type=etapa02'>Añadir Etapa 3</a>-->
<!--                    <p><a class="button button-link" href='./edit.php?post_type=etapa03'>Ver Etapa 3</a></p>-->
<!--                </div>-->
<!--            </div>-->
        </div>
<!--        --><?php //_e('Esta aventura consta de tres etapas' ); ?>

<!--    <h2 class="nav-tab-wrapper">-->
<!--        <a href="#" class="nav-tab nav-tab-active">-->
<!--            --><?php //_e( 'Etapa 1' ); ?>
<!--        </a><a href="#" class="nav-tab">-->
<!--            --><?php //_e( 'Etapa 2' ); ?>
<!--        </a><a href="#" class="nav-tab">-->
<!--            --><?php //_e( 'Etapa 3' ); ?>
<!--        </a>-->
<!--    </h2>-->

    </div>
</div>

<?php //include( ABSPATH . 'wp-admin/admin-footer.php' );
