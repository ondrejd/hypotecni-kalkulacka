<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application;

/**
 * Description of ConfigAwareInterface
 * 
 * @author ondrejd
 */
interface ConfigAwareInterface
{
    public function setConfig($config);
}
