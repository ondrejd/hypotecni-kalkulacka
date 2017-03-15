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
 * Description of Contact
 *
 * @author ondrejd
 */
class Contact implements InputFilterAwareInterface
{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $zip;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id    = (isset($data['id']))    ? $data['id']    : null;
        $this->name  = (isset($data['name']))  ? $data['name']  : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->phone = (isset($data['phone'])) ? $data['phone'] : null;
        $this->zip   = (isset($data['zip']))   ? $data['zip']   : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception('Not used');
    }

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
            'name'     => 'name',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
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
            'name'     => 'email',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
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
            'name'     => 'phone',
            'required' => true,
            'filters'  => array(),
            'validators' => array(),
        ));
        $inputFilter->add(array(
            'name'     => 'zip',
            'required' => true,
            'filters'  => array(),
            'validators' => array(),
        ));

        $this->inputFilter = $inputFilter;

        return $this->inputFilter;
    }
}