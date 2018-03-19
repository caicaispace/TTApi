<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/19
 * Time: 22:43
 */

namespace Library;

use Phalcon\Http\Response;

class JSONResponse extends Response
{
    protected static $instance;
    static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function send()
    {
        $this->sendHeaders();
		$this->sendCookies();
		/**
         * Output the response body
         */
		$content = $this->_content;
		if ($content != null) {
            echo $content;
        } else {
            $file = $this->_file;
			if (is_string($file) && strlen($file)) {
                readfile($file);
			}
		}
		return $this;
    }
}