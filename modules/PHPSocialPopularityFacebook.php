<?php

class PHPSocialPopularityFacebook implements iPHPSocialPopularityModule {

  const FETCH_URL = 'http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=';

  public function fetch(PHPSocialPopularity $psp, $url) {
    $ret = array();
    $result = json_decode($psp->get(self::FETCH_URL.''.urlencode($url)));

    $ret['share_count'] = $result[0]->share_count;
    $ret['like_count'] = $result[0]->like_count;
    $ret['comment_count'] = $result[0]->comment_count;
    $ret['click_count'] = $result[0]->click_count;
    $ret['total'] = $result[0]->total_count;

    return $ret;
  }

}