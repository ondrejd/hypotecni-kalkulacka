<?php
/**
 * Simple routing script for PHP built-in server.
 *
 * Usage:
 *
 *   php -S "localhost:8000" "router.php"
 *
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 */

$uri = filter_input( INPUT_SERVER, 'REQUEST_URI' );

if ( empty( $uri ) ) {
    echo 'Can not read request URI.\n';
    exit( 1 );
}

if ( preg_match( '/\.(?:css|gif|ico|jpg|jpeg|png|svg|webp)$/', $uri, $ext ) ) {
    $path = 'public' . $_SERVER['REQUEST_URI'];

    header( 'Cache-Control: no-cache, must-revalidate' );
    header( 'Expires: Sat, 26 Jul 1997 05:00:00 GMT' );

    if ( file_exists( $path ) ) {
        $mime_type = '';

        switch ( $ext[0] ) {
            case '.css'  : $mime_type = 'text/css'; break;
            case '.gif'  : $mime_type = 'image/gif'; break;
            case '.ico'  : $mime_type = 'image/vnd.microsoft.icon'; break;
            case '.jpeg' :
            case '.jpg'  : $mime_type = 'image/jpeg'; break;
            case '.js'   : $mime_type = 'text/javascript'; break;
            case '.png'  : $mime_type = 'image/png'; break;
            case '.svg'  : $mime_type = 'image/svg+xml'; break;
            case '.webp' : $mime_type = 'image/webp'; break;
        }

        header( 'Content-Type: ' . $mime_type );
        readfile( $path );
    }
    else {
        $protocol = filter_input( INPUT_SERVER, 'SERVER_PROTOCOL' );

        if ( empty( $protocol ) ) {
            header( 'HTTP/1.1 404 Not Found' ); 
        } else {
            header( $protocol . ' 404 Not Found' );
        }

        echo 'File not found.' . PHP_EOL;
    }
} else {
    chdir( 'public' );
    include( 'index.php' );
}