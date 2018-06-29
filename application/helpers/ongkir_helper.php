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
	
	
$key = "534dfdea9e6f785508564b4b2a3e0f34";
$url = "http://api.rajaongkir.com/starter/";


function getKota($idu){
    global $key,$url;

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "$url"."city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $key"
        )
    ));
    
    $response   = curl_exec($curl);
    $err        = curl_error($curl);
    curl_close($curl);
    $decode     = json_decode($response, true);
?>



<select class="form-control" name="kota">
        <?php for ($x = 0; $x <= 500; $x++) {?>
            <option value="<?php print_r($decode['rajaongkir']['results'][$x]['city_id']);?>" <?php echo ($decode['rajaongkir']['results'][$x]['city_id'] == $idu)?"selected":"" ?>>
                <?php print_r($decode['rajaongkir']['results'][$x]['city_name']);?>
            </option>
        <?php } ?>
</select>

<?php } 

function viewKota($idk){
    global $key,$url;

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "$url"."city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $key"
        )
    ));
    
    $response   = curl_exec($curl);
    $err        = curl_error($curl);
    curl_close($curl);
    $decode     = json_decode($response, true);


 for ($x = 0; $x <= 500; $x++) {
     if ($idk == $decode['rajaongkir']['results'][$x]['city_id']) {
       return print_r($decode['rajaongkir']['results'][$x]['city_name']);
     }

 } 
} 

function curlcity_asal(){
    global $key,$url;

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "$url"."city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $key"
        )
    ));
    
    $response 	= curl_exec($curl);
    $err      	= curl_error($curl);
    curl_close($curl);
    $decode 	= json_decode($response, true);
?>
<br>
	<p>Nama Kota/Kab asal</p>
    <select class="form-control" name="city_asal">
        <?php for ($x = 0; $x <= 500; $x++) {?>
            <option value="<?php print_r($decode['rajaongkir']['results'][$x]['city_id']);?>">
                <?php print_r($decode['rajaongkir']['results'][$x]['city_name']);?>
           	</option>
        <?php } ?>
   </select>

<?php } //End Function curlcity_asal



function curlcity_tujuan(){
	global $key,$url;

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => "$url"."city",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: $key"
        )
    ));
    
    $response 	= curl_exec($curl);
    $err      	= curl_error($curl);
    curl_close($curl);
    $decode 	= json_decode($response, true);
?>
<br>
	<p>Nama Kota/Kab tujuan</p>
    <select class="form-control" name="city_tujuan" id="">
        <?php for ($x = 0; $x <= 500; $x++) { ?>
            <option value="<?php print_r($decode['rajaongkir']['results'][$x]['city_id']);?>">
                <?php print_r($decode['rajaongkir']['results'][$x]['city_name']);?>
           </option>
        <?php } ?>
   </select>
   <br>
<?php }//End function curlcity_tujuan



 function hitung_ongkir($idb,$alamat,$asal,$tujuan,$berat,$nobid){ 
 	global $key,$url;

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url"."cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$asal&destination=$tujuan&weight=$berat&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $key"
            )
        ));
        
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        $decode = json_decode($response, true); ?>

    <form action="proses.php" method="post" class="form">
        <p>Alamat Tujuan Pengiriman:</p>
        <div class="form-group">
            <label for="">Alamat : </label>
            <input type="text" name="alamat" value="<?php echo $alamat ?>" placeholder="" class="form-control" disabled="">
        </div>
        <div class="form-group">
            <label for="">Kota/Kab :</label>
            <input type="text" name="kota" value="<?php viewKota($asal) ?>" placeholder="" class="form-control" disabled="">
        </div>
        <div class="form-group">
            <label for="">Berat Barang:</label>
            <input type="text" name="berat" value="<?php echo $berat ?> Kg" placeholder="" class="form-control" disabled="">
        </div>

        <div class="form-group">
            <label for="">Pilih Kurir :</label>
            <input type="text" value="<?php echo $nobid?>" name="nobid"  class="form-control" style="display: none;">
            <select name="ongkir">
                <?php   for ($x = 0; $x <= 1; $x++) { ?>
                <option value="JNE <?php print_r($decode['rajaongkir']['results'][0]['costs'][$x]['service'].','.$decode['rajaongkir']['results'][0]['costs'][$x]['cost'][0]['value']);?>"> 
                    <?php print_r("<h3>JNE ".$decode['rajaongkir']['results'][0]['costs'][$x]['service']. "</h3>");
                    print_r("<h4> : Rp ".$decode['rajaongkir']['results'][0]['costs'][$x]['cost'][0]['value']."</h4>");
                    ?>            
                </option>
                <?php } ?>
            </select>
        </div>
       
        <br>
        <input class="btn btn-success" type="submit" onclick="return comfirm('Apakah Anda Yakin.. ?')" name="submit" value="Submit">
    </form>
       <?php 
    }  //End function hitung_ongkir()




?>