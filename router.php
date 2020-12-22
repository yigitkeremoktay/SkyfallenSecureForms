<?php
/***********************************************************************************/
/*                          (C) 2020 - Skyfallen                                   */
/*                    Skyfallen Secure Forms Developed by                          */
/*                          The Skyfallen Company                                  */
/*                                                                                 */
/*                         File Since: SFR-301009                                  */
/*         This file is handles all url requests and redirects them.               */
/***********************************************************************************/

// Check if our ABSPATH is defined
defined("SSF_ABSPATH") or die("Don't mess!");

// Name our session
session_name("SecureFormSession");

// Start our session
session_start();

// Check if we are logged in
if(isset($_SESSION["loggedin"]) && isset($_SESSION["username"])){

    // We are logged in.
    define("ISLOGGEDIN",true);

    // Define user data as constants.
    define("USERNAME",$_SESSION["username"]);

    // Fetch the current user
    $currentUser = new SSFUser(USERNAME);

} else {

    // We are not logged in.
    define("ISLOGGEDIN",false);
}

// Start routing all urls

// Redirects for the login page
include_once SSF_ABSPATH."/views/login.php";
SSF_Router::routePage("/","redirect_to_login");
SSF_Router::routePage("accounts/login","render_login");
//SSF_Router::routePage("accounts/logout","do_logout");

// Redirects for the user's panel
include_once SSF_ABSPATH."/views/userpage.php";
SSF_Router::routePage("accounts/dashboard","render_dashboard",true,"redirect_to_login");
SSF_Router::routePage("accounts/dashboard/newform","render_page_new_form",true,"redirect_to_login");

// If nothing was routed, display 404
if(!defined("ROUTED")){

    // Include the 404 Page.
    include_once SSF_ABSPATH."/SSF_Includes/404.php";

}
