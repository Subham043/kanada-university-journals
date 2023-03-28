<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// BotDetect PHP Captcha configuration options
// more details here: https://captcha.com/doc/php/captcha-options.html
// ----------------------------------------------------------------------------
$config = array(
    // Captcha configuration for contact page
    'Captcha' => array(
      'UserInputID' => 'cap',
      'CodeLength' => CaptchaRandomization::GetRandomCodeLength(4, 6),
      'ImageStyle' => ImageStyle::MeltingHeat,
      'ImageWidth' =>300,
      'ImageHeight'=>60,
      'ImageColorMode'=>ImageColorMode::Color,
      'CustomDarkColor'=>'DarkGreen',
    ),
  );