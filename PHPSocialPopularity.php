<?php

class PHPSocialPopularity {

  const USER_AGENT = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.93 Safari/537.36';

  private $_url = '';
  private $_timeout = 10;

  private $_modules = array(
    'facebook'     => 'PHPSocialPopularityFacebook',
    'twitter'      => 'PHPSocialPopularityTwitter',
    'google'       => 'PHPSocialPopularityGoogle',
    'pinterest'    => 'PHPSocialPopularityPinterest',
    'linkedin'     => 'PHPSocialPopularityLinkedIn',
    'viadeo'       => 'PHPSocialPopularityViadeo',
    'stumbleupon'  => 'PHPSocialPopularityStumbleUpon',
    'delicious'    => 'PHPSocialPopularityDelicious',
  );

  Public function __construct($url, $timeout=20) {
    $this->_url = $url;
    $this->_timeout = $timeout;

    foreach ($this->_modules as $name => $class) {
      require_once dirname(__FILE__).'/modules/'.$class.'.php';
    }

  }

  public function fetch() {
    $result = array();
    foreach ($this->_modules as $name => $class) {
      $module = new $class();
      $result[$name] = $module->fetch($this, $this->_url);
    }
    return $result;
  }
  

  public function get($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
    $result = curl_exec($ch);
    if (curl_error($ch)) {
      throw new Exception(curl_error($ch));
    }
    return $result;
  }

  public function post($url, $fields) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    $result = curl_exec($ch);
    if (curl_error($ch)) {
      throw new Exception(curl_error($ch));
    }
    curl_close($ch);
    return $result;
  }
}

interface iPHPSocialPopularityModule {
  public function fetch(PHPSocialPopularity $psp, $url);
}