<?php
class Security_check
{
  public function cek_login()
  {
    $this->CI =& get_instance();
    $class = $this->CI->router->fetch_class();
    $method = $this->CI->router->fetch_method();

    $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url .= "://".$_SERVER['HTTP_HOST'];
    $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    
		if (!isset($_SESSION['uname']) && !isset($_SESSION['ulevel']) ){
      if ( !in_array($class,['menu','prc','Prc','ws']) && $this->CI->uri->segment(1) !='ws' ) {
        session_destroy();
        redirect($base_url);
      }
		}
  }
  
}
