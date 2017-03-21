<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Controller;

use Application\Form\SettingsForm;
use Zend\View\Model\ViewModel;

/**
 * Description of AdminController
 *
 * @author ondrejd
 */
class AdminController extends CommonController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function dataAction()
    {
        $viewModel = new ViewModel();

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function destinationsAction()
    {
        $viewModel = new ViewModel();
        $viewModel->destinationTable = $this->getDestinationTable();

        return $viewModel;
    }

    /**
     * @return ViewModel
     */
    public function settingsAction()
    {
        $view = new ViewModel();
        $form = new SettingsForm();

        // ...

        $view->settingsForm = $form;

        return $view;
    }
}
