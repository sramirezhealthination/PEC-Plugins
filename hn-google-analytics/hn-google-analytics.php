<?php
/*
Plugin Name: Custom Google Analytics Plugin
Plugin URI: http://Healthination.com
Description: Add the Google Analytics tracking code.
Author: Santiago Ramirez - John Potter
Version: 1.0
*/

 function hn_google_analytics() { ?>

<!-- Google Analytics PART A <script async src="https://www.googletagmanager.com/gtag/js?id=UA-776939-21"></script>-->

  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-776939-21');
  </script>

  <script>
<?php

// dimension1 & dimension5  => userGuidValue & pageviewSource
if ($_COOKIE['userGUID']) {
  $userGuidValue = $_COOKIE['userGUID'];

  $pageviewSource = "existing cookie initial pageview";

}else{
  $userGuidValue = guidv4(openssl_random_pseudo_bytes(16));
    setcookie('userGUID',$GUIDvalue,time() + (86400 * 365)); // 86400 = 1 day

  $pageviewSource = "new cookie initial pageview";
}

// dimension2 & dimension3 & dimension4 => pageName & pageTitle & videoId
$video_playlist_id = get_field( 'video_playlist_id' );

  //Category
  if(is_archive()){
      $pageTitle  = get_the_archive_title();
      $video_id='000';

        $category   = single_cat_title("", false);
      $pageName   = "hn.".$category.".category.index";

  }

  //Home
  if (is_home()) {
    $pageName  = "hn.Home.home.index";
    $pageTitle =  'Home';
    $video_id='000';
  }

  //catches all "single" views, like a page, an attachment, a post, etc.
  if(is_singular()){
    $pageTitle =  get_the_title();

      $article_id = get_the_ID();
      $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $category = $categories[0]->name ;
        }else { $category ="default"; }

    $pageName  = "hn.".$category.".video.".$article_id.".".$video_playlist_id.".none";

      $video = get_post_meta( get_the_ID(), '_jwppp-video-url-1', true );
      if ( ! empty( $video ) ) {
    $video_id = $video;
      }else {
    $video_id='000';
        }
  }

//covers search result pages
if (is_search()) {
  $pageName  = "hn.Search.index.index";
  $pageTitle =  'Search';
  $video_id='000';
}
//catches everything ... that wasn't catched
if (is_404()) {
  $pageName  = "hn.404.index.index";
  $pageTitle =  'Eror';
  $video_id='000';
}

//Dimention 7 Domain
$domain = get_site_url();

/* -------------------PRINT------------------------------ */


        echo "var userGuidValue = '".$userGuidValue."';\n";
        echo "var pageName = '".$pageName."';\n";
        echo "var pageTitle = '".$pageTitle."';\n";
        echo "var videoId = '".$video_id."';\n";
        echo "var pageviewSource = '".$pageviewSource."';\n";
        echo "var videoTitle = '".$videoTitle."';\n";
        echo "var domain = '".$domain."';\n";


?>
</script>

<?php
/* dimension6 HN Video Title */
/* dimension7 Domain */


  echo "<!-- Google Analytics -->
        <script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
        ga('create', 'UA-776939-21', 'auto');
        ga('require', 'displayfeatures');
        ga('require', 'linkid');
        ga('set', 'dimension1', userGuidValue);
        ga('set', 'dimension2', pageName);
        ga('set', 'dimension3', pageTitle);
        ga('set', 'dimension4', videoId);
        ga('set', 'dimension5', pageviewSource);
        ga('set', 'dimension6', videoTitle);
        ga('set', 'dimension7', domain);
        ga('send', 'pageview');
        </script>
        <script async src='https://www.google-analytics.com/analytics.js'></script>
        <!-- End Google Analytics -->";
        ?>
  <?php
  }

add_action( 'wp_head', 'hn_google_analytics', 10 );
// load Google Analytics

// user GUID for GA
//taken from https://stackoverflow.com/questions/2040240/php-function-to-generate-v4-uuid
// removed dashes from hex to replicate python library ised on Healthination
function guidv4($data)
{
   assert(strlen($data) == 16);

   $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
   $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

   return vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
}



// * Add additional JW Player Events in Google Analytics */

function jwplayer_scripts_method() {
  wp_enqueue_script( 'jwp_script', plugins_url( '/js/jwplayer-GA.js' , __FILE__ ),'', '1.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'jwplayer_scripts_method' );
