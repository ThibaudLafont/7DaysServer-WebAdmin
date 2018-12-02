<?php

namespace AppBundle\Controller;

use AppBundle\Service\Logs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ScriptController extends Controller
{
    /**
     * @Route("/server-state", name="server_state")
     */
    public function state()
    {
        return $this->json(false);
    }

    /**
     * @Route("/start-server", name="server_start")
     */
    public function start()
    {
        return $this->json(false);
    }

    /**
     * @Route("/stop-server", name="server_stop")
     */
    public function stop()
    {
        return $this->json(false);
    }

    /**
     * @Route("/reload-server", name="server_reload")
     */
    public function reload()
    {
        return $this->json(false);
    }

    /**
     * @Route("/update-server", name="server_update")
     */
    public function update()
    {
        return $this->json(false);
    }

}
