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

use Application\Form\SettingsForm;

/**
 * Description of AdminController
 *
 * @author ondrejd
 */
class AdminController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function dataAction()
    {
        return new ViewModel();
    }

    public function destinationsAction()
    {
        return new ViewModel();
    }

    public function settingsAction()
    {
        $view = new ViewModel();
        $form = new SettingsForm();

        // ...

        $view->settingsForm = $form;

        return $view;
    }
}
