<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Controller;

use Application\Model\Contact;
use Application\Model\ContactTable;
use Application\Model\Destination;
use Application\Model\DestinationTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Description of CommonController
 *
 * @author ondrejd
 */
class CommonController extends AbstractActionController
{
    /**
     * @var \Application\Model\ContactTable $contactTable
     */
    protected $contactTable;

    /**
     * @var \Application\Model\DestinationTable $destinationTable
     */
    protected $destinationTable;

    /**
     * @return \Application\Model\ContactTable
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

    /**
     * @return \Application\Model\DestinationTable
     */
    public function getDestinationTable()
    {
        if (($this->destinationTable instanceof DestinationTable)) {
            return $this->destinationTable;
        }

        $sm = $this->getServiceLocator();
        $this->destinationTable = $sm->get('Application\Model\DestinationTable');

        return $this->destinationTable;
    }
}
