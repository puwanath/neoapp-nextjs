<?php
// $user_agent = $_SERVER['HTTP_USER_AGENT'];

function img_webp($img){
  require 'common/vendor/autoload.php';

  $source = $img;
  $browser = getBrowser();
  $os = getOS();
  if($browser=='Safari' or ($browser=='Handheld Browser' and $os=='iPhone')){
    $destination = $source;
  }elseif(($os=='iPhone' or $os=='iPad') and $browser=='Handheld Browser'){
    $destination = $source;
  }elseif($os=='Unknown OS Platform' and $browser=='Unknown Browser'){
    $destination = $source;
  }else{
    $destination = $source . '.webp';
    if(file_exists($destination)==false){
      $options = [
        'fail' => 'original',
        // 'show-report' => true
        'serve-image' => [
            'headers' => [
                'cache-control' => true,
                'vary-accept' => true,
                // other headers can be toggled...
            ],
            'cache-control-header' => 'max-age=2',
        ],

        'convert' => [
            // all convert option can be entered here (ie "quality")
        ],
      ];
      $webp = new WebPConvert\WebPConvert;
      $webp->convert($source, $destination, $options);
    }
  }


  return $destination;
}


?>
