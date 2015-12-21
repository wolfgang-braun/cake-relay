<?php
namespace App\Controller;

use App\Lib\Status;
use App\Model\Entity\SupplierProfile;
use App\Model\Entity\User;
use Cake\Event\EventManager;
use Cake\Routing\Router;

class LoginController extends AppController
{
    /**
     * beforeFilter event
     *
     * @param Event $event cake event
     * @return void
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->loadModel('Users');
        parent::beforeFilter($event);
    }

    /**
     * login method
     *
     * @return void
     */
    public function login()
    {
        if (!$this->request->session()->started()) {
            $this->request->session()->start();
        }
        if (!empty($this->request->query('redirectUrl'))) {
            $this->request->session()->write('Auth.redirect', $this->request->query('redirectUrl'));
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $userData = $this->Auth->identify();
            if ($userData) {
                if ($this->request->data['cookie']) {
                    $this->AuthUtils->addRememberMeCookie($userData['id']);
                }
                $this->Auth->setUser($userData);
                return $this->redirect($this->Auth->redirectUrl());
            } elseif ($this->Users->hasLoginRetriesLock($this->request->data)) {
                $this->Flash->error(__('login.login_retries_lock'));
            } else {
                $this->Users->increaseLoginRetries($this->request->data);
                $this->Flash->error(__('login.wrong_credentials'));
            }
        }
        $this->set('user', $user);
    }

    /**
     * logout method
     *
     * @return void
     */
    public function logout()
    {
        $this->Flash->success(__('login.you_have_been_logged_out'));
        if ($this->request->session()->started()) {
            $this->request->session()->destroy();
        }
        $this->AuthUtils->destroyRememberMeCookie();
        return $this->redirect($this->Auth->logout());
    }

    /**
     * new password for users
     *
     * @return void
     */
    public function forgotPassword()
    {
        $this->layout = 'plain';
        if ($this->request->is('post') && !empty($this->request->data['email'])) {
            $user = $this->Users->getUserByEmail($this->request->data['email']);

            if (empty($user)) {
                return $this->Flash->error(__('login.unknown_email'));
            }

            EventManager::instance()->dispatch(new \Cake\Event\Event('Users.forgot_password', $this, [
                'user' => $user
            ]));
            $this->Flash->default(__('login.restore_password_email_sent'), true);

            $plugin = false;
            if (!empty($user->role) && $user->role === User::ROLE_ADMIN) {
                $plugin = 'admin';
            }
            return $this->redirect([
                'plugin' => $plugin,
                'action' => 'login'
            ]);
        } else {
            return $this->Flash->error(__('login.email_required'));
        }
    }

    /**
     * restores password
     *
     * @param int $userId userId
     * @param string $token token
     * @return void
     */
    public function restorePassword($userId, $token)
    {
        $this->layout = 'plain';
        if (!empty($userId) && !empty($token)) {
            $user = $this->Users->get($userId);
            if (!empty($user)) {
                $userHash = $this->Users->getHash($user);

                $timestamp = substr($token, -10);
                $hash = substr($token, 0, -10);
                $time = new \Cake\I18n\Time($timestamp);
                $expire = '1 day';

                if (!($hash === $userHash && $time->wasWithinLast($expire))) {
                    $this->Flash->error(__('login.restore_password_link_invalid'));
                    return $this->redirect(['action' => 'login']);
                }
            }
            // Save new Password
            if ($this->request->is(['patch', 'post', 'put'])) {
                if (empty($this->Users->changePassword($user, $this->request->data)->errors())) {
                    $this->Users->resetLoginRetries($user);
                    $this->Flash->success(__('login.new_password_saved'));
                    return $this->redirect(['action' => 'login']);
                } else {
                    $this->Flash->error(__('login.invalid_password'));
                }
            }
        } else {
            return $this->redirect(['action' => 'login']);
        }
        $this->set(compact('user'));
    }
}
