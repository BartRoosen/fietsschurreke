<?php

namespace Classes\Navigation;

use Classes\Entities\Session;

class NavHandler
{
    const PATH            = 'components/%s/index.php';
    const DEFAULT_PAGE    = 'home';
    const DEFAULT_PICTURE = 'banner-home';

    /**
     *
     */
    private function connect()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->connect();

        if (null === $session->getPage()) {
            $session->setPage(self::DEFAULT_PAGE);
        }

        if (null === $session->getPicture()) {
            $session->setPicture(self::DEFAULT_PICTURE);
        }

        $_SESSION['page']    = $session->getPage();
        $_SESSION['picture'] = $session->getPicture();
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        $this->connect();

        $session = new Session();

        $sessionPage    = isset($_SESSION['page']) ? $_SESSION['page'] : self::DEFAULT_PAGE;
        $sessionPicture = isset($_SESSION['picture']) ? $_SESSION['picture'] : self::DEFAULT_PICTURE;

        $session->setPage($sessionPage);
        $session->setPicture($sessionPicture);

        return $session;
    }

    /**
     * @return string
     */
    public function getPagePath()
    {
        $this->connect();

        if (!isset($_SESSION['page'])) {
            $session = new Session();
            $this->setSession($session);
        }

        return sprintf(self::PATH, $_SESSION['page']);
    }

    /**
     * @return string
     */
    public function getPage()
    {
        $this->connect();

        if (!isset($_SESSION['page'])) {
            $session = new Session();
            $this->setSession($session);
        }

        return $_SESSION['page'];
    }
}
