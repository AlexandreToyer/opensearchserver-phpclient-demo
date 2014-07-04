<?php
namespace OssPortal;

class OssHelper {
    
    static function getListOfIndexes($handler) {
        $request = new \OpenSearchServer\Index\GetList();
        $list = $handler->submit($request);
        return $list;
    }

    static function getNumberOfIndexes($handler) {
        $list = self::getListOfIndexes($handler);
        return self::getNumberOfValuesInTraversable($list);       
    }
    
    static function getNumberOfValuesInTraversable($traversable) {
        if($traversable instanceof Traversable) {
            $count = iterator_count ($traversable);
            $traversable->rewind();
        } else {
            $count = 0;
        }  
        return $count;        
    }
    
    static function runSearch($handler, $options) {

    }
    
    static function returnJsonResponseParsed($app, $response, $handler) {
        return $app->json(
                array(
                    'requestURL' => $handler->getLastRequest()->getResource(),         
					'success' => $response->isSuccess(),
                    'info' => $response->getInfo()
                ), 200);
    }
}