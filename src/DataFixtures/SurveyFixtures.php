<?php

namespace App\DataFixtures;

use App\Survey\Entity\Survey;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SurveyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $survey = new Survey("Sondage 3e oeil et sa multidimension");

        $survey->addFieldset(
            "Etes-vous familier(ère) avec un ou plusieurs domaines de l'énergétique ?",
            [
                'html_tag' => 'input',
                'type' => 'radio',
                'name' => 'familiar_with_energy',
                'data_type' => 'boolean'
            ],
        );
        $survey->addFieldset(
            "Qu'est-ce qui vous a amené(e) à vous intéresser à l'énergétique ?",
            [
                'html_tag' => 'textarea',
                'type' => 'textarea',
                'name' => 'what_did_bring_you_to_energetic',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Etes-vous vous-même praticien(ne) (professionnel(le) ou non) ?",
            [
                'html_tag' => 'input',
                'type' => 'radio',
                'name' => 'is_practician',
                'data_type' => 'boolean'
            ]
        );
        $survey->addFieldset(
            "Dans quel(s) domaine(s) ?",
            [
                'html_tag' => 'textarea',
                'type' => 'textarea',
                'name' => 'in_which_domains_are_you',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Si vous avez déjà des perceptions subtiles, avec lesquelles êtes-vous le plus à l'aise ?",
            [
                'html_tag' => 'input',
                'type' => 'checkbox',
                'name' => 'subtiles_perceptions',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Seriez-vous intéressé(e) par une initiation au 3e oeil et à sa multidimension ?",
            [
                'html_tag' => 'input',
                'type' => 'radio',
                'name' => 'is_interested_by_initiation',
                'data_type' => 'boolean'
            ]
        );
        $survey->addFieldset(
            "Pourquoi seriez-vous intéressé(e) par cette initiation ?",
            [
                'html_tag' => 'textarea',
                'type' => 'textarea',
                'name' => 'why_are_you_interested_by_initiation',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Quels sujets complémentaires seraient susceptibles de vous intéresser ?",
            [
                'html_tag' => 'input',
                'type' => 'checkbox',
                'name' => 'subjects',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Merci de faire une liste des sujets que vous aimeriez aborder",
            [
                'html_tag' => 'textarea',
                'type' => 'textarea',
                'name' => 'other_subjects',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Quel serait pour vous le bon équilibre entre contenus écrit, audio et vidéo ?",
            [
                'html_tag' => 'input',
                'type' => 'radio',
                'name' => 'content_type_preference',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Pensez-vous avoir besoin d'un suivi pendant la durée de l'initiation ?",
            [
                'html_tag' => 'input',
                'type' => 'radio',
                'name' => 'need_following',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "A la fin de cette initiation, seriez-vous intéressé par une immersion de groupe ?",
            [
                'html_tag' => 'input',
                'type' => 'radio',
                'name' => 'interested_by_immersion',
                'data_type' => 'boolean'
            ]
        );
        $survey->addFieldset(
            "Quelle dimension de groupe est la plus confortable pour vous ?",
            [
                'html_tag' => 'select',
                'type' => 'single_choice',
                'name' => 'group_size',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Pourquoi cet intérêt pour une immersion ?",
            [
                'html_tag' => 'textarea',
                'type' => 'textarea',
                'name' => 'why_are_you_interested_by_immersion',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Quelle serait pour vous la durée idéale de l'immersion ?",
            [
                'html_tag' => 'select',
                'type' => 'single_choice',
                'name' => 'time_for_immersion',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Quelle durée en jours pour l'immersion ?",
            [
                'html_tag' => 'input',
                'type' => 'number',
                'name' => 'custom_time_for_immersion',
                'data_type' => 'number'
            ]
        );
        $survey->addFieldset(
            "Auriez-vous des questions qui concernent l'initiation ?",
            [
                'html_tag' => 'textarea',
                'type' => 'textarea',
                'name' => 'have_you_some_questions',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "Quel est votre email ?",
            [
                'html_tag' => 'input',
                'type' => 'email',
                'name' => 'lead_email',
                'data_type' => 'string'
            ]
        );
        $survey->addFieldset(
            "J'accepte d'être prévenu par email à la sortie du guide.",
            [
                'html_tag' => 'input',
                'type' => 'checkbox',
                'name' => 'agree_for_notification',
                'data_type' => 'boolean'
            ]
        );
        $manager->persist($survey);
        $manager->flush();
    }
}
