<?php
namespace AppBundle\Service;

class Script
{
    /**
     * @var string
     */
    private $scriptDir;

    public function __construct(string $scriptDir)
    {
        $this->setScriptDir($scriptDir);
    }

    public function execScript(string $scriptName)
    {
        return shell_exec($this->generateScriptPath($scriptName));
    }

    private function generateScriptPath($scriptName)
    {
        return $this->getScriptDir() . $scriptName;
    }

    /**
     * @return string
     */
    public function getScriptDir()
    {
        return $this->scriptDir;
    }

    /**
     * @param string $scriptDir
     */
    public function setScriptDir($scriptDir)
    {
        $this->scriptDir = $scriptDir;
    }
}