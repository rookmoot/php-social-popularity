<?php

class PHPSocialPopularityPinterest implements iPHPSocialPopularityModule {

  const FETCH_URL = 'http://api.pinterest.com/v1/urls/count.json?url=';

  public function fetch(PHPSocialPopularity $psp, $url) {
    $ret = array();
    $result = json_decode(preg_replace('/^receiveCount\((.*)\)$/', "\\1", $psp->get(self::FETCH_URL.urlencode($url))));
    $ret['total'] = $result->count;
    return $ret;
  }

}