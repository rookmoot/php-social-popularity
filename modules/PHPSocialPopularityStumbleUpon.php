<?php

class PHPSocialPopularityStumbleUpon implements iPHPSocialPopularityModule {

  const FETCH_URL = 'http://www.stumbleupon.com/services/1.01/badge.getinfo?url=';

  public function fetch(PHPSocialPopularity $psp, $url) {
    $ret = array();
    $result = json_decode($psp->get(self::FETCH_URL.urlencode($url)));
    $ret['total'] = $result->result->views ? $result->result->views : 0;
    return $ret;
  }

}