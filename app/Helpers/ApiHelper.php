<?php

/**
 * :: Helper File ::
 * USed for manage all kind of helper functions.
 *
 **/

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

function lang($path = null, $string = null)
{
	$lang = $path;
	if (trim($path) != '' && trim($string) == '') {
		$lang = \Lang::get($path);
	} elseif (trim($path) != '' && trim($string) != '') {
		$lang = \Lang::get($path, ['attribute' => $string]);
	}
	return $lang;
}
/**
 * @param bool $status
 * @param int $statusCode
 * @param string $message
 * @param array $result
 *
 * @return \Illuminate\Http\JsonResponse
 */
function apiResponse($status, $statusCode, $message, $errors = [], $data = [])
{
	$response = ['success' => $status, 'status' => $statusCode];
	
	if ($message != "") {
		$response['message']['success'] = $message;
	}

	if (count($errors) > 0) {
		$response['message']['errors'] = $errors;
	}

	if (count($data) > 0) {
		$response['message']['data'] = $data;
	}
	return response()->json($response);
}


/**
 * @param bool $status
 * @param int $statusCode
 * @param string $message
 * @param string $url
 * @param array $errors
 * @return \Illuminate\Http\JsonResponse
 * @internal param array $result
 *
 */
function validationResponse($status, $statusCode, $message = null, $url = null, $errors = [])
{
	$response = ['success' => $status, 'status' => $statusCode];

	if ($message != "") {
		$response['message'] = $message;
	}

	if ($url != "") {
		$response['url'] = $url;
	}

	if (count($errors) > 0) {
		$response['errors'] = errorMessages($errors);
	}
	return response()->json($response, $statusCode);
}

/**
 * @param array $errors
 * @return array
 */
function errorMessages($errors = [])
{
	$error = [];
	foreach($errors->toArray() as $key => $value) {
		foreach($value as $messages) {
			$error[$key] = $messages;
		}
	}
	return $error;
}
