<?php

namespace AuthDoctrine\Controller;

use Application\Controller\BaseController as BaseController;

use Blog\Entity\User;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Authentication\Result;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $em = $this->getEntityManager();
        $user = $em->getRepository('Blog\Entity\User')->findAll();

        return array('users' => $user);
    }

    public function loginAction(){
        $em = $this->getEntityManager();
        $user = new User();
        $form = $this->getLoginForm($user);

        $messages = null;

        $request = $this->getRequest();

        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
                $user = $form->getData();
                $authResult = $em->getRepository('Blog\Entity\User')->login($user, $this->getServiceLocator());
                if($authResult->getCode() != Result::SUCCESS){
                    foreach($authResult->getMessages() as $message){
                        $messages .= "$message\n";
                    }
                }else{
                    return array();
                }
            }
        }

        return array(
            'form' => $form,
            'messages' => $messages,
        );
    }
}
