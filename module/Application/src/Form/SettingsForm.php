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
class SettingsForm extends Form
{
    public function __construct($name = 'settings-form')
    {
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'confirmations',
            'options' => array(
                'label' => 'Odesílat potvrzení uživatelům kalkulačky?',
                'description' => 'Pokud zaškrtnete políčko výše budou po odeslání formulářů uživatelům zaslány konfirmační emailové zprávy.',
            ),
            'type' => 'Checkbox',
        ));

        $this->add(array(
            'attributes' => array(
                'placeholder' => 'Notifikační email',
            ),
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'name' => 'email',
            'options' => array(
                'label' => 'E-mail',
                'description' => 'Na tuto e-mailovou adresu budou zasílány notifikační zprávy o nově odeslaných datech z hypotéční kalkulačky. Ponecháte-li jej prázdný, zprávy nebudou odesílány, ale pouze ukládány do databáze.',
            ),
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

        //...

        $this->add(new Element\Csrf('security'));
        $this->add(array(
            'name' => 'send',
            'type'  => 'Submit',
            'attributes' => array(
                'class' => 'btn btn-success',
                'value' => 'Uložit',
           ),
        ));
    }
}
