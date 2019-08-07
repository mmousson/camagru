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
						<input id="18" class="mosaic_btn" type="image" src="/images/UI/mosaic_18_normal.png"/>
                        <input id="6" class="mosaic_btn" type="image" src="/images/UI/mosaic_6_normal.png"/>
						<input id="1" class="mosaic_btn" type="image" src="/images/UI/mosaic_1_pressed.png"/>
                    </div>
                </div>
                <div class="photos_grid">
                    <div id="example" class="photo_wrapper mosaic_1">1</div>
                    <div class="photo_wrapper mosaic_1">2</div>
                    <div class="photo_wrapper mosaic_1">3</div>
                    <div class="photo_wrapper mosaic_1">4</div>
                    <div class="photo_wrapper mosaic_1">5</div>
                    <div class="photo_wrapper mosaic_1">6</div>
                    <div class="photo_wrapper mosaic_1">7</div>
                    <div class="photo_wrapper mosaic_1">8</div>
                    <div class="photo_wrapper mosaic_1">9</div>
                    <div class="photo_wrapper mosaic_1">10</div>
                    <div class="photo_wrapper mosaic_1">11</div>
                    <div class="photo_wrapper mosaic_1">12</div>
                    <div class="photo_wrapper mosaic_1">13</div>
                    <div class="photo_wrapper mosaic_1">14</div>
                    <div class="photo_wrapper mosaic_1">15</div>
                    <div class="photo_wrapper mosaic_1">16</div>
                    <div class="photo_wrapper mosaic_1">17</div>
                    <div class="photo_wrapper mosaic_1">18</div>
                </div>
            </div>
        </div>
        <div class="overlay">
            <div class="wrapper">
                <div class="overlay_image">

                </div>

                <div class="comments_zone">
                    <div class="comments_wrapper">

                        <?php
                            include ( "scripts/pdo_connect.php" );

                            $conn = pdo_connect( "__camagru_posts" );
                            if ( $conn !== NULL )
                            {
                                $query = $conn->prepare("SELECT author, message FROM comments WHERE image_id='4'");
                                $query->execute();

                                $results = $query->fetchAll();
                                if ( empty( $results ) )
                                    echo '<div id="no_comment_txt">BE THE FIRST TO COMMENT</div>';
                                foreach ( $results as $match )
                                {
                                    echo '<div class="comment">';
                                        echo '<div class="comment_avatar">';
                                            echo '<img src="/images/UI/avatar_icon.png"/>';
                                        echo '</div>';
                                        echo '<div class="comment_infos">';
                                            echo '<p class="comment_author">' . $match['author'] . '</p>';
                                            echo '<p class="comment_content">' . $match['message'] . '</p>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                $conn = NULL;
                            }
                        ?>
                    </div>

                    <div class="input_comment">
                        <textarea id="comment_textarea" name="" placeholder="Enter your comment here..." maxlength="300"></textarea>
                        <button type="button">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    </body>
	<script type="text/javascript" src="/js/gallery.js"></script>
</html>