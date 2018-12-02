<?php
namespace AppBundle\Entity;

class Log
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $content;

    /**
     * Log constructor.
     * @param $logLine
     */
    public function __construct($logLine)
    {
        $this->determineType($logLine);
        $this->setContent($logLine);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    private function determineType($logLine)
    {
        // ERROR => ERR
        if(preg_match('/ERR/', $logLine)) {
            $this->setType('error');
        // WARNING => WRN
        } elseif (preg_match('/WRN/', $logLine)) {
            $this->setType('warning');
        } elseif (preg_match('/INF/', $logLine)) {
            $this->setType('info');
        } else {
            $this->setType('common');
        }
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }


}