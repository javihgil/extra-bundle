# Extra Bundle

Utility services and classes for Symfony projects

## Installation

    composer require javihgil/extra-bundle ~1.0

## Configure Bundle

Register the bundle in *app/AppKernel.php*:

    // app/AppKernel.php
    public function registerBundles()
    {
        return [
            // ...
            new \Jhg\ExtraBundle\ExtraBundle(),
        ];
    }

## Controller extension

To use the utilities in ExtraController extend your controllers 
 from Jhg\ExtraBundle\Controller\ExtraController instead of Symfony 
 FrameworkBundle one.
 
    <?php 
    namespace AppBundle\Controller;
    
    use Jhg\ExtraBundle\Controller\ExtraController;
    
    class MyController extends ExtraController
    {
    
    }

Some usefull methods:

**getRepository**

    $this->getRepository('AppBundle:User')->findBy(...)
    
**trans**

    $this->trans('Some translatable text');
    
**transChoice**

    $this->transChoice('{0} There are no apples|{1} There is one apple|]1,Inf[ There are %count% apples', $count);

**addFlashTrans**

    $this->addFlashTrans('error', 'A translatable error message');

## Form handlers

### Form handler interface

The mission of Form Handlers is to encapsulate CrUD business 
 operations into one proccessor class.
 
All the forms must be validated, then some action must be done
 with contained data, and usually those actions are duplicated.

With the use of form handlers all those actions are in one method,
 and can be called anywhere.

### Doctrine Create form handler

Handler for creating doctrine entities in a CRUD controller. 

**Example**

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $element = new Element();

        $form = $this->createForm(new ElementType(), $element);

        if ($this->get('create_form_handler')->process($form, $request)) {
            return $this->redirectToRoute('success_route', ['element', $element->getId()]);
        }

        $viewData = [
            'form' => $form->createView(),
        ];

        return $this->render('ExampleBundle:Element:create.html.twig', $viewData);
    }

### Doctrine Update form handler

Handler for updating doctrine entities in a CRUD controller. 

**Example**

    /**
     * @param Element $element
     * @param Request $request
     *
     * @return Response
     */
    public function updateAction(Element $element, Request $request)
    {
        $form = $this->createForm(new ElementType(), $element);

        if ($this->get('update_form_handler')->process($form, $request)) {
            return $this->redirectToRoute('success_route', ['element', $element->getId()]);
        }

        $viewData = [
            'element' => $element,
            'form' => $form->createView(),
        ];

        return $this->render('ExampleBundle:Element:update.html.twig', $viewData);
    }


### Doctrine Delete form handler

Handler for deleting doctrine entities in a CRUD controller. 

**Example**

    /**
     * @param Element $element
     * @param Request $request
     *
     * @return Response
     */
    public function deleteAction(Element $element, Request $request)
    {
        $form = $this->createForm(new ElementType(), $element);

        if ($this->get('delete_form_handler')->process($form, $request)) {
            return $this->redirectToRoute('success_route');
        }

        $viewData = [
            'element' => $element,
            'form' => $form->createView(),
        ];

        return $this->render('ExampleBundle:Element:delete.html.twig', $viewData);
    }


