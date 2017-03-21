<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Description of Destination
 *
 * @author ondrejd
 */
class Destination implements InputFilterAwareInterface
{
    public $id;
    public $server;
    public $created;
    public $enabled;
    public $description;

    /**
     * @var InputFilter
     */
    protected $inputFilter;

    /**
     * @param array $data
     * @return void
     */
    public function exchangeArray($data)
    {
        $this->id      = (isset($data['id']))      ? $data['id']      : null;
        $this->server  = (isset($data['server']))  ? $data['server']  : null;
        $this->created = (isset($data['created'])) ? $data['created'] : null;
        $this->enabled = (isset($data['enabled'])) ? $data['enabled'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
    }

    /**
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * @param InputFilterInterface $inputFilter
     * @throws \Exception
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Not used');
    }

    /**
     * @return InputFilter
     */
    public function getInputFilter()
    {
        if (($this->inputFilter instanceof InputFilter)) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();
        $inputFilter->add(array(
            'name'     => 'id',
            'required' => true,
            'filters'  => array(
                array('name' => 'Int'),
            ),
        ));
        $inputFilter->add(array(
            'name'     => 'server',
            'required' => true,
            'filters'  => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ));
        $inputFilter->add(array(
            'name'     => 'created',
            'filters'  => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(),
        ));
        $inputFilter->add(array(
            'name'     => 'enabled',
            'filters'  => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(),
        ));
        $inputFilter->add(array(
            'name'     => 'description',
            'filters'  => array(),
            'validators' => array(),
        ));

        $this->inputFilter = $inputFilter;

        return $this->inputFilter;
    }
}