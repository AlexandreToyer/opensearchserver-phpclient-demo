<?php
namespace OssPortal\Controllers;

use OssPortal\OssHelper;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Indexes {
    
    /**
     * List existing index, display forms to create an index and to delete one 
     */
    public function route_indexes(Request $request, Application $app) {
        //get list of indexes
        $list = OssHelper::getListOfIndexes($app['oss.handler']);
        
        $formCreate = $this->makeCreateForm($request, $app);
        $formDelete = $this->makeDeleteForm($request, $app);
        $formCheck = $this->makeCheckForm($request, $app);
        
        return $app['twig']->render('indexes.twig', array(
            'indexesList' => iterator_to_array($list),
            'formCreate' => $formCreate->createView(),
            'formDelete' => $formDelete->createView(),
            'formExists' => $formCheck->createView()
        ));
    }

    /**
     * Create a new index 
     */
    public function route_newIndex(Request $request, Application $app) {
        $form = $this->makeCreateForm($request, $app);
        $data = $form->getData();
        //create request
        $request = new \OpenSearchServer\Index\Create();
        //set name of new index
        $request->index($data['name']);
        //set type of new index if needed
        if(!empty($data['type'])) {
            $request->template($data['type']);
        }
        $response = $app['oss.handler']->submit($request);
        
        return OssHelper::returnJsonResponseParsed($app, $response, $app['oss.handler']);
    }

    /**
     * Delete an index 
     */
    public function route_deleteIndex(Request $request, Application $app) {
        $form = $this->makeDeleteForm($request, $app);
        $data = $form->getData();
        //create request
        $request = new \OpenSearchServer\Index\Delete();
        //set name of index to delete
        $request->index($data['name']);
        $response = $app['oss.handler']->submit($request);
        
        return OssHelper::returnJsonResponseParsed($app, $response, $app['oss.handler']);
    }
    
    /**
     * Check if an index exists 
     */
    public function route_checkIndex(Request $request, Application $app) {
        $form = $this->makeCheckForm($request, $app);
        $data = $form->getData();
        //create request
        $request = new \OpenSearchServer\Index\Exists();
        //set name of index
        $request->index($data['name']);
        $response = $app['oss.handler']->submit($request);
        
        return OssHelper::returnJsonResponseParsed($app, $response, $app['oss.handler']);
    }
    

    
    private function makeCreateForm($request, $app) {
        //create form to create an index
	   	$form = $app['form.factory']->createBuilder('form', array())
	   								->add('name', 'text')
	   								->add('type', 'choice', array(
	   									'choices' => array(
	   								        \OpenSearchServer\Request::TEMPLATE_WEB_CRAWLER => 'WEB_CRAWLER',
	   								        \OpenSearchServer\Request::TEMPLATE_FILE_CRAWLER => 'FILE_CRAWLER',
	   								    ),
	   								    'required'=> false,
    									'empty_value' => 'No template',
	   								))
        							->getForm();
        
    	$form->handleRequest($request);
    	return $form;
    }
    
    private function makeDeleteForm($request, $app) {
        //create form to delete an index
	   	$form = $app['form.factory']->createBuilder('form', array())
	   								->add('name', 'text')
        							->getForm();
        
    	$form->handleRequest($request);
    	return $form;
    }
    
    private function makeCheckForm($request, $app) {
        //create form to check if an index exists
	   	$form = $app['form.factory']->createBuilder('form', array())
	   								->add('name', 'text')
        							->getForm();
        
    	$form->handleRequest($request);
    	return $form;
    }
}