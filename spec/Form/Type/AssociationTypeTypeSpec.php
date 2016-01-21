<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Sylius\Bundle\AssociationBundle\Form\Type;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Łukasz Chruściel <lukasz.chrusciel@lakion.com>
 */
class AssociationTypeTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Sylius\Component\Association\Model\AssociationType', array('sylius'), 'product');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Sylius\Bundle\AssociationBundle\Form\Type\AssociationTypeType');
    }

    function it_extends_abstract_resource_type()
    {
        $this->shouldImplement('Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType');
    }

    function it_builds_form(FormBuilderInterface $formBuilder)
    {
        $formBuilder->add('name', 'text', Argument::cetera())->shouldBeCalled()->willReturn($formBuilder);
        $formBuilder->addEventSubscriber(Argument::type(AddCodeFormSubscriber::class))->shouldBeCalled()->willReturn($formBuilder);

        $this->buildForm($formBuilder, array());
    }

    function it_has_name()
    {
        $this->getName()->shouldReturn('sylius_product_association_type');
    }
}
