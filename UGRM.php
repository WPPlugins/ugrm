<?php
/*
Plugin Name: UGRM - UFAD Groups to Roles Munger
Plugin URI: http://www.flmnh.ufl.edu/omt/omtforge
Description: Andy & Warren's University of Florida Shibboleth UFAD Groups Munger for Wordpress
Version: 1.6
Author: Warren Hypnotoad Brown
Author URI: http://www.flmnh.ufl.edu/omt/omtforge
License: GPL2
*/

require_once dirname(__FILE__) . '/options.php';

function UGRM_munge_UFAD_Groups2Roles($user_role) {
    if (isset($_SERVER['UFADGroupsDN']) || isset($_SERVER['HTTP_UFADGROUPSDN'])) {
        $UGRM_admin_role = get_option('UGRM_admin_role');
        $UGRM_editor_role = get_option('UGRM_editor_role');
        $UGRM_author_role = get_option('UGRM_author_role');
        $UGRM_contributor_role = get_option('UGRM_contributor_role');
        $UGRM_subscriber_role = get_option('UGRM_subscriber_role');
        //IIS prepends a HTTP_ prefix to all the Shibboleth server variables
        //because Shibboleth sends them through CGI as IIS does not
        //support envirnoment variables. See https://wiki.shibboleth.net/confluence/display/SHIB2/NativeSPAttributeAccess
        //for details. Thus we check for IIS.
        if (strpos($_SERVER['SERVER_SOFTWARE'], 'IIS')) {
            $UFADGroupsDN = $_SERVER['HTTP_UFADGROUPSDN']; 
        }        
        else {
            $UFADGroupsDN = $_SERVER['UFADGroupsDN'];    
        }
        if (strpos($UFADGroupsDN, $UGRM_admin_role)) {
            $user_role = "administrator";
        }
        elseif (strpos($UFADGroupsDN, $UGRM_editor_role)){
            $user_role = "editor";
        }
        elseif (strpos($UFADGroupsDN, $UGRM_author_role)) {
            $user_role = "author";
        }
        elseif (strpos($UFADGroupsDN, $UGRM_contributor_role)) {
            $user_role = "contributor";
        }
        elseif (strpos($UFADGroupsDN, $UGRM_subscriber_role)) {
            $user_role = "subscriber";
        }
        else {
            $user_role = "none";
        }
        return $user_role;
    }
}

add_filter ( 'shibboleth_user_role', 'UGRM_munge_UFAD_Groups2Roles' );

function UGRM_munge_return_target_to_HTTPS($initiator_url) {
    if(get_option('UGRM_return_target_to_HTTPS')=="checked") {
       if (!strpos($initiator_url,'target=https') ){
            $initiator_url=str_replace('target=http','target=https',$initiator_url);
       }
        return $initiator_url;
    }
    else {
        return $initiator_url;
    }
}

add_filter ('shibboleth_session_initiator_url', 'UGRM_munge_return_target_to_HTTPS');

/*  Copyright 2011 Warren Brown/University of Florida  (warrenbrown@ufl.edu)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
            
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/                          
?>
