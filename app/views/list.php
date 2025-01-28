<!-- //Here we will create a table, our syntex will look like this! -->
<!-- The entire File (list.php) is a part gets rendered into the function called by the router -->
<!-- // PHP_URL_PATH tells parse_url() to return only the path component of the URL.
// The following is commented out because it is in the constructor in ListController for test issues.
// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); -->
<?php
if ($uri == "/list" || $uri == "/listfa") {
    include("components/listbuttons.php");
} else if ($uri == "/singleuser" || $uri == "/singleuserfa" || preg_match("#^/singleuserfawc/([0-9]+)$#", $uri)) {
    include("components/listbutton.php");
}
?>

