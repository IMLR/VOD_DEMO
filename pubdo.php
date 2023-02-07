<?
require 'vendor/autoload.php';
use QL\QueryList;
use QL\Ext\AbsoluteUrl;
$url = urldecode($_REQUEST["url"]);
$video = QueryList::get($url)->find('.field.field-name-download.field-type-ds.field-label-hidden')->find('div')->find('div')->find('a')->href;
$video = 'https://publicdomainmovie.net/'.$video;
header('Content-Type: application/x-mpegURL');
header("location: $video");
exit;
?>