<?php
/**************************************************/
/**            Haram Untuk Dijual Lagi           **/
/**                 Bot By: Jumady               **/
/** Donation PM https://www.facebook.com/dyvretz **/
/**************************************************/
error_reporting(0);
echo "
    _______      _____    __ 
 __ / /  _/ | /| / / _ |__/ /_
/ // // / | |/ |/ / __ /_  __/
\___/___/ |__/|__/_/ |_|/_/   
        ----- CREATOR
        ----- BOT BY: JUMADY\n\n
";
while (-1) {
    echo " --- Proccessing Account\n";
    $nomor_hp =  input( "   ? Nomor Handphone (628XXXXXXXX)");
    $data = '{"phone":"'.$nomor_hp.'"}';
    $headers = [
        "Host: user.jiwa.app",
        "accept: application/json", 
        "deviceid: ".generateRandomString(16), 
        "os: android", 
        "os_version: 32", 
        "sdk: 32", 
        "build_number: 10014", 
        "versionname: v3.3.1", 
        "versioncode: 10014", 
        "content-type: application/json", 
        "content-length: ".strlen($data),
        "accept-encoding: gzip", 
        "user-agent: okhttp/5.0.0-alpha.11" 
    ];
    
    $curl_sendotp = curl("https://user.jiwa.app/auth/otp/request", $data, $headers);
    if (strpos($curl_sendotp[1], "\"data\":\"success\"")) {
        echo "   - Success Send Otp\n";
        $otp =  input( "   ? OTP WhatsApp");
        $data = '{"phone":"'.$nomor_hp.'","device_id":"dsZHM5n1T9Wh3hriYHAjBR:APA91bGYzFUKNwCvEsXCc-yFYCvp-7kcPqB08BNNwXeJ6UGyW2enb6bl_8t13eZzI4xFo3XKdpPQbjJiaA-JM-aMXMHW36LwLclLHZokr37-W943CPP7qJzQU9qVXqedtBVG1z7vKfDl","device_type":"ANDROID","otpSecret":"'.$otp.'"}';
        $headers = [
            "Host: user.jiwa.app",
            "accept: application/json", 
            "deviceid: ".generateRandomString(16), 
            "os: android", 
            "os_version: 32", 
            "sdk: 32", 
            "build_number: 10014", 
            "versionname: v3.3.1", 
            "versioncode: 10014", 
            "content-type: application/json", 
            "content-length: ".strlen($data),
            "accept-encoding: gzip", 
            "user-agent: okhttp/5.0.0-alpha.11" 
        ];
        $curl_verify = curl("https://user.jiwa.app/auth/otp/verify/", $data, $headers);
        if (strpos($curl_verify[1], "accessToken")) {
            echo "   - Success Verify Otp\n";
            $accessToken = get_between($curl_verify[1], "\"accessToken\":\"", "\"");
            echo "   - Access Token : ".$accessToken."\n";
            $username = get_between(nama(), "\"username\":\"", "\"");
            $name = get_between(nama(), "\"first\":\"", "\"");
            $email = $username."@gmail.com";
            $data = '{"name":"'.$name.'","birth_date":"1999-06-05","gender":"male","email":"'.$email.'","citizenship":"Indonesia","occupation":3,"referral":"MJJDE9","pin":"222333","verif_pin":"222333"}';
            $headers = [
                "Host: user.jiwa.app", 
                "accept: application/json", 
                "deviceid: ".generateRandomString(16), 
                "os: android", 
                "os_version: 32", 
                "sdk: 32", 
                "build_number: 10014", 
                "versionname: v3.3.1", 
                "versioncode: 10014", 
                "authorization: Bearer ".$accessToken,
                "content-type: application/json",
                "content-length: ".strlen($data),
                "accept-encoding: gzip", 
                "user-agent: okhttp/5.0.0-alpha.11"
            ];
            $update_info = curl_patch("https://user.jiwa.app/auth/customer/update-info", $data, $headers);
            if (strpos($update_info, "\"statusCode\":200")) {
                echo "   - Register Success..\n";
                echo "   - Account Saved in To janji_jiwa.txt\n\n";
                file_put_contents("janji_jiwa.txt", "Nomor HP: ".$nomor_hp."|Pin: 222333\n", FILE_APPEND);
            } else {
                echo "   - Failed Register\n\n";
            }
        } else {
            echo "   - Failed Verify Otp\n";
        }
    } else {
        echo "   - Failed Send Otp\n";
    }
}


function input($text) {
    echo $text.": ";
    $a = trim(fgets(STDIN));
    return $a;
}

function getName() {
    $r = file_get_contents('https://www.random-name-generator.com/indonesia?gender=&n=1&s='.rand(111,999));
    $namenya = get_between($r,'<div class="col-sm-12 mb-3" id="','-');
    $nama_indo = preg_replace('/s+/', '', $namenya);
    return ucfirst($nama_indo);
}

function get_between($string, $start, $end) 
    {
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }


function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function nama() {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://randomuser.me/api");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	return $ex;
}

function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
}

function curl_patch($url, $post = 0, $httpheader = 0, $proxy = 0) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');  // Set the request method to PATCH

    if ($post) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    if ($httpheader) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
    }

    if ($proxy) {
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    }

    curl_setopt($ch, CURLOPT_HEADER, true);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  // Get the HTTP status code

    if (!$httpcode) {
        return "Curl Error: " . curl_error($ch);
    } else {
        $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
        $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
        curl_close($ch);
        return array($header, $body);
    }
}
