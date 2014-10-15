<?php

require 'instagram.class.php';

$instagram = new Instagram(array(
  'apiKey'      => '50d0ab16244448bc8700a65a4ee3c217',
  'apiSecret'   => '559002290c9c40d69dc1453c8bc54aef',
  'apiCallback' => 'http://www.ridleymusictutorials.com/instagram/index.php'
));

$token = '18905692.50d0ab1.0468207d0e09487ea474d91010188391';
$instagram->setAccessToken($token);

$id = '365861296076878174_31963707'; 
$result = $instagram->likeMedia($id);

if ($result->meta->code === 200) {
  echo 'Success! The image was added to your likes.';
} else {
  echo 'Something went wrong :(';
}

?>