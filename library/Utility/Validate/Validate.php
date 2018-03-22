<?php

namespace Library\Utility\Validate;


use Library\Component\Spl\SplArray;

class Validate
{
    protected $map = array();
    function addField($field){
        if(isset($this->map[$field])){
            $instance = $this->map[$field];
        }else{
            $instance = new Field();
            $this->map[$field] = $instance;
        }
        return $instance;
    }

    function validate(array $data){
        $error = array();
        $data = new SplArray($data);
        foreach ($this->map as $filed => $fieldInstance){
            $rules = $fieldInstance->getRule();
            $msg = $fieldInstance->getMsg();
            if(isset($rules[Rule::OPTIONAL]) && empty($data->get($filed))){
                continue;
            }else{
                foreach ($rules as $rule => $args){
                    if(!Func::$rule($filed,$data,$args)){
                        $error[$filed][$rule] = isset($msg[$rule]) ? $msg[$rule] :  $msg['__default__'];
                    }
                }
            }
        }
        return new Message($error);
    }
}