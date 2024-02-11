<?php

use App\Models\PricingPlan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

	function StoreImage($file, $location, $size = null, $removefile = null): string
    {
		if(!file_exists($location)){
			mkdir($location, 0755, true);
		}
		if($removefile){
			if(file_exists($location.'/'.$removefile) && is_file($location.'/'.$removefile)){
				@unlink($location.'/'.$removefile);
			}
		}
	    $filename =uniqid().time().'.'.$file->getClientOriginalExtension();
	    $image = Image::make(file_get_contents($file));
	    if(isset($size)) {
	        $size = explode('x', strtolower($size));
	        $image->resize($size[0],$size[1], null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
	    }
	    $image->save($location.'/'.$filename);
	    return $filename;
	}

	function paginateNumber($number = 10)
	{
		return $number;
	}


    function filterContactNumber($contact): string
    {
        return preg_replace('/[^0-9]/', '', trim(str_replace('+', '', $contact)));
    }

	function build_post_fields( $data,$existingKeys='',&$returnArray=[]){
	    if(($data instanceof CURLFile) or !(is_array($data) or is_object($data))){
	        $returnArray[$existingKeys]=$data;
	        return $returnArray;
	    }
	    else{
	        foreach ($data as $key => $item) {
	            build_post_fields($item,$existingKeys?$existingKeys."[$key]":$key,$returnArray);
	        }
	        return $returnArray;
	    }
	}

	function filePath(): array
    {
	    $path['profile'] = [
	        'admin'=> [
	            'path'=>'assets/file/dashboard/image/profile',
	            'size'=>'400x400'
	        ],
	        'user'=> [
	            'path'=>'assets/file/images/user/profile',
	            'size'=>'400x400'
        	],
	    ];
        $path['import'] = [
            'path'=>'assets/file/import',
        ];
	    $path['payment_file'] = [
	        'path' => 'assets/file/payment/data',
	    ];
	    $path['email_uploaded_file'] = [
	        'path' => 'assets/file/email_uploaded_file',
	    ];
	    $path['payment_method'] = [
            'path'=>'assets/file/images/payment_method',
            'size'=>'600x600'
	    ];
	    $path['panel_logo'] = [
	        'path' => 'assets/file/images/logoIcon',
			'size'=>'1200x400'
	    ];
	    $path['site_logo'] = [
	        'path' => 'assets/file/images/logoIcon',

	    ];
	    $path['admin_bg'] = [
	        'path' => 'assets/file/images/adminBg',
	    ];
	    $path['admin_card'] = [
	        'path' => 'assets/file/images/adminCard',
	    ];
        $path['frontend'] = [
            'path' => 'assets/file/images/frontend',
        ];
	    $path['ticket'] = [
	        'path' => 'assets/file/ticket',
	    ];
	    $path['favicon'] = [
	        'size' => '128x128',
	    ];
	    $path['site_icon'] = [
	        'size' => '100x100',
	    ];
	    $path['demo'] = [
            'path'=>'assets/file/sms',
            'path_email'=>'assets/file/email',
            'path_whatsapp'=>'assets/file/whatsapp',
	    ];
		$path['whatsapp'] = [
            'path_document'=>'assets/file/whatsapp/document',
            'path_audio'=>'assets/file/whatsapp/audio',
            'path_image'=>'assets/file/whatsapp/image',
            'path_video'=>'assets/file/whatsapp/video',
	    ];
	    return $path;
	}

	function menuActive($routeName, $type = null): string
    {
		if (is_array($routeName) &&  in_array(Route::currentRouteName(), $routeName)) {
			return 'active';
		} else {
			if (request()->routeIs($routeName)) {
				return 'active';
			}
		}
		return '';
	}

	function sidebarMenuActive($routeName)
	{

	}


	function shortAmount($amount, $length = 2)
    {
        return round($amount, $length);
	}

	function diffForHumans($date): string
    {
	    return Carbon::parse($date)->diffForHumans();
	}


	function getDateTime($date, $format = 'Y-m-d h:i A')
	{
	    return Carbon::parse($date)->translatedFormat($format);
	}

	function slug($name): string
    {
	   	return Str::slug($name);
	}

	function trxNumber(): string
    {
		$random = strtoupper(Str::random(10));
		return $random;
	}

	function randomNumber(): int
    {
		return mt_rand(1,10000000);
	}

	function uploadNewFile($file, $location, $old = null): string
    {
	   	if(!file_exists($location)){
			mkdir($location, 0777, true);
		}
	    if(!$location) throw new Exception('File could not been created.');
	    if ($old) {
	    	if(file_exists($location.'/'.$old) && is_file($location.'/'.$old)){
				@unlink($old.'/'.$old);
			}
	    }
	    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
	    $file->move($location,$filename);
	    return $filename;
	}

	function showImage($image, $size=null): string
    {

	    if(file_exists($image) && is_file($image)){

	        return asset($image);
	    }
	    // if($size){
	    //     return route('default.image',$size);
	    // }
	   	return (asset('assets/file/default.jpg'));
	}

	function number($amount, $length = 2)
    {
	    $amount = round($amount, $length);
	    return $amount;
	}

	function textSorted($text): string
    {
	    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
	}

	function limit($text, $length): string
    {
		$value = Str::limit($text, $length);
		return $value;
	}

	function serverExtensionCheck($name): bool
    {
        if (!extension_loaded($name)) {
            return $response = false;
        }else {
            return $response = true;
        }
    }

	function checkFolderPermission($name): bool
    {
		$perm = substr(sprintf('%o', fileperms($name)), -4);
		if ($perm >= '0775') {
			$response = true;
		} else {
			$response = false;
		}
		return $response;
	}

	function  charactersLeft()
	{
		$user = auth()->user();
		return $user->credit * 160;
	}

	function  charactersLeftWa()
	{
		$user = auth()->user();
		return $user->whatsapp_credit * 320;
	}


	function curlContent($url): bool|string
    {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $result = curl_exec($ch);
	    curl_close($ch);
	    return $result;
	}


	function labelName($text): string
    {
	    return ucfirst(preg_replace("/[^A-Za-z0-9 ]/", ' ', $text));
	}


	function uploadImage($file, $location, $size = null, $old = null, $thumb = null): string
    {
	    if(!file_exists($location)){
			mkdir($location, 0755, true);
		}
		if($old){
			if(file_exists($location.'/'.$old) && is_file($location.'/'.$old)){
				@unlink($location.'/'.$old);
			}
		}
	    $filename = uniqid() . time() . '.' . $file->getClientOriginalExtension();
	    $image = Image::make($file);
	    if ($size) {
	        $size = explode('x', strtolower($size));
	        $image->resize($size[0], $size[1]);
	    }
	    $image->save($location . '/' . $filename);
	    if ($thumb) {
	        $thumb = explode('x', $thumb);
	        Image::make($file)->resize($thumb[0], $thumb[1])->save($location . '/thumb_' . $filename);
	    }
	    return $filename;
	}

	if (!function_exists('get_status_bg')) {
        function get_status_bg($status)
        {
            $status = strtolower($status);
            switch ($status) {
                case 'all':
                    $value = "<span class=\"badge badge-soft-all align-middle\">
                                <i class=\"bi bi-check-circle me-1\"></i> All
                              </span>";
                    return $value;
                    break;
                case ($status == 'success' || $status == 'completed' ):
                    $status = ucFirst($status);
                    $value = "<span class=\"badge badge-soft-success align-middle\">
                                <i class=\"bi bi-check-circle me-1\"></i> $status
                              </span>";
                    return $value;
                    break;
                case ($status == 'active' || $status == 'yes' ) :
                    $status = ucFirst($status);
                    $value = "<span class=\"badge badge-soft-success align-middle\">
                                <i class=\"bi bi-check-circle me-1\"></i>    $status
                              </span>";
                    return $value;
                    break;
                case 'pending':
                    $value = "<span class=\"badge badge-soft-warning align-middle\">
                                <i class=\"bi bi-check2-all me-1\"></i> Pending
                              </span>";
                    return $value;
                    break;
                case ($status == 'processing' || $status == 'ongoing' ):
                    $status = ucFirst($status);
                    $value = "<span class=\"badge badge-soft-info align-middle\">
                                <i class=\"bi bi-capslock me-1\"></i> $status
                              </span>";
                    return $value;
                    break;
                case ($status == 'failed' || $status == 'fail' || $status == 'no' ):
                    $status = ucFirst($status);
                    $value = "<span class=\"badge badge-soft-danger align-middle\">
                                <i class=\"bi bi-exclamation-octagon me-1\"></i>  $status
                              </span>";
                    return $value;
                    break;

                case  'schedule':
                    $status = ucFirst($status);


                    $value = "<span class=\"badge badge-soft-danger align-middle\">
                                <i class=\"bi bi-exclamation-octagon me-1\"></i> $status
                                </span>";
                    return $value;
                    break;

                case  'deactive':
                    $status = ucFirst($status);


                    $value = "<span class=\"badge badge-soft-danger align-middle\">
                                <i class=\"bi bi-exclamation-octagon me-1\"></i> Inactive
                              </span>";
                    return $value;
                    break;

                default:
                    $value = "<span class=\"badge badge-soft-secondary align-middle\">
                                <i class=\"bi bi-exclamation-triangle me-1\"></i> Undefined
                              </span>";
                    return $value;
                    break;
            }
        }
    }


	/**
     * current months total day
     */
    function days_in_month($month,$year){
		return cal_days_in_month(CAL_GREGORIAN, $month,$year);
	}

	 /**
	  * current months total day
	  */
	  function days_in_year(){
		 $year = date("Y");
		 $days=0;
		 for($month=1;$month<=12;$month++){
			 $days = $days + days_in_month($month,$year );
		 }
		 return $days;
	  }


	function buildDomDocument($text)
	{
	    $dom = new \DOMDocument();
	    libxml_use_internal_errors(true);
	    $dom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $text);
	    libxml_use_internal_errors(false);
	    $imageFile = $dom->getElementsByTagName('img');
        if ($imageFile) {
            foreach($imageFile as $item => $image){
                $data = $image->getAttribute('src');
                $check_b64_data = preg_match("/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).base64,.*/", $data);
                if ($check_b64_data) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $imgeData = base64_decode($data);
                    $image_name= time().$item.'.png';
                    $save_path       = filePath()['email_uploaded_file']['path'];
                    try {
						if (!file_exists($save_path)) {
							mkdir($save_path, 0777, true);
						}
                        Image::make($imgeData)->save($save_path.'/'.$image_name);
                        $getpath = asset('assets/file/email_uploaded_file/'.$image_name);
                        $image->removeAttribute('src');
                        $image->setAttribute('src', $getpath);
                    } catch (Exception $e) {

                    }
                }
            }
        }
	    $html = $dom->saveHTML();

		$html = html_entity_decode($html, ENT_COMPAT, 'UTF-8');
	    return $html;
	}


	if (!function_exists('carbon')) {
		/**
		 * @param string|null $date
		 * @return Carbon
		 */
		function carbon(string $date = null): Carbon
		{
			if (!$date) {
				return Carbon::now();
			}

			return (new Carbon($date));
		}
	}

    if (!function_exists('translate')) {

        /**
         * @param $keyWord
         * @param $langCode
         * @return mixed
         */
        function translate($keyWord, $langCode = null): mixed
        {

            if (!$keyWord) {
                return "";
            }
            try {
                if ($langCode == null) {
                    $langCode = App::getLocale();
                    if ($langCode == 'En') {
                        $langCode = 'en';
                    }
                }
                $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($keyWord)));
                if ($langCode) {
                    $localeTranslateData = file_get_contents(resource_path(config('constants.options.langFilePath')) . $langCode . '.json');
                    $localeTranslateDataArray = json_decode($localeTranslateData, true);
                    if (is_array($localeTranslateDataArray)) {
                        if (!array_key_exists($lang_key, $localeTranslateDataArray)) {
                            $localeTranslateDataArray[$lang_key] = $keyWord;
                            $path = resource_path(config('constants.options.langFilePath')) . $langCode . '.json';
                            File::put($path, json_encode($localeTranslateDataArray));
                        }
                        $data = $localeTranslateDataArray[$lang_key];
                    } else {
                        $data = $keyWord;
                    }
                }
            } catch (\Exception $ex) {
                $data = $keyWord;
            }
            return $data;
        }
    }


/**
 * @param $langCode
 * @return bool|string
 */
    function getLangFile($langCode): bool|string
    {
        return file_get_contents(resource_path(config('constants.options.langFilePath')). $langCode.'.json');
    }


    /**
     *
     */
    function offensiveMsgBlock($requestMessage)
	{
		$path = base_path('lang/globalworld/offensive.json');
        $offensiveData = json_decode(file_get_contents($path), true);
		$message = explode(' ', $requestMessage);
		foreach ($offensiveData as $key => $value) {
			foreach($message as $msgKey => $item){
				if(strtolower($item) == strtolower($key)){
					$message[$msgKey] = $value;
					Session::put('offsensiveNotify', "& We found some offsensive word");
				}
			}
		}
		$message = implode(' ',$message);

		return $message;
	}

    function download_from_url(string $url, string $prefix = ''): ?string
    {
        if (! $stream = @fopen($url, 'r')) {
            throw new \Exception('Can not open file from ' . $url);
        }

        $tempFile = tempnam(sys_get_temp_dir(), $prefix);

        if (file_put_contents($tempFile, $stream)) {
            return $tempFile;
        }

        return null;
    }

	function logStatus($status)
	{
        switch ($status) {
            case 1:
                $status = 'Pending';
                break;
            case 3:
                $status = 'Fail';
                break;
			case 4:
				$status = 'Success';
				break;
            default:
                $status = 'Schedule';
                break;
        }
	    return $status;
	}



    function convertTime($seconds): string
    {
		$hours = floor($seconds / 3600);
		$minutes = floor(($seconds % 3600) / 60);
		$seconds = $seconds % 60;

		$result = '';

		if ($hours > 0) {
		    $result .= $hours . ' hour';
		    if ($hours > 1) {
		      $result .= 's';
		    }
		    $result .= ' ';
		}

		if ($minutes > 0) {
		    $result .= $minutes . ' minute';
		    if ($minutes > 1) {
		      $result .= 's';
		    }
		    $result .= ' ';
		}

		if ($seconds > 0) {
		    $result .= $seconds . ' second';
		    if ($seconds > 1) {
		      $result .= 's';
		    }
		}

		return $result;
	}


    function getFrontendSection($default = false)
    {
        $jsonUrl = resource_path('data/frontend_section.json');
        $sections = json_decode(file_get_contents($jsonUrl), true);

        if ($default) {
            ksort($sections);
        }

        return $sections;
    }


    function setInputLabel(string $text): string
    {
        $text = preg_replace('/[^A-Za-z0-9 ]/', ' ', $text);
        return ucfirst($text);
    }

    function getArrayValue($arr,  $key ="", $default = [])
    {
        return \Illuminate\Support\Arr::get((array)$arr, $key, '');
    }
	if (!function_exists('str_unique')) {
        /**
         * @param int $length
         * @return string
         */
        function str_unique(int $length = 30): string
        {
            $side = rand(0,1);
            $salt = rand(0,9);
            $len = $length - 1;
            $string = \Illuminate\Support\Str::random($len <= 0 ? 7 : $len);
            $separatorPos = (int) ceil($length/4);
            $string = $side === 0 ? ($salt . $string) : ($string . $salt);
            $string = substr_replace($string, '-', $separatorPos, 0);
            return substr_replace($string, '-', negative_value($separatorPos), 0);
        }
    }
	if (!function_exists('negative_value')) {
        /**
         * @param int|float $value
         * @param $float
         * @return int|float
         */
        function negative_value(int|float $value, $float = false): int|float
        {
            if ($float) {
                $value = (float) $value;
            }
            return 0 - abs($value);
        }
    }

	if(!function_exists('convert_unit')) {

		/**
         * @param int|float $value
         * @param $float
         * @return string
         */

		 function convert_unit(int|float $bytes, $decimals = 2) {
			$size = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

			$factor = floor((strlen($bytes) - 1) / 3);

			return sprintf("%.{$decimals}f", $bytes / (1024 ** $factor)) . @$size[$factor];
		}
	}

	if(!function_exists('planAccess')) {

		/**
         * @param mixed $user
         * @return mixed
         */

		function planAccess(mixed $user) {

			$plan_type = [
				"user"  => PricingPlan::USER,
				"admin" => PricingPlan::ADMIN
			];

			$gateway_type = array_keys(config("planaccess.pricing_plan"));
			$user_plan = $user->runningSubscription()->currentPlan();
			$allowed_access = [];
			$allowed_access["type"] = $user_plan->type;

			foreach((array)$gateway_type as $gateway) {

				$gateway_info = (array)$user_plan->$gateway;


				if(array_key_exists("android", $gateway_info)){

					$android_data = (array)$gateway_info["android"];
					if($allowed_access["type"] == PricingPlan::ADMIN) {
						unset($android_data["gateway_limit"]);
					}
					$allowed_access["android"] = $android_data;
					unset($gateway_info["android"]);

				}

				unset($gateway_info["credits"]);
				$allowed_access[$gateway] = $gateway_info;
			}
			return $allowed_access;
		}
	}

	if (!function_exists('code_correction')){
		function code_correction(string $code):string
		{
			if(!stripos($code, "#")) {
				$code = "#".$code;
			}

			return  "$code";
		}
	}


	if (!function_exists('getTimezone')){
        function getTimezone($city)
        {
            $jsonData = file_get_contents(resource_path('data/cityMap.json'));
            $data = json_decode($jsonData, true);
            $timezone = null;

            foreach ($data as $cityData) {
                if ($cityData["city"] === $city) {
                    $timezone = $cityData["timezone"];
                    break;
                }
            }

            if ($timezone !== null) {
                $return = $timezone;
            } else {
                $return = 'Asia/Jakarta';
            }

            return $return;
        }
    }
