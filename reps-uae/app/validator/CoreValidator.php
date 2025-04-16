<?php
namespace App\Validator; 

use Illuminate\Validation\Validator;

class CoreValidator extends Validator
{
    protected $implicitRules = array('Required', 'RequiredWith', 'RequiredWithout', 'RequiredIf', 'Accepted', 'RequiredWithoutField');

    public function __construct(\Illuminate\Contracts\Translation\Translator $translator, $data, $rules, $messages = array())
    {
        parent::__construct($translator, $data, $rules, $messages);
        $this->isImplicit('fail');
    }
    
    /**
     * @param attribute, value, parameters
     * @return false
     * checks for spaces and alphabets
     * Created By Kevin @ Cranium Creations
     */
    protected function validateAlphaSpaces($attribute, $value, $parameters = null)
    {
        return preg_match('/^[\pL\s]+$/u', $value);
    }
}