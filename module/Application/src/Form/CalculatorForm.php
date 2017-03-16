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

        $this->add(array(
            'attributes' => array(
                'class' => 'form-control input-estate_price slider',
                'data-provide' => 'slider',
                'data-slider-min' => 300000,
                'data-slider-max' => 10000000,
                'data-slider-value' => 2200000,
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
            'type' => 'Zend\Form\Element\Text',
            'value' => 2200000,
        ));

        $this->add(array(
            'attributes' => array(
                'class' => 'form-control input-mortgage slider',
                'data-provide' => 'slider',
                'data-slider-min' => 280000,
                'data-slider-max' => 9500000,
                'data-slider-value' => 1500000,
                //'placeholder' => '',
            ),
            'filters' => array(),
            'name' => 'mortgage',
            'options' => array(
                'label' => 'Výše hypotéky'
            ),
            'required' => true,
            'type' => 'Zend\Form\Element\Number',
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
            'value' => 1500000,
        ));

        $this->add(array(
            'attributes' => array(
                'class' => 'form-control input-mortgage slider',
                'data-provide' => 'slider',
                'data-slider-min' => 5,
                'data-slider-max' => 30,
                'data-slider-value' => 22,
                //'placeholder' => '',
            ),
            'name' => 'amortization_length',
            'options' => array(
                'label' => 'Doba splácení',
            ),
            'type' => 'Zend\Form\Element\Number',
            'value' => 22,
        ));

        $this->add(array(
            'attributes' => array(
                'class' => 'form-control input-fixation',
                'id' => 'input_fixation',
            ),
            'name' => 'fixation',
            'options' => array(
                'label' => 'Fixace',
                'value_options' => array(
                    '1'  => '1 rok',
                    '3'  => '3 roky',
                    '5'  => '5 let',
                    '10' => '10 let',
                ),
            ),
            'type' => 'Zend\Form\Element\Select',
            'value' => '3',
        ));

        $this->add(array(
            'attributes' => array(
                'class' => 'input-assurance',
                'id' => 'input_assurance',
            ),
            'name' => 'assurance',
            'options' => array(
                'label' => 'Pojištění schopnosti splácet',
            ),
            'type' => 'Zend\Form\Element\Checkbox',
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
