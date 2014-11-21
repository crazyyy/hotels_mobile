<?php

//namespace application\models\booking;

//use CFormModel;

class IndexForm extends CFormModel
{
    public $firstName;

    public $lastName;

    public $email;

    public $phone;

    public $rulesAccepted;

    /**
     * @return mixed
     */
    public function getphone()
    {
        return $this->phone;
    }

    public function rules()
    {
        return array(
            array('firstName, lastName, email, phone', 'required'),
            array('email', 'email'),
            array('phone', 'validatePhone'),
            array('rulesAccepted', 'required', 'message' => 'Вы должны согласиться с уловием использования!')
        );
    }

    public function validatePhone($attribute)
    {
//        $value = $this->$attribute;

        $value = call_user_func(array('\IndexForm', 'get'.$attribute));
//        $value = $this->{$attribute};
        if (!preg_match('/^\d{10}$/m', $value)) {
            $this->addError($attribute, 'Телефон должен состоять только из цифр (10 цифр).');
            return false;
        }
        return true;
    }

    public function attributeLabels()
    {
        return array(
            'firstName' => 'Имя',
            'lastName'  => 'Фамилия',
            'email'     => 'E-mail',
            'phone'     => 'Номер телефона'
        );
    }
} 