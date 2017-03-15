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
 * Description of ContactTable
 *
 * @author ondrejd
 */
class ContactTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getContact($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();

        if (!$row) {
            throw new \Exception('Could not find row with ID ' . $id . '!');
        }

        return $row;
    }

    public function saveContact(Contact $contact)
    {
        $data = array(
            'name'  => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'zip'   => $contact->zip,
        );

        $id = (int) $contact->id;

        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getContact($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Row with ID ' . $id . ' does not exist!');
            }
        }
    }

    public function deleteContact($id)
    {
        $this->tableGateway->delete(array('id' => (int) $id));
    }
}
