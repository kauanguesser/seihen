<?php

namespace Seihen\Rules\POST\Blocking;

use Seihen\Rules\POST\PostRule;
use Seihen\HTTP\Response;

class PostBlocking extends PostRule{
    /**
     * @return boolean
     */
    public function run() {
        if( isset($_POST) ){
            foreach($_POST as $post){
                $result = preg_match($this->getPattern(), $post);

                if( $result == 1 ){
                    Response::badRequest();
                } elseif( $result === false ){
                    throw new \RuntimeException('Syntax error in pattern definition');
                }
            }
        } else {
            Response::badRequest();
        }

        return true;
    }
}