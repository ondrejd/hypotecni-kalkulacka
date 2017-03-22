<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Controller;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
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
     * @param ContainerInterface $container
     * @param string $request
     * @param array|null|null $options
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when creating a service.
     * @throws ContainerException if any other error occurs
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $request, array $options = null)
    {
        if (! class_exists($request)) {
            throw new ServiceNotFoundException('Requested controller name "'.$request.'" does not exist.');
        }

        return new $request($container);
    }
}
