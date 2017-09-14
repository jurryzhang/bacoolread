<?php

class MySmarty{
    public function __construct($path = '')
    {
        $this->smarty = new Smarty;
        $this->smarty->template_dir = ROOT_PATH . '/templates/' . $path;
        miyue::check_dir(ROOT_PATH . '/cache/templates_c/' . $path);
        $this->smarty->compile_dir = ROOT_PATH . '/cache/templates_c/' . $path;
        $this->smarty->left_delimiter = '<{';
        $this->smarty->right_delimiter = '}>';
    }

    public function assign($assign){
        $this->smarty->assign($assign);
    }
    public function show($file,$arraydate=array())
    {
        $function_array = get_class_methods("smartyfunction");
        if (is_array($function_array)) {
            foreach ($function_array as $smarty_function) {
                if ($smarty_function) {
                    $this->smarty->registerPlugin("function",$smarty_function, "smartyfunction::" . $smarty_function);
                }
            }
        }
        $url_array = get_class_methods("urlconfigs");
        if (is_array($url_array)) {
            foreach ($url_array as $url_function) {
                if ($url_function) {
                    $this->smarty->registerPlugin("function",$url_function, "urlconfigs::" . $url_function);
                }
            }
        }
        $this->smarty->assign($arraydate);
        return $this->smarty->fetch($file);
    }
}

?>