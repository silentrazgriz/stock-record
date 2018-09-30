<?php

declare(strict_types=1);


namespace App\Forms;


use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;

/**
 * Class RegisterForm
 * @package App\Forms
 */
class RegisterForm extends Form
{
    /**
     * RegisterForm constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'POST',
            '/register',
            'register-form',
            'Register',
            [
                'button' => [
                    'placement' => [
                        'vertical' => ButtonPlacement::BOTTOM,
                        'horizontal' => ButtonPlacement::RIGHT
                    ],
                    'action' => [
                        'submit' => [
                            'text' => 'Register'
                        ]
                    ]
                ],
                'labelAlign' => ''
            ]
        );
    }

    /**
     * @param array $values
     */
    protected function build(array $values = []): void
    {
        $this->addField('email', 'Email', FieldType::EMAIL)
            ->setPlaceholder('Email');

        $this->addField('login_id', 'Login ID', FieldType::TEXT)
            ->setPlaceholder('Login ID');

        $this->addField('name', 'Name', FieldType::TEXT)
            ->setPlaceholder('Name');

        $this->addField('password', 'Password', FieldType::PASSWORD)
            ->setPlaceholder('Password');

        $this->addField('password_confirmation', 'Password Confirmation', FieldType::PASSWORD)
            ->setPlaceholder('Password Confirmation');
    }
}