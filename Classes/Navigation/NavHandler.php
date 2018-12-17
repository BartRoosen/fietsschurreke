<?php

namespace Classes\Navigation;

use Classes\Entities\Session;

class NavHandler
{
    const PATH         = 'components/%s/index.php';
    const DEFAULT_PAGE = 'home';

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

        $_SESSION['page'] = $session->getPage();
    }

    /**
     * @return mixed
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

