<?php
return array(
"apiuse" => "小说章节",
"apimodel" => "4",
"apitype" => "xml",
"query" => unserialize(stripslashes("a:2:{s:6:\"BookId\";s:6:\"BookId\";s:9:\"ChapterId\";s:9:\"ChapterId\";}")),
"template" => miyue::configdecode("%3C%3Fxml+version%3D%5C%221.0%5C%22+encoding%3D%5C%22utf-8%5C%22%3F%3E%0A%3Ccontent%3E%0A%09%3C%21%5BCDATA%5B%3C%7B%24Data-%3Etxt%7D%3E%5D%5D%3E%0A%3C%2Fcontent%3E%0A"),
);
?>
