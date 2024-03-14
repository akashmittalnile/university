<?php

use Illuminate\Support\Facades\Mail;
use App\Mail\DefaultMail;
use App\Models\Content;
use App\Models\SocialMedia;
use App\Models\User;

if (!function_exists('encrypt_decrypt')) {
    function encrypt_decrypt($action, $string)
    {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'PM0University';
        $secret_iv = 'PM0University';
        // hash
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

if (!function_exists('assets')) {
    function assets($path)
    {
        return asset('public/'.$path);
    }
}

if (!function_exists('fileUpload')) {
    function fileUpload($file, $path, $url = 0)
    {
        $name = $file->getClientOriginalName();  
        $file->move(public_path("$path"), $name);
        return $name;
    }
}

if (!function_exists('successMsg')) {
    function successMsg($msg, $data = [])
    {
        return response()->json(['status' => true, 'message' => $msg, 'data' => $data]);
    }
}

if (!function_exists('errorMsg')) {
    function errorMsg($msg, $data = [])
    {
        return response()->json(['status' => false, 'message' => $msg, 'data' => $data]);
    }
}

if (!function_exists('sendEmail')) {
    function sendEmail($data)
    {
        $data['from_email'] = env('MAIL_FROM_ADDRESS');
        Mail::to($data['to_email'])->send(new DefaultMail($data));
    }
}

if (!function_exists('businessHour')) {
    function businessHour()
    {
        $hour = Content::where("name", "business-hour")->first();
        return unserialize($hour->value);
    }
}

if (!function_exists('socialMedia')) {
    function socialMedia()
    {
        $data = SocialMedia::where("status", 1)->orderByDesc('id')->get();
        return $data;
    }
}

if (!function_exists('adminData')) {
    function adminData()
    {
        $adminPro = User::where("admin", 1)->orderBy('id')->first();
        return $adminPro;
    }
}

if (!function_exists('sendMail')) {
    function sendMail($data)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://nileprojects.in/universitypmo/demo/testmail.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  $data,
            CURLOPT_HTTPHEADER => array(),
        ));
        $create_response = curl_exec($curl);
        curl_close($curl);
    }
}

?>