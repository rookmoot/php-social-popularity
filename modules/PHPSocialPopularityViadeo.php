<?php

class PHPSocialPopularityViadeo implements iPHPSocialPopularityModule {

  const FETCH_URL = 'https://api.viadeo.com/recommend?format=json&url=';

  public function fetch(PHPSocialPopularity $psp, $url) {
    $ret = array();
    $result = json_decode($psp->get(self::FETCH_URL.''.urlencode($url)));
    $ret['total'] = $result->count ? $result->count : 0;
    return $ret;
  }

}