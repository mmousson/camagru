<?php
include_once ( "header.php" );
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/menu_arrow.css"/>
        <link rel="stylesheet" type="text/css" href="/css/gallery.css"/>
        <link rel="stylesheet" type="text/css" href="/css/gallery_grid.css"/>
        <link rel="stylesheet" type="text/css" href="/css/gallery_overlay.css"/>
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
                        <button type="button" onclick="document.location.href='/gallery.php?filter=all'">Everything</button>
                        <button type="button" onclick="document.location.href='/gallery.php?filter=recent'">Most Recent</button>
                        <button type="button" onclick="document.location.href='/gallery.php?filter=ancient'">Most Ancient</button>
                        <button type="button" onclick="document.location.href='/gallery.php?filter=liked'">Most Liked</button>
                    </div>
                </div>
                <div class="main_title_wrapper">
                    <div class="arrow-right"></div>
                    <p>Albums</p>
                    <div class="content">
                        <button type="button" onclick="document.location.href='/gallery.php?filter=public'">Public (0)</button>
                        <button type="button" onclick="document.location.href='/gallery.php?filter=private'">Private (0)</button>
                    </div>
                </div>
                <div class="main_title_wrapper">
                    <div class="arrow-right"></div>
                    <p>Other Sites</p>
                    <div class="content">
                        <button type="button">Facebook</button>
                        <button type="button">Twitter</button>
                        <button type="button">Instagram</button>
                        <button type="button">Picasa</button>
                    </div>
                </div>
            </div>
            <div class="main_view">
                <div class="sorting_tab">
                    <div class="mosaic_buttons">
						<input id="18" class="mosaic_btn" type="image" src="/images/UI/mosaic_18_normal.png"/>
                        <input id="6" class="mosaic_btn" type="image" src="/images/UI/mosaic_6_pressed.png"/>
						<input id="1" class="mosaic_btn" type="image" src="/images/UI/mosaic_1_normal.png"/>
                    </div>
                </div>
                <div class="photos_grid">
                    <?php
                        include_once ( "scripts/gallery_generate.php" );
                    ?>
                </div>
            </div>
        </div>
        <div class="overlay">
            <div class="wrapper">
                <div class="overlay_image">
                    <div class="infos_display_wrapper">
                        <div class="infos_display">
                            <div class="relative_pos">
                                <p id="author_label">Posted by: root</p>
                                <input id="like_btn" type="image" src="/images/UI/like_icon.png" onclick="upvote(+1)"/>
								<input id="dislike_btn" type="image" src="/images/UI/dislike_icon.png" onclick="upvote(-1)"/>
								<button id="delete_post">DELETE THIS POST</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="comments_zone">
                    <div class="comments_wrapper">

                    </div>

                    <div class="input_comment">
                        <textarea id="comment_textarea" name="" placeholder="Enter your comment here..." maxlength="300"></textarea>
                        <button id="comment_button" type="button">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    </body>
	<script type="text/javascript" src="/js/gallery.js"></script>
</html>