<?php

namespace SilverCommerce\QuantityField\Forms;

use SilverStripe\Forms\NumericField;

/**
 * Text input field with validation for numeric values.
 * 
 * @package quantityfield
 */
class QuantityField extends NumericField
{
    /**
     * Construct this field (we override the default to set a default value)
     *
     * @param [type] $name
     * @param [type] $title
     * @param string $value
     * @param [type] $maxLength
     * @param [type] $form
     */
    public function __construct($name, $title = null, $value = 1, $maxLength = null, $form = null)
    {
        parent::__construct($name, $title, $value);
    }

    public function Type()
    {
        return 'quantity numeric text';
    }

    /**
     * PHP Validation
     * 
     * @return boolean
     * @throws Exception
    **/
    public function validate($validator)
    {
        $value = $this->Value() + 0;
        
        if(is_int($value)) {
            return true;
        }
        
        $validator->validationError(
            $this->name,
            _t(
                'Checkout.VALIDATION', '{value} is not a valid number, only whole numbers can be accepted for this field',
                array('value' => $value)
            ),
            "validation"
        );

        return false;
    }
    
    public function dataValue()
    {
        $value = $this->Value();
        $value =  (is_numeric($value)) ? $value : 0;

        return $this->cast($value);
    }
}
