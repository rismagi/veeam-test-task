<?php
/**
 * Index controller
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Vacancy;
use Application\Form\FilterForm;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $objectManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $filter = array();
        $defaultLocale = $locale = 'en_US';

        $form = new FilterForm($objectManager);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $form->setData($data);
            if (!empty($data['department'])) {
                $filter['department'] = (int) $data['department'];
            }
            if (!empty($data['language'])) {
                $langs = $objectManager->getRepository('\Application\Entity\Language')->findById((int) $data['language']);
                if (isset($langs[0])) {
                    $locale = $langs[0]->getLocale();
                }
            }
        } else {
            // Default language by locale
            $langs = $objectManager->getRepository('\Application\Entity\Language')->findByLocale($locale);
            if (isset($langs[0])) {
                $form->get('language')->setValue($langs[0]->getId());
            }
        }
        // Filter
        $vacancyRepository = $objectManager->getRepository('\Application\Entity\Vacancy');
        if (!empty($filter)) {
            $vacancies = $vacancyRepository->findBy($filter);
        } else {
            $vacancies = $vacancyRepository->findAll();
        }
        // i18n
        if ($defaultLocale != $locale) {
            foreach($vacancies as $item) {
                $item->setTranslatableLocale($locale);
                $objectManager->refresh($item);
            }
        }
        // Output
        $view = new ViewModel(array(
            'items' => $vacancies,
            'form' => $form
        ));

        return $view;
    }
}
