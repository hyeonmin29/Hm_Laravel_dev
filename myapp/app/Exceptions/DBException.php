<?php
namespace App\Exception;

use Exception;
use Log;

class DBException extends Exception
{
    public $message;
    public $code;
    public $file;
    public $line;

    public function __contruct($errMessage = '', $errCode, $moveURL = null)
    {
        $this->message = $errMessage;
        $this->code = $errCode;
        $this->moveURL = $moveURL;

        $rgClassName = explode("\\", __CLASS__);
        # 마지막 원소를 빼내어 반환하는 php 함수, 비어있으면 null, 배열 아니면 경고 발생
        $strClassName = array_pop($rgClassName);
        Log::error("[" . $strClassName . "][" . $this->message . "][" . $this->code . "][" . $this->moveURL . "] File : " . $this->file . "(" . $this->line . ")");
    }


}