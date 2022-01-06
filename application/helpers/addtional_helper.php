<?php


/**
 * function 		: debug()
 * @author 			Mohamad Fadli
 * @param array 	$data (variable parse data)
**/
function debug($data)
{
	$CI =& get_instance();

	echo "<pre>";
	print_r($data);
	echo "</pre>";

	echo "<pre>";
	print_r($CI->db->last_query());
	echo "</pre>";
}


/**
 * function 		: call_view()
 * @author 			Mohamad Fadli
 * @param array 	$data (variable parse data to view)
 * @param string 	$page (name of Page to call)
 * @param bool 		$debug (for show data parse and last query)
 * @param bool 		$js (to call additional page js)
**/
function call_view($debug = False, $page="", $data="", $js=False)
{
	$CI =& get_instance();

	if($debug){
		debug($data);
	}
	else{
		$CI->load->view('temp/head');
		$CI->load->view($page, $data);
		$CI->load->view('temp/footers');
		if($js){
			$CI->load->view($page.'_js', $data);
		}
	}
}

function semester_aktif(){
	$CI =& get_instance();
	$CI->db->select();
	$kdj = $CI->session->userdata('kdj');
	$semester_aktif = $CI->db->select('Kode,Nama')->where('KodeJurusan',$kdj)->group_by('Kode')->order_by('Kode', 'DESC')->limit(1)->get('_v2_tahun')->result_array();
	return  $semester_aktif[0]['Kode'];
}

function status($status)
{
	if($status == "A"){
		echo "Aktif";
	}
	elseif ($status == "L") {
		echo "Lulus";
	}
	elseif ($status == "C") {
		echo "Cuti";
	}
	elseif ($status == "U") {
		echo "Unregist";
	}
	elseif ($status == "DO") {
		echo "DropOut";
	}
	else{
		echo "Status tidak terdaftar";
	}
}




function encode($plaintext = "")
{
	$CI =& get_instance();
	return str_replace(array('+', '/', '='), array('-', '_', '~'), $plaintext);
}

function decode($chipertext = "")
{
	$CI =& get_instance();
	// return str_replace(array('_', '~'), array('/', '='), $chipertext);
	return str_replace(array('-', '_', '~'), array('+', '/', '='), $chipertext); // fikri hapus setelah berdebat dengan fandu
}

function limitKrs($kodeJurusan, $semester_aktif = "" )
{
	$CI =& get_instance();

	$where['KodeJurusan']	= $kodeJurusan;
	$where['Tahun']			= $semester_aktif;

	return $CI->db->select('krsm,krss,ukrsm,ukrss')->limit(1)->get_where('_v2_bataskrs',$where)->result_array();
}

function checkLimitKrs($kodeJurusan="")
{
	$limitKrs = limitKrs($kodeJurusan, semester_aktif());
	
	if(!empty($limitKrs)){
		if(strtotime($limitKrs[0]['krsm']) <= strtotime(date('Y-m-d')) && strtotime(date('Y-m-d')) <= strtotime($limitKrs[0]['krss'])){
			return true;
		}
		elseif(strtotime($limitKrs[0]['ukrsm']) >= strtotime(date('Y-m-d')) && strtotime(date('Y-m-d')) <= strtotime($limitKrs[0]['ukrss'])){
			return true;
		}
	}

	return false;
}

function getMajorCollege($nim)
{
	$CI =& get_instance();

	$where['NIM'] = $nim;
	return $CI->db->get_where('_v2_mhsw', $where)->row()->KodeJurusan;
}

/**
 * function 		: cleanName()
 * @author 			MOh Dzulfikri
 * @param string 	$name (name with symbol ' )
 * @return	string	name without symbol '
**/
function cleanName($name){
	$find=["\'","&#39;"];
	$replace="'";
	return str_replace($find,$replace,$name);
}

/**
 * 
 */
function sendMessage($data=[])
{
	
	$ci = get_instance();
	$config = $ci->config;
	$bot_key = $config->item('telegram_bot_key');
	$bot_msg_id = $config->item('telegram_bot_msg_id');

	$data = http_build_query(array(
		'chat_id' => $bot_msg_id,
		'parse_mode' => 'html',
		'text' => json_encode($data)
	));

	$options = array(
		"ssl"=>array(
			"allow_self_signed"=>true,
			"verify_peer"=>false,
			"verify_peer_name"=>false,
		),
	);
	$url = "https://api.telegram.org/bot$bot_key/sendMessage?$data";

	return json_decode(file_get_contents($url, false, stream_context_create($options)));
}

/**
 * 
 */
function getDevice($ua)
{
	$url = "http://api.userstack.com/api/detect?access_key=ec1a48617e103c11ffd57cbeead9050b&ua=$ua";
	$options = array(
		"ssl"=>array(
			"allow_self_signed"=>true,
			"verify_peer"=>false,
			"verify_peer_name"=>false,
		),
	);
	$data = json_decode(file_get_contents($url, false, stream_context_create($options)));
	$device = $data->device->type.' '.$data->device->brand.' '.$data->device->name." <a href='$url'>info<a>";

	return $device;
}

/**
 * function	: get_ip_client()
 * @desc	: get ip client 
 * @author	: Moh Dzulfikri
 * @return	: string
 */
 function get_ip_client(){
	$clientIP = '0.0.0.0';

	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$clientIP = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
		# when behind cloudflare
		$clientIP = $_SERVER['HTTP_CF_CONNECTING_IP']; 
	} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$clientIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
		$clientIP = $_SERVER['HTTP_X_FORWARDED'];
	} elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
		$clientIP = $_SERVER['HTTP_FORWARDED_FOR'];
	} elseif (isset($_SERVER['HTTP_FORWARDED'])) {
		$clientIP = $_SERVER['HTTP_FORWARDED'];
	} elseif (isset($_SERVER['REMOTE_ADDR'])) {
		$clientIP = $_SERVER['REMOTE_ADDR'];
	}

	return $clientIP;
 }
?>
