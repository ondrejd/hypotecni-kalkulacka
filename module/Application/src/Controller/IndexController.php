<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Application\Form\CalculatorForm;
use Application\Form\ContactForm;
use Application\Model\Contact;
use Application\Model\ContactTable;

/**
 * Description of IndexController
 *
 * @author ondrejd
 */
class IndexController extends AbstractActionController
{
    /**
     * @var \Application\Form\ContactForm $contactTable
     */
    protected $contactTable;

    public function indexAction()
    {
        $view = new ViewModel();
        $calculatorForm = new CalculatorForm();
        $contactForm = new ContactForm();

        //$form->get('submit')->setValue('Add');
        //$calculatorForm->get('')

        $request = $this->getRequest();
        if ($request->isPost()) {
            $item = new Contact();
            $contactForm->setInputFilter($item->getInputFilter());
            $contactForm->setData($request->getPost());

            if ($contactForm->isValid()) {
                $item->exchangeArray($contactForm->getData());
                $this->getContactTable()->saveContact($item);

                // Redirect to list of albums
                return $this->redirect()->toRoute('home');

                // XXX Add flash message!
            }
        }

        $view->calculatorForm = $calculatorForm;
        $view->contactForm = $contactForm;

        return $view;
    }

    public function adminAction()
    {
        return new ViewModel();
    }

    /**
     * @return \Application\Form\ContactForm
     */
    public function getContactTable()
    {
        if (($this->contactTable instanceof ContactTable)) {
            return $this->contactTable;
        }

        $sm = $this->getServiceLocator();
        $this->contactTable = $sm->get('Application\Model\ContactTable');

        return $this->contactTable;
    }
}
