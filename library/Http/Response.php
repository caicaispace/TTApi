<?php

namespace Library\Http;

use Phalcon\Http\Response as PhalconResponse;

class Response extends PhalconResponse
{
    // Swoole
    const STATUS_NOT_END = 0;
    const STATUS_LOGICAL_END = 1;
    const STATUS_REAL_END = 2;
    private $swoole_http_response = null;
    private $isEndResponse = 0;//1 逻辑end  2真实end

    // Response
    private $uniqueId = null;
    private $rowData = null;
    private $listData = null;
    private $fieldsMap = null;
    private $page = null;
    private $message = '操作成功';
    private $timestamp = null;


    protected static $instance;
    static function getInstance(\swoole_http_response $response = null, ...$ags){
        if($response !== null AND PHP_SAPI === 'cli'){
            self::$instance = new static($response, $ags);
        }elseif(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function __construct(\swoole_http_response $response = null, $content = null, $code = null, $status = null)
    {
        $this->swoole_http_response = $response;
        parent::__construct($content, $code, $status);
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return null
     */
    public function getSwooleHttpResponse()
    {
        return $this->swoole_http_response;
    }

    /**
     * @param $row
     * @return $this
     */
    public function setRowData($row)
    {
        $this->listData = null;
        $this->rowData = $row;
        return $this;
    }

    /**
     * @param $list
     * @return $this
     */
    public function setListData($list)
    {
        $this->rowData = null;
        $this->listData = $list;
        return $this;
    }

    /**
     * array('current'=>1,'total_items'=>10);
     * @param $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @param $fields
     * @return $this
     */
    public function setFieldsMap($fields)
    {
        $this->fieldsMap = $fields;
        return $this;
    }

    /**
     * @return null
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return $this
     */
    public function resetTimestamp()
    {
        $this->timestamp = time();
        return $this;
    }

    /**
     * @param string $message
     * @return Response|PhalconResponse
     */
    public function success($message = '操作成功！')
    {
        $this->setMessage($message);
        return $this->send();
    }

    /**
     * @param string $message
     * @param int $code
     * @return Response|PhalconResponse
     */
    public function error($message = '操作失败', $code = 400)
    {
        $this->setMessage($message);
        $this->setStatusCode($code);
        return $this->send();
    }

    public function getStatusCode()
    {
        if (NULL === $code = parent::getStatusCode()) {
            return 200;
        } else {
            return $code;
        }
    }

    public function send()
    {
        $this->extendedContent();
        if (PHP_SAPI === 'cli') {
            $this->sendHeaders();
            /**
             * Output the response body
             */
            $content = $this->_content;
            if ($content != null) {
                $this->resetHandle();
                echo $content;
            } else {
                $file = $this->_file;
                if (is_string($file) && strlen($file)) {
                    readfile($file);
                }
            }
            return $this;
        }
        return parent::send();
    }

    public function end($realEnd = false)
    {
        if($this->isEndResponse == self::STATUS_NOT_END){
            $this->isEndResponse = self::STATUS_LOGICAL_END;
        }
        if($realEnd === true && $this->isEndResponse !== self::STATUS_REAL_END){
            $this->isEndResponse = self::STATUS_REAL_END;
            //结束处理
            $status = $this->getStatusCode();
//            echo 'status' . $status . PHP_EOL;
            $this->swoole_http_response->status($status);
            $headers = $this->getHeaders()->toArray();
            foreach ($headers as $header => $val){
                $this->swoole_http_response->header($header,$val);
            }
//            $cookies = $this->getCookies();
//            var_dump($cookies);
//            foreach ($cookies as $cookie){
//                $this->swoole_http_response->cookie($cookie->getName(),$cookie->getValue(),$cookie->getExpire(),$cookie->getPath(),$cookie->getDomain(),$cookie->getSecure(),$cookie->getHttponly());
//            }
            $write = $this->getContent();
            if(!empty($write)){
                $this->swoole_http_response->write($write);
            }
            $this->swoole_http_response->end();
        }
    }

    private function resetHandle()
    {
        $this->isEndResponse = 0;//1 逻辑end  2真实end
        //
        $this->uniqueId = null;
        $this->rowData = null;
        $this->listData = null;
        $this->fieldsMap = null;
        $this->page = null;
        $this->message = '操作成功';
        $this->timestamp = null;
        $this->resetTimestamp();
    }

    function isEndResponse()
    {
        return $this->isEndResponse;
    }

    private function extendedContent()
    {
        $content = array(
            'info' => $this->rowData,
            'list' => $this->listData,
            'page' => $this->page,
            'options' => array(
                'uniqueId' => $this->uniqueId,
                'fields'   => $this->fieldsMap,
            ),
            'code' => $this->getStatusCode(),
            'message' => $this->message,
            'timestamp' => $this->timestamp,
        );
        parent::setJsonContent($content);
    }
}