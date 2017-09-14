<?php
class Controller{
    public function Run(){
        $this->Analysis();

        $control = $_GET['m'];
        $action = $_GET['action'];
        $action = ucfirst($action);
		$controlFile = ROOT_PATH . '/controllers/' . $control . '.class.php';
		
		if(!file_exists($controlFile)) //如果文件不存在提示错误, 否则引入
		{ 
			header('HTTP/1.1 403 Forbidden'); 
			exit();
		}
		include($controlFile);
		$class = ucfirst($control); //将控制器名称中的每个单词首字母大写,来当作控制器的类名
		if(!class_exists($class)) //判断类是否存在, 如果不存在提示错误
		{
			exit("{$control}.class.php中未定义的控制器类" . $class);
		}
		$instance = new $class(); //否则创建实例
		if(!method_exists($instance, $action)) //判断实例$instance中是否存在$action方法, 不存在则提示错误
		{
			exit("$class类中不存在方法:". $action);
		}
		$instance->$action();
    }

    protected function Analysis(){
        global $C;
        if($C['URL_MODE'] == 1)//http://localhost/index.php?c=控制器&a=方法
        {
            $control = !empty($_GET['m']) ? trim($_GET['m']) : '';
            $paths = explode('/', $control);
            $control = $paths[0];
            @$action = $paths[1];
        }
        else if($C['URL_MODE'] == 2)//http://localhost/index.php/控制器/方法/其他参数
        {
            if(isset($_SERVER['PATH_INFO'])){
                $path = trim($_SERVER['PATH_INFO'], '/');
                $paths = explode('/', $path);
                $control = array_shift($paths);
                $action = array_shift($paths);
                while($get = array_shift($paths)){
                    $gets = explode('=', $get);
                    if($get!=""){
                        $_GET[$gets[0]] = @$gets[1];
                    }
                }
            }
        }
		
        $_GET['m'] = !empty($control) ? $control : $C['DEFAULT'];
        $_GET['action'] = !empty($action) ? $action : $C['DEFAULT_ACTION'];
    }
}
?>