<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Vacancy;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $vacancies = $objectManager
            ->getRepository('\Application\Entity\Vacancy')
            ->findAll();

        $view = new ViewModel(array(
            'items' => $vacancies,
        ));

        return $view;
    }

    public function addAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repository = $objectManager->getRepository('Gedmo\Translatable\Entity\Translation');

        for($n = 1; $n < 10; $n++) {
            $item = new Vacancy();
            $item->setName('Vacancy EN ' . $n);
            $item->setDescription('Vacancy EN description ' . $n);

            $repository->translate($item, 'name', 'de_DE', 'Vacancy DE ' . $n)
                ->translate($item, 'description', 'de_DE', 'Vacancy DE description ' . $n)
                ->translate($item, 'name', 'ru_RU', 'Вакансия RU ' . $n)
                ->translate($item, 'description', 'ru_RU', 'Описание RU вакансии ' . $n);

            $objectManager->persist($item);
        }
        $objectManager->flush();
    }
}
