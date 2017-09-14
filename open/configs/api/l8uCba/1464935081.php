<?php
return array(
"apiuse" => "小说目录",
"apimodel" => "3",
"apitype" => "xml",
"query" => unserialize(stripslashes("a:3:{s:6:\"BookId\";s:6:\"BookId\";s:9:\"PageIndex\";s:9:\"PageIndex\";s:8:\"PageSize\";s:8:\"PageSize\";}")),
"template" => miyue::configdecode("%3C%3Fxml+version%3D%5C%221.0%5C%22+encoding%3D%5C%22utf-8%5C%22%3F%3E%0A%3Cchapters%3E%0A%3C%7Bsection+name%3Da+loop%3D%24Data%7D%3E%0A++%3Cchapter%3E%0A++++%3Cid%3E%3C%7B%24Data%5Ba%5D.chapterid%7D%3E%3C%2Fid%3E%0A%3Ctitle%3E%3C%21%5BCDATA%5B%3C%7B%24Data%5Ba%5D.chaptername%7D%3E%5D%5D%3E%3C%2Ftitle%3E%0A%3Cisvip%3E%3C%21%5BCDATA%5B%3C%7B%24Data%5Ba%5D.license%7D%3E%5D%5D%3E%3C%2Fisvip%3E%0A++++%3Cvolume%3E%3C%21%5BCDATA%5B%E6%AD%A3%E6%96%87%5D%5D%3E%3C%2Fvolume%3E%0A++++%3Curl%3E%3C%21%5BCDATA%5B%3C%7BSITEURL%7D%3E%2Findex.php%2Fapi%2Fin%2FAppID%3Dl8uCba%2FApiID%3D1464935413%2FBookId%3D%3C%7B%24Data%5Ba%5D.articleid%7D%3E%2FChapterId%3D%3C%7B%24Data%5Ba%5D.chapterid%7D%3E%5D%5D%3E%3C%2Furl%3E%0A++%3C%2Fchapter%3E%0A%3C%7B%2Fsection%7D%3E%0A%3C%2Fchapters%3E%0A"),
);
?>
