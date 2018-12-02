<?php

namespace AppBundle\Controller;

use AppBundle\Service\Logs;
use AppBundle\Service\Script;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ScriptController extends Controller
{
    /**
     * @var Script
     */
    private $scriptService;

    public function __construct(Script $scriptService)
    {
        $this->setScriptService($scriptService);
    }

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

    /**
     * @return Script
     */
    public function getScriptService()
    {
        return $this->scriptService;
    }

    /**
     * @param Script $scriptService
     */
    public function setScriptService($scriptService)
    {
        $this->scriptService = $scriptService;
    }

}
