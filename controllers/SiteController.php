<?php

namespace App\Controllers;

use App\Core\Application;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\ContactForm;

/**
 * Class SiteController
 * @package App\Controllers
 */
class SiteController extends Controller
{
    public function home(): string
    {
        $message = 'guest!';

        if ($user = Application::$app->user) {

            $message = $user->getDisplayName();
        }

        return $this->render('home', [
            'message' => $message,
        ]);
    }

    public function contact(Request $request, Response $response): string
    {
        $contact = new ContactForm();

        if ($request->isPost()) {
            $contact->loadData($request->getBody());

            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }

        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}