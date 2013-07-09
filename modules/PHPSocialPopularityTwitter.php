<?php

class PHPSocialPopularityTwitter implements iPHPSocialPopularityModule {

  const FETCH_URL = 'http://urls.api.twitter.com/1/urls/count.json?url=';

  public function fetch(PHPSocialPopularity $psp, $url) {
    $ret = array();
    $result = json_decode($psp->get(self::FETCH_URL.urlencode($url)));
    $ret['total'] = $result->count;
    return $ret;
  }

}