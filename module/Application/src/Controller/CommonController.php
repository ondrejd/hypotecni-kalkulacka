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
use Zend\ServiceManager\ServiceManager;
use Zend\View\Model\ViewModel;

/**
 * Description of CommonController
 *
 * @author ondrejd
 */
class CommonController extends AbstractActionController
{
    /**
     * @var ServiceManager $serviceManager
     */
    protected $serviceManager;

    /**
     * Constructor
     * @param ServiceManager $serviceManager
     */
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @return ContactTable
     */
    public function getContactTable()
    {
        return $this->serviceManager->get(ContactTable::class);
    }

    /**
     * @return DestinationTable
     */
    public function getDestinationTable()
    {
        return $this->serviceManager->get(DestinationTable::class);
    }
}
