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
 * Description of CalculatorForm
 *
 * @author ondrejd
 */
class CalculatorForm extends Form
{
    public function __construct($name = 'calculator-form')
    {
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        //estate_price
        //mortgage
        //amortization_length
        //fixation
        //assurance

        $this->add(array(
            'attributes' => array(
                'class' => 'form-control input-estate_price',
                //'placeholder' => '',
            ),
            'filters'  => array(
                //array('name' => 'StringTrim'),
            ),
            'name' => 'estate_price',
            'options' => array(
                'label' => 'Cena nemovitosti',
            ),
            'required' => true,
            'type' => 'Text',
            'value' => '2200000',
        ));

        $this->add(array(
            'attributes' => array(
                'class' => 'form-control input-mortgage',
                //'placeholder' => '',
            ),
            'filters' => array(),
            'name' => 'mortgage',
            'options' => array(
                'label' => 'Výše hypotéky'
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
            'value' => '1500000',
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
