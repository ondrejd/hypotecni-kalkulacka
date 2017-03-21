<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Controller;

use Application\Model\ContactTable;
use Application\Model\DestinationTable;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of CommonControllerFactory
 *
 * @author ondrejd
 */
class InvokableFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $serviceManager
     * @param string $controllerName
     * @param array|null|null $options
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when creating a service.
     * @throws ContainerException if any other error occurs
     * @return mixed
     */
    public function __invoke(ContainerInterface $serviceManager, $controllerName, array $options = null)
    {
        if (! class_exists($controllerName)) {
            throw new ServiceNotFoundException('Requested controller name "'.$controllerName.'" does not exist.');
        }

        $contactTable     = $serviceManager->get(ContactTable::class);
        $destinationTable = $serviceManager->get(DestinationTable::class);

        return new $controllerName($contactTable, $destinationTable);
    }
}
