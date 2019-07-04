<?php
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
$https = !empty($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') === 0 ||
            !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
                strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') === 0;
        $upload_url = ($https ? 'https://' : 'http://').
            (!empty($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'].'@' : '').
            (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ($_SERVER['SERVER_NAME'].
            ($https && $_SERVER['SERVER_PORT'] === 443 ||
            $_SERVER['SERVER_PORT'] === 80 ? '' : ':'.$_SERVER['SERVER_PORT'])));
        
$upload_dir= $_SERVER['DOCUMENT_ROOT'];
//        echo $upload_dir;die();
$options = [
    'upload_dir'=>$upload_dir.'/uploads/bookings/'.$_GET['booking_id'].'/',
    'upload_url'=>$upload_url.'/uploads/bookings/'.$_GET['booking_id'].'/',
    'accept_file_types'=>'/\.(docx|pdf|gif|jpe?g|png|csv|doc|dot|wbk|docm|dotx|dotm|docb|xlsx|xlsm|xltx|xltm|xls|xlt|xlm)$/i',
    'booking_id'=>$_GET['booking_id'],
    'delete_type' => 'POST'
];
$upload_handler = new UploadHandler($options);
