<?php
/**
 * global helpers
 *
 */

use App\Lib\MyHelper;
use Illuminate\Support\Facades\Crypt;

if (! function_exists('adminFeature')) {
	/**
	 * for check admin feature
	 * @param  string $url
	 * @param  array $data
	 * @return array
	 */
    function adminFeature($granted) {
        return MyHelper::hasAccess($granted,session('granted_features'));
    }
}

if (! function_exists('validateRequest')) {
	/**
	 * for validation all request
	 * @param  string $url
	 * @param  array $data
	 * @return array
	 */
    function validateRequest($request, $validation) {
        $validator = Validator::make($request, $validation);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->all());
        }
    }
}

if (! function_exists('encSlug')) {
	/**
	 * for encript id slug
	 * @param  string $url
	 * @param  array $data
	 * @return array
	 */
    function encSlug($data) {
        return MyHelper::encSlug($data);
    }
}

if (! function_exists('decSlug')) {
	/**
	 * for decript id slug
	 * @param  string $url
	 * @param  array $data
	 * @return array
	 */
    function decSlug($data) {
        return MyHelper::decSlug($data);
    }
}

if (! function_exists('tgl_indo')) {
	function tgl_indo($tanggal, $type='date'){
		return MyHelper::tgl_indo($tanggal, $type);
	}
}


if (! function_exists('IDR')) {
	function IDR($price){
		return MyHelper::IDR($price);
	}
}

if(! function_exists('evo_encrypt')){
    function evo_encrypt($string){
        return Crypt::encryptString($string);
    }
}

if(! function_exists('evo_decrypt')){
    function evo_decrypt($string){
        return Crypt::decryptString($string);
    }
}

