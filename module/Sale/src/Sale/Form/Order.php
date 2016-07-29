<?php
/**
 *
 * @author Prakash Admane <prakash.admane@gmail.com>
 */

namespace Sale\Form;

use Sale\Entity\Order as OrderEntity;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\Hostname;
use Zend\Validator\NotEmpty;

/**
 * Class Order
 * @package Sale\Form
 */
class Order extends Form implements InputFilterProviderInterface
{
    /** Validation message */
    const VALIDATION_MESSAGE = 'Please provide a value for';

    /** Invalid Email address message */
    const INVALID_EMAIL_ADDRESS_MESSAGE = 'Please provide a valid email address';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('buy-form');

        $hydrator = new ClassMethods(true);
        $this->setHydrator($hydrator);
        $this->setObject(new OrderEntity());
    }

    /**
     *  Init
     */
    public function init()
    {

        $this->add([
            'name' => 'email_address',
            'type' => 'Zend\Form\Element\Text',
            'options' => [
                'label' => 'Email Address',
                'label_attributes' => [
                    'class' => 'required'
                ],
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
        ]);


        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Buy Book',
                'class' => 'btn btn-primary'
            ]
        ]);

        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Buy Book',
                'class' => 'btn btn-primary'
            ]
        ]);
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            [
                'name' => 'email_address',
                'required' => true,
                'filters' => [
                    ['name' => 'Zend\Filter\StringTrim'],
                    ['name' => 'Zend\Filter\StripTags'],
                    ['name' => 'Zend\Filter\ToNull'],
                    ['name' => 'Zend\Filter\StringToLower'],
                ],
                'validators' => [
                    [
                        'name' => 'NotEmpty',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'messages' => [
                                NotEmpty::IS_EMPTY => self::VALIDATION_MESSAGE
                                    . ' email address',
                            ],
                        ],
                    ],
                    [
                        'name' => 'EmailAddress',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'messages' => [
                                EmailAddress::INVALID => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                EmailAddress::INVALID_FORMAT => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                EmailAddress::INVALID_HOSTNAME => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                EmailAddress::INVALID_MX_RECORD => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                EmailAddress::INVALID_SEGMENT => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                EmailAddress::DOT_ATOM => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                EmailAddress::QUOTED_STRING => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                EmailAddress::INVALID_LOCAL_PART => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                EmailAddress::LENGTH_EXCEEDED => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::CANNOT_DECODE_PUNYCODE => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::INVALID => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::INVALID_DASH => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::INVALID_HOSTNAME => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::INVALID_HOSTNAME_SCHEMA => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::INVALID_LOCAL_NAME => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::INVALID_URI => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::IP_ADDRESS_NOT_ALLOWED => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::UNDECIPHERABLE_TLD => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::UNKNOWN_TLD => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                                Hostname::LOCAL_NAME_NOT_ALLOWED => self::INVALID_EMAIL_ADDRESS_MESSAGE,
                            ],
                        ],
                    ]
                ]
            ]
        ];

    }


}