<?php
class ContactController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Contact us');
        parent::initialize();
    }

    public function indexAction()
    {
        $this->view->form = new ContactForm;
    }

    public function sendAction()
    {
        if (!$this->request->isPost())
            return $this->forward('contact/index');

        // Form
        $form = new ContactForm();
        $contact = new Contact();

        // Form validation
        $data = $this->request->getPost();
        if (!$form->isValid($data, $contact)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('contact/index');
        }

        // Error handling
        if (!$contact->save()) {
            foreach ($contact->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('contact/index');
        }

        // Success
        $this->flash->success('Thanks, we will contact you in the next few hours');
        return $this->forward('index/index');
    }
}
