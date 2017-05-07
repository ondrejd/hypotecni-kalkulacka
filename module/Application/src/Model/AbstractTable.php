<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Model;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Stdlib\Hydrator\ArraySerializable;

/**
 * Description of AbstractTable
 *
 * @author ondrejd
 */
abstract class AbstractTable implements TableInterface
{
    protected $dbAdapter;

    protected function fetch($sql, $params = null)
    {
        $this->
        $dbAdapter = $this->getDbAdapter();
        $statement = $dbAdapter->createStatement($sql);
        $statement->prepare();

        $result = $statement->execute($params);

        if ($result instanceof ResultInterface) {
            $hydrator     = new ArraySerializable();
            $rowPrototype = new __SELF__;
            $resultset    = new HydratingResultSet($hydrator, $rowPrototype);
            $resultset->initialize($result);
 
            return $resultset;
        }
 
        return $result;
    }

    /**
     * @return HydratingResultSet
     */
    public function fetchAll()
    {
        return $this->fetch('SELECT * FROM `destinations` WHERE 1 ;');
    }

    /**
     * @param int $id
     * @return object
     */
    abstract function fetchOneById($id);
}
