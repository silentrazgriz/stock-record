<?php
/**
 * Created by PhpStorm.
 * User: WDD
 * Date: 23/10/2017
 * Time: 19:04
 */

namespace App\Http\Requests;

use App\Utilities\JsonUtil;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function response(array $errors)
    {
        $messages = array();

        foreach ($errors as $error) {
            if (is_array($error)) {
                foreach ($error as $message) {
                    array_push($messages, $message);
                }
            } else {
                array_push($messages, $error);
            }
        }

        return JsonUtil::error($messages);
    }

    public function formatErrors(Validator $validator)
    {
        return $validator->errors()->getMessages();
    }

    public function failedValidation(Validator $validator)
    {
        throw (new HttpResponseException($this->response(
            $this->formatErrors($validator)
        )));
    }
}