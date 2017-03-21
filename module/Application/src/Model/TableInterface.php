<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Model;

/**
 * Description of TableInterface
 *
 * @author ondrejd
 */
interface TableInterface
{
    /**
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll();

    /**
     * @param int $id
     * @return object
     */
    public function fetchOneById($id);
}
