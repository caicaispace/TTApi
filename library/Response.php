<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/19
 * Time: 22:43
 */

namespace Library;

use Phalcon\Http\Response as PhalconResponse;

class Response extends PhalconResponse
{
    private $uniqueId = null;
    private $rowData = null;
    private $listData = null;
    private $fieldsMap = null;
    private $page = null;
    private $message = '操作成功';
    private $timestamp = null;

    protected static $instance;
    static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function __construct($content = null, $code = null, $status = null)
    {
        parent::__construct($content, $code, $status);
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @param $row
     * @return $this
     */
    public function setRowData($row)
    {
        $this->rowData = $row;
        return $this;
    }

    /**
     * @param $list
     * @return $this
     */
    public function setListData($list)
    {
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
     * @return $this
     */
    public function setTimestamp()
    {
        $this->timestamp = time();
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
        $this->setTimestamp();
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
            return parent::getStatusCode();
        }
    }

    private function extendedContent()
    {
        $this->setTimestamp();
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

    public function send()
    {
        $this->extendedContent();
        if (FALSE) {
            // TODO: fpm 模式
            return parent::send();
        }
        $this->sendHeaders();
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