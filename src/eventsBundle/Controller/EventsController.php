<?php

namespace eventsBundle\Controller;

use eventsBundle\Entity\Events;
use eventsBundle\Entity\InscriptionE;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 */
class EventsController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('eventsBundle:Events')->findAll();

        return $this->render('@events/Events/index.html.twig', array(
            'events' => $events,
        ));
    }

    public function myEventsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->container->get('security.token_storage')->getToken()->getUser();
        $query=$em->createQuery('Select i from eventsBundle:InscriptionE i where i.user=:user ')->setParameter('user', $user);
        $inscriptions=$query->getResult();


        return $this->render('@events/Events/hh.html.twig', array(
            'query' => $inscriptions,
        ));
    }
    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $event = new Events();
        $form = $this->createForm('eventsBundle\Form\EventsType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('events_show', array('idEvent' => $event->getIdevent()));
        }

        return $this->render('@events/Events/new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Events $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $user = $this->getUser();
        if ($user != null) {
            $em = $this->getDoctrine()->getManager();
            $i = $em->getRepository('eventsBundle:InscriptionE')->findBy(array('user' => $this->getUser()));
            $inss = array();
            foreach ($i as $ii) {
                array_push($inss, $ii->getEvent()->getId());
            }
            return $this->render('@events/Events/show.html.twig', array(
                'event' => $event,
                'delete_form' => $deleteForm->createView(),
                'inss' => $inss,
            ));
        } else
            $inss = array();


        return $this->render('@events/Events/show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
            'inss' => $inss,
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Events $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('eventsBundle\Form\EventsType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('events_edit', array('idEvent' => $event->getId()));
        }

        return $this->render('@events/Events/edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Events $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('events_index');
    }


    /**
     * Creates a form to delete a event entity.
     *
     * @param Events $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Events $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('events_delete', array('idEvent' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function inscriptionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ins = new InscriptionE();

        $nb= $em->getRepository('eventsBundle:Events')->find($id);
        $nb->setPlaceDispo($nb->getPlaceDispo()-1);
        $ins->setEvent($nb);
        $ins->setUser($this->getUser());
        $em->persist($ins);

        $em->flush();
        return $this->redirectToRoute('events_index');
    }


    public function desinscriptionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //$event=$em->getRepository('eventsBundle:Events')->find($id);
        $nb= $em->getRepository('eventsBundle:Events')->find($id);
        $nb->setPlaceDispo($nb->getPlaceDispo()+1);
        $ins = $em->getRepository('eventsBundle:InscriptionE')->findOneBy(array('user'=>$this->getUser()));
        $em->remove($ins);
        $em->flush();
        return $this->redirectToRoute('events_index');
    }


}
