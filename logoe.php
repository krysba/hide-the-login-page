<?php 
//way one
// function way_one_wp_login_filter($url, $path, $orig_scheme) {
// $old = array("/(wp-login\.php)/");
// $new = array("new-login");
// return preg_replace($old, $new, $url, 1);
// }
// add_filter('site_url','way_one_wp_login_filter', 10, 3);

// function way_one_wp_login_redirect() {
//     if (strpos( $_SERVER["REQUEST_URI"], 'new-login') === false ){
//         wp_redirect(site_url() );
//         exit();
//     }

// }
// add_action( 'login_init', 'way_one_wp_login_redirec');


//way two
function zmiana_strony_logowania() {
    $new_login = 'sandbox';
    if (strpos( $_SERVER['REQUEST_URI'], $new_login) === false ) 
    {
               wp_safe_redirect( home_url('NonExistentPage'), 302 );
               exit();
}

}
add_action('login_head','zmiana_strony_logowania');

function aktualna_strona_logowania() {
    $new_login = 'sandbox';
    if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY)==$new_login&& ($_GET['redirect'] !== false)) {
        wp_safe_redirect(home_url("wp-login.php?new_login&redirect=false"));
        exit();
    }
}
add_action('init','aktualna_strona_logowania');

?>