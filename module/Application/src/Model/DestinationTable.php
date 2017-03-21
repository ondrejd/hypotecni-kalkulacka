<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

/**
 * Description of DestinationTable
 *
 * @author ondrejd
 */
class DestinationTable extends AbstractTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @param int $id
     * @return \Application\Model\Destination
     */
    public function fetchOneById($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();

        if (!$row) {
            throw new \Exception('Could not find row with ID ' . $id . '!');
        }

        return $row;
    }

    /**
     * @param \Application\Model\Destination $destination
     * @throws \Exception
     */
    public function save(Destination $destination)
    {
        $data = array(
            'server'      => $destination->server,
            'created'     => $destination->created,
            'enabled'     => $destination->enabled,
            'description' => $destination->description,
        );

        $id = (int) $destination->id;

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getDestination($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Row with ID ' . $id . ' does not exist!');
            }
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function removeById($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
