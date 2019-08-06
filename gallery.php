<?php
include_once ( "header.php" );
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/gallery.css"/>
        <link rel="stylesheet" type="text/css" href="css/menu_arrow.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="search_bar">
                <p>Camagru's Hall of Fame</p>
            <div class="search-container">
                <form>
                    <input type="text" placeholder="Search.." name="search" autocomplete="off">
                    <button type="button"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="gallery_wrapper">
            <div class="side_pannel">
                <h2>Gallery<div class="arrow-down"></div></h2>
                <div class="main_title_wrapper">
                    <div class="arrow-right"></div>
                    <p>All Photos</p>
                    <div class="content">
                        <button type="button">Everything (0)</button>
                        <button type="button">Most Recent (0)</button>
                        <button type="button">Most Viewed (0)</button>
                        <button type="button">Most Liked (0)</button>
                    </div>
                </div>
                <div class="main_title_wrapper">
                    <div class="arrow-right"></div>
                    <p>Group Albums</p>
                    <div class="content">
                        <button type="button">Friend 1, Friend 2, You (0)</button>
                        <button type="button">Friend 3, You (0)</button>
                        <button type="button">Shared (0)</button>
                    </div>
                </div>
                <div class="main_title_wrapper">
                    <div class="arrow-right"></div>
                    <p>Albums</p>
                    <div class="content">
                        <button type="button">Public (0)</button>
                        <button type="button">Private (0)</button>
                    </div>
                </div>
                <div class="main_title_wrapper">
                    <div class="arrow-right"></div>
                    <p>Other Sites</p>
                    <div class="content">
                        <button type="button">Facebook (0)</button>
                        <button type="button">Twitter (0)</button>
                        <button type="button">Instagram (0)</button>
                        <button type="button">Picasa (0)</button>
                    </div>
                </div>
            </div>
            <div class="main_view">
                <div class="sorting_tab">
                    <div class="mosaic_buttons">
                        <button id="mosaic_1"></button>
                        <button id="mosaic_6"></button>
                    </div>
                </div>
                <div class="photos">
                </div>
            </div>
        </div>
    </body>
</html>