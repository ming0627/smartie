<?php 
$xml = simplexml_load_file('example_htmlpage.html');
print "<ul>\n";
foreach ($xml->channel->item as $item){
  print "<li>$item->title</li>\n";
}
print "</ul>";
?>