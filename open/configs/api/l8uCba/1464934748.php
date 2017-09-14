<?php
return array(
"apiuse" => "小说列表",
"apimodel" => "1",
"apitype" => "xml",
"query" => unserialize(stripslashes("a:2:{s:9:\"PageIndex\";s:9:\"PageIndex\";s:8:\"PageSize\";s:8:\"PageSize\";}")),
"template" => miyue::configdecode("%3C%3Fxml+version%3D%5C%221.0%5C%22+encoding%3D%5C%22utf-8%5C%22%3F%3E%0A%3Cbooks%3E%0A+%3C%7Bsection+name%3Da+loop%3D%24Data%7D%3E%0A++%3Cbook%3E%0A++++%3Cid%3E%3C%21%5BCDATA%5B%3C%7B%24Data%5Ba%5D.articleid%7D%3E%5D%5D%3E%3C%2Fid%3E%0A++++%3Cbooktitle%3E%3C%21%5BCDATA%5B%3C%7B%24Data%5Ba%5D.articlename%7D%3E%5D%5D%3E%3C%2Fbooktitle%3E%0A++++%3Cupdatetime%3E%3C%7B%24Data%5Ba%5D.lastupdate%7Cdate_format%3A%22%25Y-%25m-%25d+%25H%3A%25M%3A%25S%22%7D%3E%3C%2Fupdatetime%3E%0A++%3C%2Fbook%3E%0A%3C%7B%2Fsection%7D%3E%0A%3C%2Fbooks%3E%0A"),
);
?>
