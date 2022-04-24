<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FeederRunWS extends CI_Model{


  public function __construct(){
    parent::__construct();
    $this->feeder['url']=$this->config->item('url_feeder2');
    $this->feeder['username']=$this->config->item('user_feeder');
    $this->feeder['password']=$this->config->item('password_feeder');
  }

  /**
    * configurasi feeder
    *
    * @var array
    */
  private $feeder = [];
  
  private function runWS($data)
  {

    $url = $this->feeder['url'];
    $ch = curl_init();
      
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $headers = array();
    
    $headers[] = 'Content-Type: application/json';
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $data = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
  }
  
  function tokenNEO()
  {
    $data = array(
      'username'=> '001028p1',
      'password'=> 'bakp2021@#$',
      'semester'=> ['id_smt'=>'20211'],
    );
    $url = "http://feeder.untad.ac.id:3003/ws/user/login";
    $ch = curl_init();
      
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $headers = array();
    
    $headers[] = 'Content-Type: application/json';
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $data = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode( $result);
  }

  public function token()
  {
    if(isset($_SESSION['data_token'])){
      $data_token = json_decode($_SESSION['data_token']);

      if( time() <= $data_token['exp'] ){
        $token = $data_token['token'];
      }else{
        $res = $this->runWS(array(
        'act' => 'GetToken',
        'username' => $this->feeder['username'],
        'password' => $this->feeder['password']
        ));
        $token_feeder = json_decode($res);
        if($token_feeder->error_code = 0 ){
          $token = $token_feeder->data->token;
          $_SESSION['data_token'] = [
            'exp' => strtotime("+28 minutes", time()),
            'token' => $token ];
        }else{
          $token = "";
          unset($_SESSION['data_token']);
        }
      }
    }else{
        $res = $this->runWS(array(
        'act' => 'GetToken',
        'username' => $this->feeder['username'],
        'password' => $this->feeder['password']
        ));
        $token_feeder = json_decode($res);
        if($token_feeder->error_code = 0 ){
          $token = $token_feeder->data->token;
          $_SESSION['data_token'] = [
            'exp' => strtotime("+28 minutes", time()),
            'token' => $token ];
        }else{
          $token = "";
          unset($_SESSION['data_token']);
        }
      }
    }

    return $token;
  }
  /**
   * fungsi get data from feeder
   *
   * @param string $act
   * @param string $filter
   * @param string $limit
   * @param string $offset
   * @return object
   */
  public function get($act,$filter='',$limit='',$offset='')
  {

    $params = array(
      'act'    =>$act,
      'token'  => $this->token(),
      'filter' => $filter,
      'limit'  => $limit,
      'offset' => $offset
    );

    return json_decode($this->runWS($params));
  }

  /**
   * fungsi insert feeder
   * 
   * @param string $act
   * @param array $record
   * @return object
   */
  public function insert($act,$record)
  {

    $params = array(
      'act'    => $act,
      'token'  => $this->token(),
      'record' => $record 
    );

    return json_decode($this->runWS($params));
  }

  /**
   * fungsi update data feeder
   *
   * @param string $act
   * @param string $key
   * @param array $record
   * @return object
   */
  public function update($act,$key,$record)
  {

    $params = array(
      'act'    => $act,
      'token'  => $this->token(),
      'key'    => $key,
      'record' => $record
    );

    return json_decode($this->runWS($params));
  }

  /**
   * fungsi delete data feeder
   *
   * @param string $act
   * @param string $key
   * @return object
   */
  public function delete($act,$key)
  {

    $params = array(
      'act'    => $act,
      'token'  => $this->token(),
      'key'    => $key
    );

    return json_decode($this->runWS($params));
  }

}
?>
