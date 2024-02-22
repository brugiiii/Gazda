<?php
$location = $args["location"] ?? "menu-header";

$args = array(
    "theme_location" => $location,
    "container" => "ul",
    "menu_class" => "nav-list",
);

wp_nav_menu($args);
?>