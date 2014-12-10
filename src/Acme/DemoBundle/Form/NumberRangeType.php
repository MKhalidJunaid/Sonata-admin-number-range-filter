<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

class NumberRangeType extends AbstractType
{

    private $container;


    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    /**
     * {@inheritDoc}
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('start', $options['field_type'], array_merge(array('required' => false), $options['field_options']));
        $builder->add('end', $options['field_type'], array_merge(array('required' => false), $options['field_options']));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'field_options'    => array(),
            'field_type'       => 'text',
        ));
    }


    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'acme_admin_type_number_range';
    }
}
