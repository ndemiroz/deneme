<?php
if (! function_exists('time_elapsed_string')) {
  function time_elapsed_string($datetime, $full = false) {
      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'minute',
          's' => 'second',
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }

      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago' : 'just now';
  }
}
if (! function_exists('getimage')) {
function getimage($post){
  $image='https://storia-prod-be.akamaized.net/p/08a984082f486001-08a984082f486004.jpg' ;
  if(is_array($post->attachments)){
  if (isset($post->attachments[0]->file->path)){
  $image=$post->attachments[0]->file->path ;
  }
  }else {
    if (isset($post->attachments->file->path)){
    $image=$post->attachments->file->path ;
    }
  }
  if(array_key_exists('thumbnail', $post)){
  $image= $post->thumbnail->path ;
    }
  return $image ;
}
}
if (! function_exists('number_format_short')) {
function number_format_short( $n, $precision = 1 ) {
	if ($n < 900) {
		// 0 - 900
		$n_format = number_format($n, $precision);
		$suffix = '';
	} else if ($n < 900000) {
		// 0.9k-850k
		$n_format = number_format($n / 1000, $precision);
		$suffix = 'K';
	} else if ($n < 900000000) {
		// 0.9m-850m
		$n_format = number_format($n / 1000000, $precision);
		$suffix = 'M';
	} else if ($n < 900000000000) {
		// 0.9b-850b
		$n_format = number_format($n / 1000000000, $precision);
		$suffix = 'B';
	} else {
		// 0.9t+
		$n_format = number_format($n / 1000000000000, $precision);
		$suffix = 'T';
	}
  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
	if ( $precision > 0 ) {
		$dotzero = '.' . str_repeat( '0', $precision );
		$n_format = str_replace( $dotzero, '', $n_format );
	}
	return $n_format . $suffix;
}
}
if (! function_exists('content_embed')) {
function content_embed($url){
$embeds=Matis\LaravelStoriaApi\Facades\LaravelStoriaApi::getEmbeddedUrlContent($url) ;
if (isset($embeds->html)){
$embed=$embeds->html ;
return $embed ;
  }
    }
  }
