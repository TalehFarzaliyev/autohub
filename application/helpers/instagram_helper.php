<?php

function instagram_api_curl_connect( $api_url )

{

  $connection_c = curl_init();

  curl_setopt( $connection_c, CURLOPT_URL, $api_url );

  curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 );

  curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );

  $json_return = curl_exec( $connection_c );

  curl_close( $connection_c );

  return json_decode( $json_return );

}





function instagram_widget()

{

  $access_token = '974552648.1677ed0.17976719207f453781e25ffbf0051f17';



  $user_id = 974552648; // or use string 'self' to get your own media

  $return = instagram_api_curl_connect("https://api.instagram.com/v1/users/" . $user_id . "/media/recent?access_token=" . $access_token);


  if(!isset($return->error_type))
  {
    $result = '<div class="row">';

    $i = 0;

    foreach ($return->data as $post) {

      if($post->type == 'image')

      {

        $result .= '<div class="col-md-3 no-padding "><a class="instagram" href="'.$post->link.'" target="blank"><img class="img-responsive" src="' . $post->images->thumbnail->url . '" /></a></div>';

        $i++;

      }

      if($i == 8)

      {

        break;

      }

    }

    $result .= '</div>';

    return $result;
  }
  else
  {
    return '';
  }
  

}



?>