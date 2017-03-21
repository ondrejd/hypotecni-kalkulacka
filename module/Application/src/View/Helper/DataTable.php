<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Description of DataTableHelper
 *
 * @author ondrejd
 */
class DataTable extends AbstractHelper
{
    public function __invoke($str, $find)
    {
        if (! is_string($str)){
            return 'must be string';
        }
 
        if (strpos($str, $find) === false){
            return 'not found';
        }
 
        return 'found';
    }
}
