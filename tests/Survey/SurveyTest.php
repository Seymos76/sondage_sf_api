<?php

namespace App\Tests\Survey;

use Symfony\Component\HttpFoundation\Request;

class SurveyTest extends \Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
{
    public function testBuildSurvey() 
    {
        $survey = new Survey('Sondage pour la rédaction d\'un guide multidimensionnel du 3e oeil');
        $survey->addFieldset(
            [
                'field_type' => 'text',
                'name' => 'text_1',
                'id' => 'text_1',
                'placeholder' => "Mon placeholder"
            ],
            'Label du champ',
            [
                'value' => "Ma ligne"
            ]
        );
        $survey->addFieldset(
            [
                'field_type' => 'email',
                'name' => 'email_1',
                'id' => 'email_1',
                'placeholder' => "jonathan@devntech.fr"
            ],
            'Label du champ',
            [
                'value' => "Ma ligne"
            ]
        );
        $survey->addFieldset(
            [
                'field_type' => 'textarea',
                'name' => 'textarea_1',
                'id' => 'textarea_1'
            ],
            'Label du champ',
            [
                'value' => "Mon texte"
            ]
        );
        $survey->addFieldset(
            [
                'field_type' => 'checkbox',
                'name' => 'checkbox_1',
                'id' => 'checkbox_1'
            ],
            'Label du champ',
            [
                'value' => true
            ]
        );
        $survey->addFieldset(
            [
                'field_type' => 'select',
                'name' => 'select_1',
                'id' => 'select_1'
            ],
            'Label du champ',
            [
                'values' => [
                    ['name' => 'option_1', 'value' => 'option_value_1'],
                ]
            ]
        )
    }
}
