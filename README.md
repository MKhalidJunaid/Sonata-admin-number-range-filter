Sonata Admin Number Range Filter
================================

Sonata Admin Number Range Filter
Sonata Admin Number Range Filter To add a range filter specific to numbers to have this type of filter you can create a new form type and filter and associate you filter with form type.

Add 2 services
--
1) For form type

    acme.admin.form.type.number_range:
        class: %acme.admin.form.number_range%
        tags:
            - { name: form.type, alias: acme_admin_type_number_range }
2) For filter type
    
    acme.admin.filter.type.number_range:
        class: %acme.admin.filter.number_range%
        tags:
            - { name: sonata.admin.filter.type, alias: doctrine_orm_number_range }
            
and there parameters
    parameters:
        acme.admin.filter.number_range: Acme\DemoBundle\Filter\NumberRangeFilter
        acme.admin.form.number_range: Acme\DemoBundle\Form\NumberRangeType

I have added these services in Acme\DemoBundle\Resources\config named as filter_services.yml

Now import filter_services.yml in main configuration file as below app\config\config.yml
    
    imports:
        - { resource: parameters.yml }
        - { resource: security.yml }
        - { resource: @AcmeDemoBundle/Resources/config/filter_services.yml }
    
    twig:
        debug:            "%kernel.debug%"
        strict_variables: "%kernel.debug%"
        form:
            resources:
                - 'AcmeDemoBundle:Form:fields.html.twig'
                
For form type you also need to create a field widget which will render range fileds as added in `AcmeDemoBundle:Form:fields.html.twig
    
    {% block acme_admin_type_number_range_widget %}
        {% spaceless %}
            <div {{ block('widget_container_attributes') }}>
                {{ form_errors(form.start) }}
                {{ form_label(form.start) }}
                {{ form_widget(form.start) }}
                {{ form_errors(form.end) }}
                {{ form_label(form.end) }}
                {{ form_widget(form.end) }}
            </div>
        {% endspaceless %}
    {% endblock acme_admin_type_number_range_widget %}

create associated classes for form type/filter type ,After that in your Admin Class's configureDatagridFilters() funtion add your field with you new filter type doctrine_orm_number_range

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id','doctrine_orm_number_range',array('label'=>'Id'))
         ;
    
    }
    
![alt tag](http://desiredinn.com/quiz/number%20filter.png)
