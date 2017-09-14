<?php
return array(
"apiuse" => "小说详情",
"apimodel" => "2",
"apitype" => "xml",
"query" => unserialize(stripslashes("a:1:{s:6:\"BookId\";s:6:\"BookId\";}")),
"template" => miyue::configdecode("%3C%3Fxml+version%3D%5C%221.0%5C%22+encoding%3D%5C%22utf-8%5C%22%3F%3E%0A%3Cbook%3E%0A++%3Cid%3E%3C%7B%24Data-%3Earticleid%7D%3E%3C%2Fid%3E++++++++++%0A++%3Ccategory%3E%3C%21%5BCDATA%5B%3C%7B%24Data-%3Esortname%7D%3E%5D%5D%3E%3C%2Fcategory%3E%0A++%3Ctitle%3E%3C%21%5BCDATA%5B%3C%7B%24Data-%3Earticlename%7D%3E%5D%5D%3E%3C%2Ftitle%3E%0A++%3Cauthor%3E%3C%21%5BCDATA%5B%3C%7B%24Data-%3Eauthor%7D%3E%5D%5D%3E%3C%2Fauthor%3E%0A++%3CisFull%3E%3C%7B%24Data-%3Efullflag%7D%3E%3C%2FisFull%3E%0A++%3CunitPrice%3E3%3C%2FunitPrice%3E%0A++%3CstartPayChapter%3E20%3C%2FstartPayChapter%3E%0A++%3Ccover%3E%3C%21%5BCDATA%5B%3C%7B%24Data-%3Eimgurl%7D%3E%5D%5D%3E%3C%2Fcover%3E%0A++%3Csummary%3E%3C%21%5BCDATA%5B%3C%7B%24Data-%3Eintro%7D%3E%5D%5D%3E%3C%2Fsummary%3E%0A++%3Curl%3E%3C%21%5BCDATA%5B%3C%7BSITEURL%7D%3E%2Findex.php%2Fapi%2Fin%2FAppID%3Dl8uCba%2FApiID%3D1464935081%2FBookId%3D%3C%7B%24Data-%3Earticleid%7D%3E%5D%5D%3E%3C%2Furl%3E%0A%3C%2Fbook%3E%0A"),
);
?>
