<?php

namespace Blog\Controller;

//use Zend\Mvc\Controller\AbstractActionController;
//use Zend\View\Model\ViewModel;

use Application\Controller\BaseController as BaseController;

use Blog\Entity\Comment;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Json\Json;
use Zend\Paginator\Paginator;

use DoctrineORMModule\Form\Annotation\AnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class IndexController extends BaseController
{
    public function indexAction()
    {
//        return new ViewModel();

        $query = $this->getEntityManager()->createQueryBuilder();

        $query->add('select', 'a')
            ->add('from', 'Blog\Entity\Article a')
            ->add('where', 'a.isPublic=1')
            ->add('orderBy', 'a.id ASC');

        $adapter = new DoctrineAdapter(new ORMPaginator($query));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(3);
        $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));

        return array('articles' => $paginator);
    }

    protected function getCommentForm(Comment $comment){
        $builder = new AnnotationBuilder($this->getEntityManager());
        $form = $builder->createForm(new Comment());
        $form->setHydrator(new DoctrineHydrator($this->getEntityManager(), '\Comment'));
        $form->bind($comment);

        return $form;
    }

    public function articleAction(){
        $id = (int) $this->params()->fromRoute('id', 0);
        $em = $this->getEntityManager();
        $article = $em->find('Blog\Entity\Article', $id);

        if(empty($article)){
            return $this->notFoundAction();
        }

        $comment = new Comment();
        $form = $this->getCommentForm($comment);

        return array('article' => $article, 'form' => $form);
    }

    public function commentAddAction(){
//        echo "<h3>Hello!!!!</h3>";
        $em = $this->getEntityManager();
        $comment = new Comment();

        $form = $this->getCommentForm($comment);
        $request = $this->getRequest();
        $response = $this->getResponse();

        $data = $request->getPost();

        if(!empty($data)) {
            $form->setData($data);
            $messages = null;
            if (!$form->isValid()) {
                $errors = $form->getMessages();
                foreach ($errors as $key => $row) {
                    if (!empty($row) && $key != 'submit') {
                        foreach ($row as $keyer => $rower) {
                            $messages[$key][] = $rower;
                        }
                    }
                }
            }

            if (!empty($messages)) {
                $response->setContent(Json::encode($messages));
//                echo "Hello!!!!";
            } else {
//                var_dump($comment);
                $em->persist($comment);
                $em->flush();
                $response->setContent(Json::encode(array('success' => 1)));
            }
        }
        return $response;
    }
}
