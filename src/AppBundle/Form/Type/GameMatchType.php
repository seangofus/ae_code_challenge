<?php

namespace AppBundle\Form\Type;

use AppBundle\Provider\MoveProvider;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 *
 * @inheritDoc
 * @package AppBundle\Form\Type
 * @author Sean Gofus <sean.gofus@gmail.com>
 */
class GameMatchType extends AbstractType
{
    /**
     * @var MoveProvider $moveProvider
     */
    protected $moveProvider;

    public function __construct(MoveProvider $moveProvider)
    {
        $this->moveProvider = $moveProvider;
    }

    /**
     * @inheritDoc
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'playerChoice',
            'choice',
            [
                'label' => 'Choice',
                'required' => true
                'choices' => $this->moveProvider->getAllMoves();
            ]
        );
    }

    /**
     * @inheritDoc
     *
     * @codeCoverageIgnore
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => 'AppBundle\Entity\GameMatch',
                'csrf_protection'    => true,
                'cascade_validation' => true,
            ]
        );
    }


    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'appbundle_game_form';
    }
}
