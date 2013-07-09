<?php

class PHPSocialPopularityLinkedIn implements iPHPSocialPopularityModule {

  const FETCH_URL = 'http://www.linkedin.com/countserv/count/share?format=json&url=';

  public function fetch(PHPSocialPopularity $psp, $url) {
    $ret = array();
    $result = json_decode($psp->get(self::FETCH_URL.urlencode($url)));
    $ret['total'] = $result->count;
    return $ret;
  }

}