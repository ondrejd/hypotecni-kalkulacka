<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\View\Helper;

use Application\Model\DestinationTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\View\Helper\AbstractHelper;

/**
 * Description of DataTableHelper
 *
 * @author ondrejd
 * @link http://stackoverflow.com/questions/4866929/best-way-to-show-data-in-html-tables-in-zend
 */
class DataTable extends AbstractHelper
{
    /**
     * @param DestinationTable $destinationTable
     * @return string
     */
    public function __invoke(DestinationTable $destinationTable)
    {
        $destinations = $destinationTable->fetchAll();
 echo '<pre>';
 var_dump($destinations);
 echo '</pre>';
 exit();
        $html  = '';
        $html .= '<table>';
        $html .= $this->renderTableHeader($destinations);
        $html .= $this->renderTableBody($destinations);
        $html .= $this->renderTableFooter($destinations);
        $html .= '</table>';
        $html .= $this->renderPagination($destinations);
        
        return $html;
    }

    /**
     * @param ResultSet $items
     * @return string
     */
    protected function renderTableHeader(ResultSet $items)
    {
        $html = '';
        $html .= '<thead>';
        //...
        $html .= '</thead>';

        return $html;
    }

    /**
     * @param ResultSet $items
     * @return string
     */
    protected function renderTableBody(ResultSet $items)
    {
        $html = '';
        $html .= '<tbody>';
        //...
        $html .= '</tbody>';

        return $html;
    }

    /**
     * @param ResultSet $items
     * @return string
     */
    protected function renderTableFooter(ResultSet $items)
    {
        $html = '';
        $html .= '<tfooter>';
        //...
        $html .= '</tfooter>';

        return $html;
    }

    public function renderPagination(ResultSet $items)
    {
        $html = '';
        $html .= '<div class="table-pagination">';
        //...
        $html .= '</div>';

        return $html;
    }
}
