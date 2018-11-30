<?php

namespace AppBundle\Controller;

use AppBundle\Service\Logs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LogsController extends Controller
{
    private $logsService;

    public function __construct(Logs $logsService)
    {
        $this->setLogsService($logsService);
    }

    /**
     * @Route("/get-logs", name="get_logs")
     */
    public function getlogs()
    {
        $logs = $this->getLogsService()->getMostRecentLogFile('/home/');
        return $this->json(array_reverse($logs));
    }

    /**
     * @Route("/logs", name="logs")
     */
    public function logs()
    {
        return $this->render('default/logs.html.twig', compact('logs'));
    }

    /**
     * @return mixed
     */
    public function getLogsService() : Logs
    {
        return $this->logsService;
    }

    /**
     * @param mixed $logs
     */
    public function setLogsService(Logs $logs)
    {
        $this->logsService = $logs;
    }
}
