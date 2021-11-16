<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

function runWS($data)
{
  // $url = 'http://localhost:8082/ws/live2.php';
  $url = 'http://feeder.untad.ac.id:8082/ws/live2.php';
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

function token()
{
  $ci =& get_instance();
  $dataToken = array (
    'act' => 'GetToken',
    'username' => '001028e1',
    'password' => 'az18^^'
  );		
  $tokenFeeder = runWS($dataToken);
  $obj = json_decode($tokenFeeder);
  $token = $obj->data->token;

  return $token;
}

function tgl_indo($tanggal)
{
  $bulan = array (
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
 
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

function dump_d($data,$die=true){
  echo json_encode($data);
  if ($die) {
    exit();
  }
}

function base64encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
};

function base64decode($data) {
  return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
};

function init_post_only()
{
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
  }
}