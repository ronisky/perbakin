<?php

/**
 * Data Helpers
 *
 *
 */

namespace App\Helpers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Modules\Users\Repositories\UsersRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DataHelper
{

    /**
     * Normalize params
     *
     * @param
     * - params  : all requert param
     * - created : true (add created at and by), false
     * - updated : true (add updated at and by), false
     * - deleted : true (add deleted at and by), false
     *
     * @return (array)
     *
     */
    public static function _normalizeParams($params, $created = false, $updated = false, $isNested = false, $deleted = false, $createdFromHome = false)
    {
        $return = array();

        foreach ($params as $key => $value) {
            if ($key == '_token') continue;

            if ($key == 'password' || $key == 'user_password') {
                $return[$key] = Hash::make($value);
            } else {
                $return[$key] = $value;
            }
        }

        if ($created) {
            $return['created_at'] = date('Y-m-d H:i:s');
            $return['created_by'] = Auth::user()->user_id;
        }

        if ($updated) {
            $return['updated_at'] = date('Y-m-d H:i:s');
            $return['updated_by'] = Auth::user()->user_id;
        }

        if ($isNested) {

            for ($i = 0; $i < count($params); $i++) {

                $compact[key($params)] = array_merge($params[key($params)], $return);
                next($params);
            }

            return $compact;
        }

        if ($deleted) {
            $return['deleted_at'] = date('Y-m-d H:i:s');
            $return['deleted_by'] = Auth::user()->user_id;
        }

        if ($createdFromHome) {
            $return['created_at'] = date('Y-m-d H:i:s');
            $return['created_by'] = 5;
        }

        return $return;
    }

    /**
     * Message of form rules
     *
     * @return (array)
     *
     */
    public static function _rulesMessage()
    {

        $message = array(
            'required'    => ':attribute tidak boleh kosong',
            'email'        => ':attribute tidak sesuai format',
            'unique'    => ':attribute sudah digunakan'
        );

        return $message;
    }

    // Response Formatter
    /**
     * Success Response
     * @param data response default null
     * @param message response default null
     * @return (json)
     *
     */
    public static function _successResponse($data = null, $message = null)
    {
        $response = [
            'status'     => 1,
            'message'    => $message,
            'result'    => $data,
            'time'        => date('Y-m-d H:i:s')
        ];

        return response()->json($response);
    }

    /**
     * Error Response
     * @param data response default null
     * @param message response default null
     * @return (json)
     *
     */
    public static function _errorResponse($data = null, $message = null)
    {
        $response = [
            'status'     => 0,
            'message'    => $message,
            'result'    => $data,
            'time'        => date('Y-m-d H:i:s')
        ];

        return response()->json($response);
    }
    // End Response Formatter

    // file upload

    /**
     * Get uploaded file's name.
     *
     * @param UploadedFile $file
     *
     * @return null|string
     */
    public static function getFileName(UploadedFile $file)
    {
        $filename = preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $filename = 'data_' . md5(Auth::user()->user_id) . '_' . round(microtime(true) * 1000) .  '.' . pathinfo($filename, PATHINFO_EXTENSION);
        return $filename;
    }

    /**
     * Get uploaded path.
     *
     * @param Path $file
     *
     * @return null|string
     */
    public static function getFilePath($filepath = false, $imagespath = false, $letterpath = false)
    {

        if ($filepath) {
            $path = 'uploads/files/';
        }

        if ($imagespath) {
            $path = 'uploads/images/';
        }

        if ($letterpath) {
            $path = 'uploads/letters/';
        }
        return $path;
    }

    /**
     * File Path
     * @param int $id
     */
    public static function _filePath($id = '')
    {
        if ($id == '') {
            return self::getFilePath(true);
        } else {
            return 'public/' . self::getFilePath(true);
        }
    }

    /**
     * validation of form rules file
     *
     * @return (array)
     *
     */
    public static function _rulesFile($fileDoc = false, $image = false)
    {
        $fileDocSize = '2048';
        $imageSize = '2048';

        if ($fileDoc) {
            $rule = 'required|unique:files|mimes:pdf,doc,docx|max:"' . $fileDocSize . '"';
        }

        if ($image) {
            $rule = 'required|unique:files|mimes:jpg,jpeg,png,bmp,gif|max:"' . $imageSize . '"';
        }

        return $rule;
    }


    /**
     *
     * - created : true (add created at and by), false
     * - updated : true (add updated at and by), false
     * - deleted : true (add deleted at and by), false
     *
     * @return (array)
     *
     */
    public static function _signParams($created = false, $updated = false, $deleted = false)
    {
        $return = array();

        if ($created) {
            $return['created_at'] = date('Y-m-d H:i:s');
            $return['created_by'] = Auth::user()->user_id;
        }

        if ($updated) {
            $return['updated_at'] = date('Y-m-d H:i:s');
            $return['updated_by'] = Auth::user()->user_id;
        }

        if ($deleted) {
            $return['deleted_at'] = date('Y-m-d H:i:s');
            $return['deleted_by'] = Auth::user()->user_id;
        }

        return $return;
    }

    // end file upload

    public static function getUserLogin()
    {
        $_sysUserRepository = new UsersRepository;

        return $_sysUserRepository->getById(Auth::user()->user_id);
    }
}
