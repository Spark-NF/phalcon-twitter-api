<?php
use Phalcon\Mvc\User\Component;

class Elements extends Component
{
    private $_headerMenu = array(
        'navbar-left' => array(
            'index' => array(
                'caption' => 'Home',
                'action' => 'index'
            ),
            'pricing' => array(
                'caption' => 'Pricing',
                'action' => 'index'
            ),
            'history' => array(
                'caption' => 'Dashboard',
                'action' => 'index'
            ),
            'about' => array(
                'caption' => 'About',
                'action' => 'index'
            ),
            'contact' => array(
                'caption' => 'Contact',
                'action' => 'index'
            ),
        ),
        'navbar-right' => array(
            'profile' => array(
                'caption' => 'Profile',
                'action' => 'index'
            ),
            'session' => array(
                'caption' => 'Log in / Sign up',
                'action' => 'index'
            ),
        ),
    );

    private $_tabs = array(
        'History' => array(
            'controller' => 'history',
            'action' => 'index',
            'any' => false
        ),
        'Monthly' => array(
            'controller' => 'history',
            'action' => 'monthly',
            'any' => false
        ),
        'Weekly' => array(
            'controller' => 'history',
            'action' => 'weekly',
            'any' => false
        ),
        'Daily' => array(
            'controller' => 'history',
            'action' => 'daily',
            'any' => false
        ),
    );

    public function getMenu()
    {

        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = array(
                'caption' => 'Log out',
                'action' => 'end'
            );
        } else {
            unset($this->_headerMenu['navbar-left']['history']);
            unset($this->_headerMenu['navbar-right']['profile']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
                echo '<ul class="nav navbar-nav ', $position, '">';
                foreach ($menu as $controller => $option) {
                    if ($controllerName == $controller) {
                        echo '<li class="active">';
                    } else {
                        echo '<li>';
                    }
                    echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                    echo '</li>';
                }
                echo '</ul>';
            echo '</div>';
        }

    }

    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '<li>';
        }
        echo '</ul>';
    }
}
