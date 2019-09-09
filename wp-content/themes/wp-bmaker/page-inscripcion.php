<?php /* Template Name: Full Page Template */ get_header('fullpage');  ?>
<!-- Full Page Template for no sidebar  -->
<?php acf_form_head(); ?>
<?php get_header('fullpage'); ?>
<main>
    <div class="container">
        <div class="user-forms-container m-auto">
                <?php
                global $wpdb, $user_ID;
                $action  = (isset($_GET['action']) ) ? $_GET['action'] : 0;
                    // Default page shows register form.
                    // To show Login form set query variable action=login

                    // Login Page
                    if ($action === "login") {
                        $errorMessage ='';

                        //Check whether the user is already logged in
                        if (!$user_ID) { ?>

                            <?php
                            $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

                            if ( $login === "failed" ) {
                                $errorMessage = '<div class="col-12 register-error text-danger text-size-1 mb-4">Correo electrónico y/o contraseña incorrectos.</div>';
                            } elseif ( $login === "empty" ) {
//                                $errorMessage = '<div class="col-12 register-error text-danger text-size-1 mb-4">Correo electrónico y/o contraseña vacíos.</div>';
                            } elseif ( $login === "false" ) {
                                $errorMessage = '<div class="col-12 register-error text-danger text-size-1 mb-4">No estas autenticado en la plataforma.</div>';
                            }
                            ?>

                            <div class="manual-login-form bg-white rounded m-auto">
                                <?php echo $errorMessage; ?>
                                <?php
                                $args = array(
                                    'redirect' => admin_url('index.php?page=custom-dashboard'),
                                    'form_id' => 'loginform',
                                    'label_username' => __( 'Correo electrónico' ),
                                    'label_password' => __( 'Contraseña' ),
                                    'label_log_in' => __( 'Log In' ),
                                    'id_username' => 'user_login',
                                    'id_password' => 'user_pass',
                                    'id_submit' => 'wp-submit',
                                    'remember' => false,
                                    'value_username' => NULL
                                );
                                wp_login_form( $args ); ?>
                                <a class="btn btn-primary w-100 mt-1 py-2" href="<?php echo wp_registration_url(); ?>"><span class="font-weight-bold">Inscríbete</span></a>
                                <a class="text-right font-weight-bold w-100 lost-password" href="<?php echo wp_lostpassword_url( ); ?>" title="Recordar contraseña">¿Has olvidado tus datos?</a>
                            </div>


                        <?php  } else {
                           //wp_redirect( admin_url( '/post-new.php?post_type=page' ), 301 );
                            ?>

                            <p class="text-center py-5 my-5 text-size-4">Ya estás autenticado en la plataforma <a href="<?php echo admin_url( '' ) ?>">Entrar</a></p>
                        <?php } ?>

                <?php  } else { // Register Page ?>
                    <?php
                    if ( $error != 2 ) { ?>

                        <?php if (get_option('users_can_register')) { ?>

                                <?php
                                $showSuccessRegisterMessage = false;
                                $errorMessages = '';
                                $first_name = ( ! empty($_POST['first_name'] ) ) ? trim( $_POST['first_name'] ) : '';
                                $last_name = ( ! empty( $_POST['last_name'] ) ) ? trim( $_POST['last_name'] ) : '';

                                if ( $_POST ) {

                                    $centerName = ( ! empty( trim($_POST['acf']['field_5d6e2dc6acea4'] )) ) ? trim( $_POST['acf']['field_5d6e2dc6acea4'] ) : '';
                                    $centerAddress = ( ! empty( trim($_POST['acf']['field_5d6e2de6acea5'] )) ) ? trim( $_POST['acf']['field_5d6e2de6acea5'] ) : '';
                                    $teams = $_POST['acf']['field_5d6e2cb2ace9b'];
                                    $terms = ( !$_POST['acf']['field_5d6e33837d5ce'] ) ? true : false;

                                    $error = 0;

                                    $username = esc_sql($_REQUEST['username']);
                                    if ( empty($username) ) {
                                        $errorMessages .= '<div class="text-left text-danger mt-1 text-size-1">El username no puede estar vacío.</div>';
                                        $error = 1;
                                    }
                                    if ( empty($first_name) ) {
                                        $errorMessages .= '<div class="text-left text-danger mt-1 text-size-1">El nombre no puede estar vacío.</div>';
                                        $error = 1;
                                    }
                                    if ( empty($last_name) ) {
                                        $errorMessages .= '<div class="text-left text-danger mt-1 text-size-1">Los apellidos no pueden estar vacío.</div>';
                                        $error = 1;
                                    }

                                    if(empty(trim($teams[0]['field_5d6e2ce8ace9c']))) {
                                        $errorMessages .= '<div class="text-left text-danger mt-1 text-size-1">El nombre del equipo no puede estar vacío.</div>';
                                        $error = 1;
                                    }

                                    if(empty(array_filter($teams[0]['field_5d6e2cfaace9d'])) ) {
                                        $errorMessages .= '<div class="text-left text-danger mt-1 text-size-1">Al menos debe haber un alumno por equipo.</div>';
                                        $error = 1;
                                    }

                                    if ( empty($centerName) ) {
                                        $errorMessages .= '<div class="text-left text-danger mt-1 text-size-1">El nombre del centro no puede estar vacío.</div>';
                                        $error = 1;
                                    }

                                    if ( empty($centerAddress) ) {
                                        $errorMessages .= '<div class="text-left text-danger mt-1 text-size-1">La dirección del centro no puede estar vacía.</div>';
                                        $error = 1;
                                    }

                                    if ( $terms ) {
                                        $errorMessages .= '<div class="text-left text-danger mt-1 text-size-1">Debes aceptar las condiciones de privacidad.</div>';
                                        $error = 1;
                                    }


//                                    print_r($errorMessages);
//                                    print_r($_POST);
//
//                                    die();

                                    $email = esc_sql($_REQUEST['email']);

                                    if ( $error == 0 ) {

                                        $random_password = wp_generate_password( 12, false );

                                        //register user
                                        $user_id = wp_create_user( $username, $random_password, $email );

                                        //update other user info
                                        wp_update_user( array(
                                            'ID' => $user_id,
                                            'first_name'  => $_POST['first_name'],
                                            'last_name'  => $_POST['last_name'],
                                            'field_5d6e2dc6acea4'  => $_POST['acf']['field_5d6e2dc6acea4'] , // El nombre del centro
                                            'field_5d6e2de6acea5'  => $_POST['acf']['field_5d6e2de6acea5'] , // Direccion del centro
                                            'field_5d6e33837d5ce'  => $_POST['acf']['field_5d6e33837d5ce'] , // Aceptar condiciones de privacidad
                                        ));


                                        if ( is_wp_error($user_id) ) {

                                            $errorMessages .= '<div class="text-left text-danger mt-4">El username y/o el email ya existen, prueba con otro.</div>';
                                        } else {

                                            $from     = get_option('admin_email');
                                            $headers   = 'From: '.$from . "\r\n";
                                            $subject   = "Te has registrado en ODISEA bMaker";
                                            $message   = "";
                                            $message   = '<table bgcolor="#4e4d4d" cellspacing="0" cellpadding="0" width="100%">
                                                            <tr valign="top" align="center">
                                                                <td valign="top" align="center" style="padding-bottom: 50px;">
                                                                    <table bgcolor="#ffffff" cellspacing="0" cellpadding="0" width="100%" style="border-radius:4px; max-width:700px; padding:20px 0 20px 0; margin:70px auto 0;font-family:\'Open Sans\',\'Arial\',sans-serif; font-weight:300; color:#333333">
                                                                        <!-- Content footer -->
                                                                        <tr style="margin-bottom: 0; margin-top: 0; padding-bottom: 0; padding-top: 35px; padding-bottom: 35px">
                                                                            <td align="center">
                                                                                <p style="margin-top: 0; margin-bottom: 10px; padding-top: 0; padding-bottom: 0;">
                                                                                    <a href='.home_url().'" target="_blank">
                                                                                        <img height="60" width="257" style="width: 257px; height: 60px; color: #57b5c9; font-weight: bold; object-fit: none; object-position: 0 -30px;" src="'.home_url().'/wp-content/themes/wp-bmaker/img/odisea-bMaker-logo@3x.png" alt="ODISEA bMaker" />
                                                                                    </a>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Content footer -->
                                                                        <!-- Content mail -->
                                                                        <tr style="margin-bottom: 0; margin-top: 0; padding-bottom: 0; padding-top: 0;">
                                                                            <!-- Header -->
                                                                            <td class="margins-mobile" align="left" style="padding-right: 50px; padding-left: 50px; padding-top: 40px;">
                                                                                <p style="color: #4e4d4d; font-size: 16px; margin-top: 0; margin-bottom: 15px; text-align: center; font-size: 20px; font-weight: bold;">¡BIENVENIDO A LA ODISEA bMaker!</p>
                                                                                <p style="color: #4e4d4d; font-size: 16px; margin-top: 0; margin-bottom: 15px;">¡Gracias por inscribirte en nuestro concurso!</p>
                                                                                <p style="color: #4e4d4d; font-size: 16px; margin-top: 0; margin-bottom: 15px;">En breve recibirás la confirmación de registro y las instrucciones del concurso. Desde ese momento ya podrás acceder a la página web iniciando sesión con tu usuario y contraseña.</p>
                                                                                <p style="color: #4e4d4d; font-size: 16px; margin-top: 0; margin-bottom: 15px;">Cualquier duda o información adicional, contáctanos: <strong>concursobMaker@macmillaneducation.com</strong></p>
                                                                                <p style="color: #4e4d4d; font-size: 16px; margin-top: 0; margin-bottom: 15px;">¡PREPÁRAOS PARA EL VIAJE!</p>
                                                                                
                                                                            </td>
                                                                            <!-- /Header -->
                                                                        </tr>
                                                        
                                                                        <!-- / Content mail -->
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top" align="center">
                                                                <td valign="top" align="center" style="padding-bottom: 10px;">
                                                                    <table bgcolor="#4e4d4d" cellspacing="0" cellpadding="0" width="100%" style="border-radius:4px; max-width:700px; padding:20px 0 20px 0; margin:0px auto 0;font-family:\'Open Sans\',\'Arial\',sans-serif; font-weight:300; color:#333333">
                                                                        <!-- Content footer -->
                                                                        <tr style="margin-bottom: 0; margin-top: 0; padding-bottom: 0; padding-top: 35px; padding-bottom: 35px">
                                                                            <td align="center">
                                                                                <p style="margin-top: 0; margin-bottom: 10px; padding-top: 0; padding-bottom: 0;">
                                                                                    <a href="https://www.bq.com/es/" target="_blank">
                                                                                        <img height="60" width="257" style="width: 257px; height: 60px; color: #57b5c9; font-weight: bold; object-fit: none; object-position: 0 -30px;" src="'.home_url().'/wp-content/themes/wp-bmaker/img/bq-logo.png" alt="BQ" />
                                                                                    </a>
                                                                                </p>
                                                                            </td>
                                                                             <td align="center">
                                                                                <p style="margin-top: 0; margin-bottom: 10px; padding-top: 0; padding-bottom: 0;">
                                                                                    <a href="https://www.macmillaneducationeverywhere.com/es/" target="_blank">
                                                                                        <img height="60" width="257" style="width: 257px; height: 60px; color: #57b5c9; font-weight: bold; object-fit: none; object-position: 0 -30px;" src="'.home_url().'/wp-content/themes/wp-bmaker/img/macmillan-logo.png" alt="Macmillan" />
                                                                                    </a>
                                                                                </p>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Content footer -->
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr valign="top" align="center">
                                                                <td valign="top" align="center" style="padding-bottom: 50px;">
                                                                    <table bgcolor="#4e4d4d" cellspacing="0" cellpadding="0" width="100%" style="border-radius:4px; max-width:700px; padding:20px 0 20px 0; margin:10px auto 0;font-family:\'Open Sans\',\'Arial\',sans-serif; font-weight:300; color:#333333">
                                                                        <!-- Content footer -->
                                                                        <tr style="margin-bottom: 0; margin-top: 0; padding-bottom: 0; padding-top: 35px; padding-bottom: 35px">
                                                                            <td align="center">
                                                                                <a style="color: #fff; text-decoration: none;" href="'.home_url().'" target="_blank">Contacto</a>
                                                                            </td>
                                                                             <td align="center">
                                                                                <a style="color: #fff; text-decoration: none;" href="'.home_url().'/politica-privacidad" target="_blank">Política de privacidad</a>
                                                                            </td>
                                                                            <td align="center">
                                                                                <a style="color: #fff; text-decoration: none;" href="'.home_url().'/politica-de-cookies" target="_blank">Política de cookies</a>
                                                                            </td>
                                                                            <td align="center">
                                                                                <a style="color: #fff; text-decoration: none;" href="'.home_url().'/bases-del-concurso" target="_blank">Condiciones de participación</a>
                                                                            </td>
                                                                            <td align="center">
                                                                                <a style="color: #fff; text-decoration: none;" href="'.home_url().'" target="_blank">FAQ\'s</a>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- /Content footer -->
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>';

                                            // Email password and other details to the user
                                            wp_mail( $email, $subject, $message, $headers );
                                            $showSuccessRegisterMessage = true;

                                            $error = 2; // We will check for this variable before showing the sign up form.
                                        }
                                    }

                                }

                                if(!$showSuccessRegisterMessage) { ?>

                                <div class="manual-register-form pt-3 bg-white rounded px-0 m-auto">

                                    <h1 class="px-4 px-md-5 pt-2 pb-4 py-md-4 border-bottom font-weight-bold">Formulario de inscripción</h1>
                                    <div class="col-12 px-4 px-md-5 pt-4">
                                        <?php echo $errorMessages; ?>
                                    </div>
                                    <form action="" method="post">
                                        <div class="fields-wrapper row">
                                            <div class="form-group col-12 col-md-6">
                                                <label class="font-weight-bold" for="first_name"><?php _e( 'Nombre', 'wpbmaker' ) ?></label>
                                                <input type="text" name="first_name" id="first_name" class="form-control" required placeholder="<?php _e( 'Nombre del profesor/a responsable', 'wpbmaker' ) ?>" value="<?php echo esc_attr( wp_unslash( $first_name ) ); ?>" size="25" /></label>
                                            </div>
                                            <div class="form-group col-12 col-md-6">
                                                <label class="font-weight-bold" for="last_name"><?php _e( 'Apellidos', 'wpbmaker' ) ?></label>
                                                <input type="text" name="last_name" id="last_name" class="form-control" required placeholder="<?php _e( 'Apellidos del profesor/a responsable', 'wpbmaker' ) ?>" value="<?php echo esc_attr( wp_unslash( $last_name ) ); ?>" size="25" /></label>
                                            </div>
                                            <div class="form-group col-12">
                                                <label class="font-weight-bold" for="exampleInputEmail1"><?php _e( 'Username ' ); ?></label>
                                                <input type="text" class="form-control" name="username" placeholder="Username" required placeholder="<?php _e( 'Nombre de usuario', 'wpbmaker' ); ?>" value="<?php if( ! empty($username) ) echo $username; ?>" />
                                                <small class="form-text text-muted text-size-0 font-italic"><?php _e( 'Podrás usarlo en el login de la plataforma'); ?></small>
                                            </div>
                                            <div class="form-group col-12">
                                                <label class="font-weight-bold" for="user_email"><?php _e( 'Correo electrónico del profesor', 'wpbmaker' ); ?></label>
                                                <input type="text" name="email"  class="form-control" required placeholder="<?php _e( 'Correo electrónico de contacto', 'wpbmaker' ); ?>" value="<?php if( ! empty($email) ) echo $email; ?>" />
                                            </div>
                                            <?php
                                            /**
                                             * Fires following the 'Email' field in the user registration form.
                                             *
                                             * @since 2.1.0
                                             */
                                            do_action( 'register_form' );
                                         ?>
                                        </div>
                                        <div class="register-actions d-flex justify-content-between align-items-center border-top">
                                            <a href="<?php echo home_url(); ?>" class="btn btn-gray-400 border border-gray-500"><span class="font-weight-bold text-gray-600">Cancelar</span></a>
                                            <button type="submit" id="register-submit-btn" class="btn btn-primary" name="submit"><span class="font-weight-bold">Enviar inscripción</span></button>
                                        </div>
                                    </form>

                                </div>
                            <?php } else { ?>
                                <div class="success-register-wrapper text-center bg-white rounded mx-auto p-4 p-md-5 mt-4">
                                    <h1 class="text-size-10 font-weight-bold pb-4 text-size-10">¡Hecho!</h1>
                                    <p class="font-weight-bold">Hemos recibido su inscripción</p>
                                    <p class="mb-4">Nos pondremos en contacto con contigo en la mayor brevedad posible para darte tus credenciales.</p>
                                    <a href="<?php echo home_url(); ?>" class="btn btn-gray-400 w-100 border-gray-500"><span class="font-weight-bold text-gray-600">Volver a la web</span></a>
                                </div>
                            <?php } ?>

                        <?php } else { ?>

                            <div class="success-register-wrapper text-center bg-white rounded mx-auto p-4 p-md-5 mt-4">
                                <h1 class="text-size-10 font-weight-bold pb-4 text-size-10">Las inscripciones están cerradas</h1>
                                <p class="font-weight-bold">El plazo terminó el 15 de Noviembre incluido</p>
                                <p class="mb-4"></p>
                                <a href="<?php echo home_url(); ?>" class="btn btn-gray-400 w-100 border-gray-500"><span class="font-weight-bold text-gray-600">Volver a la web</span></a>
                            </div>

                        <?php }

                    } ?>

                <?php } ?>

                <!-- section -->

                <!-- /section -->
    </div><!-- /.container -->
    </div>
</main>
<?php get_footer('fullpage'); ?>


</html>