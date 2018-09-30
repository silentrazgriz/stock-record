<?php

declare(strict_types=1);


namespace App\Forms;


use Gaia\Tekton\Component\Form;
use Gaia\Tekton\Component\Value\ButtonPlacement;
use Gaia\Tekton\Component\Value\FieldType;

/**
 * Class LoginForm
 * @package App\Forms
 */
class LoginForm extends Form
{
    /**
     * LoginForm constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'POST',
            '/login',
            'login-form',
            'Login',
            [
                'button' => [
                    'placement' => [
                        'vertical' => ButtonPlacement::BOTTOM,
                        'horizontal' => ButtonPlacement::RIGHT
                    ],
                    'action' => [
                        'submit' => [
                            'text' => 'Login'
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
        $this->addField('login_id', 'Email or Login ID', FieldType::TEXT)
            ->setPlaceholder('Email or Login ID');

        $this->addField('password', 'Password', FieldType::PASSWORD)
            ->setPlaceholder('Password');
    }

}