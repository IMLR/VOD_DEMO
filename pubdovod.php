<?
require 'vendor/autoload.php';
use QL\QueryList;

function getNeedBetween($kw1,$mark1,$mark2){
$kw=$kw1;
$kw='123'.$kw.'end';
$st =stripos($kw,$mark1);
$ed =stripos($kw,$mark2);
$lengthma = strlen($mark1);
$lengthmb = strlen($mark2);
if(($st==false||$ed==false)||$st>=$ed)
return 0;
$kw=substr($kw,($st+$lengthma),($ed-$st-$lengthma));
return $kw;
}

$yourdomain = '';
$page = urldecode($_REQUEST["pg"]);
$url = 'https://publicdomainmovie.net/?page='.$page;
$rules = ['link' => ['.views-field-nothing-1>.field-content>.cover>a','href'],'title' => ['.views-field-nothing-1>.field-content>.cover>a>.info','html'],'img' => ['.views-field-nothing-1>.field-content>.cover>a>.cover_image>div>img','src']
];
$range = '.view-content .cover-row';
$rt = QueryList::get($url)->rules($rules)->range($range)->query()->getData();

echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<rss version="5.1">';
echo '<list page="'.$page.'">';
foreach ($rt as $key => $value) {
echo '<video>
      <last></last>
      <id></id>
      <tid></tid>
      <name><![CDATA['.getNeedBetween($value['title'],"<b>","</b>").']]></name>
      <type></type>
      <pic>https://publicdomainmovie.net'.$value['img'].'</pic>
      <lang/>
      <area/>
      <year></year>
      <state></state>
      <note><![CDATA[]]></note>
      <actor><![CDATA[]]></actor>
      <director><![CDATA[]]></director>
      <dl>
        <dd flag="1"><![CDATA[PLAY$'.$yourdomain."/pubdo.php?url=".$value['link'].']]></dd>
      </dl>
      <des><![CDATA['.getNeedBetween($value['title'],"<br>","end").']]></des>
    </video>';
}
echo '  </list>
</rss>'


?>