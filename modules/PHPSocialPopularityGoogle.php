<?php

class PHPSocialPopularityGoogle implements iPHPSocialPopularityModule {

  const FETCH_URL = 'https://clients6.google.com/rpc';

  public function fetch(PHPSocialPopularity $psp, $url) {
    $ret = array();
    $result = json_decode(
      $psp->post(
        self::FETCH_URL,
	'[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.urldecode($url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]'
      )
    );
    $ret['total'] = $result[0]->result->metadata->globalCounts->count;
    return $ret;
  }

}