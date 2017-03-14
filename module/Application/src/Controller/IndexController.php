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

use Application\Form\ContactForm;

/**
 * Description of IndexController
 *
 * @author ondrejd
 */
class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $form = new ContactForm();

        // ...

        $view->contactForm = $form;

        return $view;
    }

    public function adminAction()
    {
        return new ViewModel();
    }
}
