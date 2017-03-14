<?php
/**
 * @author  Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License 3.0
 * @link    https://github.com/ondrejd/hypotecni-kaklulacka for the canonical source repository
 * @package Application
 */

namespace Application\Form;

use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;

/**
 * Description of ContactForm
 *
 * @author ondrejd
 */
class ContactForm extends Form
{
    public function __construct($name = 'contact-form')
    {
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'attributes' => array(
                'class' => 'text',
                'placeholder' => 'Vaše jméno',
            ),
            'filters'  => array(
                array('name' => 'Zend\Filter\StringTrim'),
            ),
            'name' => 'name',
            'options' => array(
                'label' => 'Vaše jméno',
            ),
            'required' => true,
            'type' => 'Text',
        ));

        $this->add(array(
            'attributes' => array(
                'placeholder' => 'Váš email',
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'name' => 'email',
            'options' => array(
                'label' => 'E-mail'
            ),
            'required' => true,
            'type' => 'Zend\Form\Element\Email',
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'max' => 80
                    )
                ),
                array('name' => 'EmailAddress'),
            ),
        ));

        $this->add(array(
            'attributes' => array(
                'class' => 'text',
                'placeholder' => 'Telefon',
            ),
            'name' => 'phone',
            'options' => array(
                'label' => 'Telefon'
            ),
            'type' => 'Text',
        ));

        $this->add(array(
            'attributes' => array(
                'class' => 'text',
                'placeholder' => 'PSČ',
            ),
            'name' => 'zip',
            'options' => array(
                'label' => 'PSČ'
            ),
            'type' => 'Text',
        ));

        $this->add(new Element\Csrf('security'));
        $this->add(array(
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => array(
                'class' => 'btn btn-success',
                'value' => 'Odeslat',
           ),
        ));
    }
}
