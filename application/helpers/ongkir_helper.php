<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


	function SendMail($email,$sub,$msg){
	$CI =& get_instance();

    $config = Array(
		  'protocol' 	=> 'smtp',
		  'smtp_host' 	=> 'ssl://smtp.googlemail.com',
		  'smtp_port' 	=> 465,
		  'smtp_user' 	=> 'hirro.last@gmail.com', 
		  'smtp_pass' 	=> 'syhzloqibydqzwnh', 
		  'mailtype' 	=> 'html',
		  'charset' 	=> 'iso-8859-1',
		  'wordwrap' 	=> TRUE,
		  'newline'   	=> "\r\n",
		);

		    $CI->load->library('email', $config);
    		$CI->email->initialize($config);
		    $CI->email->from('hirro.last@gmail.com','Project'); 
		    $CI->email->to("$email");
		    $CI->email->subject("$sub");
		    $CI->email->message("$msg");
		      	
		      	if($CI->email->send()){
		      		return TRUE;
		     	}
		     	else{
		     		return false;
		    	}

	}
	
	
// $key = "534dfdea9e6f785508564b4b2a3e0f34";

function getKota($idk){ 
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: 54b6d245ff2d26cc361062984d9d3f6d"
      ),
    ));
     
    $response = curl_exec($curl);
    $err = curl_error($curl);
    $data = json_decode($response, true);
     
    curl_close($curl);
     
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
       for ($x = 0; $x < count($data['rajaongkir']['results']); $x++) {
        if ($idk == $data['rajaongkir']['results'][$x]['city_id']) {
                 echo $data['rajaongkir']['results'][$x]['city_name'];
            }
        } 
    }
     
} 

function viewKota($idk){ 
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$idk",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: 54b6d245ff2d26cc361062984d9d3f6d"
      ),
    ));
     
    $response = curl_exec($curl);
    $err = curl_error($curl);
    $data = json_decode($response, true);
     
    curl_close($curl);
     
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
     for ($x = 0; $x <= count($data['rajaongkir']['results']); $x++) {
     if ($idk == $decode['rajaongkir']['results'][$x]['city_id']) {
       print_r($decode['rajaongkir']['results'][$x]['city_name']);
        }

      } 
    } 
}
     

function showKota(){
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 54b6d245ff2d26cc361062984d9d3f6d"
          ),
        ));
     
        $response = curl_exec($curl);
        $err = curl_error($curl);
     
        curl_close($curl);
     
        echo "<label>Kota Asal</label><br>";
        echo "<select name='asal' id='asal'>";
        echo "<option>Pilih Kota Asal</option>";
            $data = json_decode($response, true);
            for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
                echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
            }
        echo "</select><br><br><br>";
    
 } //End Function curlcity_asal




 function hitung_ongkir($asal,$tujuan){ 

    $berat = 1;

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$tujuan."&weight=".$berat."&courier=jne",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 54b6d245ff2d26cc361062984d9d3f6d"
      ),
    ));
 
    $response = curl_exec($curl);
    $err = curl_error($curl);
    $decode = json_decode($response, true); 

    curl_close($curl);
 
        if ($err) {   echo "cURL Error #:" . $err;
        } else {
          echo '<td>
                <select name="service" class="form-control" id="ong"> <option value="JNE,0" selected disabled>~ Pilih Paket ~</option>';
          for($x = 0; $x <= count($decode['rajaongkir']['results']); $x++){

          echo  '
          <option value="'.$decode['rajaongkir']['results'][0]['costs'][$x]['service'].','.$decode['rajaongkir']['results'][0]['costs'][$x]['cost'][0]['value'].'">
                JNE  '.$decode['rajaongkir']['results'][0]['costs'][$x]['service'].' : Rp '.$decode['rajaongkir']['results'][0]['costs'][$x]['cost'][0]['value'].'</option>'; 
         }
          echo  '</select>
            </td>';

        }
    }  //End function hitung_ongkir()

?>