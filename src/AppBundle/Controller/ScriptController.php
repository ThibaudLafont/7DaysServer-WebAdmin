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
        $output = $this->getScriptService()->execScript('serverState.sh');
        if(is_null($output)) {
            $return = false;
        } else {
            $return = true;
        }
        return $this->json($return);
    }

    /**
     * @Route("/start-server", name="server_start")
     */
    public function start()
    {
        $this->getScriptService()->execScript('start7days.sh');
        return $this->json(true);
    }

    /**
     * @Route("/stop-server", name="server_stop")
     */
    public function stop()
    {
        $this->getScriptService()->execScript('stop7days.sh');
        return $this->json(true);
    }

    /**
     * @Route("/reload-server", name="server_reload")
     */
    public function reload()
    {
        $this->getScriptService()->execScript('reload7days.sh');
        return $this->json(true);
    }

    /**
     * @Route("/update-server", name="server_update")
     */
    public function update()
    {
        $this->getScriptService()->execScript('update7days.sh'); 
        return $this->json(true);
    }

    /**
     * @Route("/is-update-running", name="is_update_running")
     */
    public function isUpdating()
    {
        $output = $this->getScriptService()->execScript('isUpdateRunning.sh'); 
        if(is_null($output)) {
            $return = false;
        } else {
            $return = true;
        }
        return $this->json($return);
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
