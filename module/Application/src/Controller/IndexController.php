<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Controller;

use Application\Form\CalculatorForm;
use Application\Form\ContactForm;
use Zend\View\Model\ViewModel;

/**
 * Renders calculator for mortgage.
 *
 * @author ondrejd
 */
class IndexController extends CommonController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $view = new ViewModel();
        $calculatorForm = new CalculatorForm();
        $contactForm = new ContactForm();
        //$destinationsTable = $this->getDestinationTable();
        $destinations = $this->getDestinationTable()->fetchAll();
var_dump($destinations);
exit();
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
}
