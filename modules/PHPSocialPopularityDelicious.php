<?php

class PHPSocialPopularityDelicious implements iPHPSocialPopularityModule {

  const FETCH_URL = 'http://feeds.delicious.com/v2/json/urlinfo/data?url=';

  public function fetch(PHPSocialPopularity $psp, $url) {
    $ret = array();
    $result = json_decode($psp->get(self::FETCH_URL.urlencode($url)));
    $ret['total'] = $result[0]->total_posts ? $result[0]->total_posts : 0;
    return $ret;
  }

}