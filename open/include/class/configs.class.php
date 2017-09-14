<?php
class configs {
    static function apimodel(){
        $model = array(
            array(
                "name"=>"小说分类",
            	"query"=>array("PageIndex","PageSize"),
            ),
            array(
                "name"=>"小说列表",
                "query"=>array("PageIndex","PageSize"),
            ),
            array(
                "name"=>"小说详情",
              	"query"=>array("BookId"),
            ),
            array(
                "name"=>"小说目录",
                "query"=>array("BookId","PageIndex","PageSize"),
            ),
            array(
                "name"=>"小说章节",
                "query"=>array("BookId","ChapterId"),
            )
        );
        return $model;
    }
    static function apitype(){
    	$type = array("xml","json","jsonp");
    	return $type;
    }
    static function apiquery(){
    	return array(
    			"PageIndex"=>array(
    					"text" => "页码",
    					"default"=> 1,
    					"isnull" => true
    			),
    			"PageSize"=>array(
    					"text" => "一页显示数量",
    					"default"=> 50000,
    					"isnull" => true
    			),
    			"BookId"=>array(
    					"text" => "小说ID",
    					"default"=> 0,
    					"isnull" => false
    			),
    			"ChapterId"=>array(
    					"text" => "章节ID",
    					"default"=> 0,
    					"isnull" => false
    			),
    	);
    }
    static function imgflag(){
    	return array(1=>'.gif', 2=>'.jpg', 3=>'.jpeg', 4=>'.png', 5=>'.bmp');
    }
}
?>