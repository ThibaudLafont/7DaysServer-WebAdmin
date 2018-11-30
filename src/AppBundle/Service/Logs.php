<?php
namespace AppBundle\Service;

class Logs
{
    public function getMostRecentLogFile($baseDir)
    {
        // Get log files form base dir
        $logFiles = $this->getLogsFileFromDir($baseDir);

        // Return most recent file
        return file($this->getMostRecent($logFiles)['path']);
    }

    private function getLogsFileFromDir($baseDir)
    {
        // Store all files from base directory
        $files = scandir($baseDir);

        // Loop on files
        $goodFiles = [];
        foreach ($files as $file) {
            // If file is a log
            if(preg_match('/^output_log__/', basename($file))) {
                // Generate path and date of file
                $filePath = $baseDir . $file;
                $rawDate = date('d/m/Y h:i:s', filemtime($filePath));
                $date = \DateTime::createFromFormat('d/m/Y h:i:s', $rawDate);

                // Store file for return
                $goodFiles[] = [
                    'path' => $filePath,
                    'date' => $date
                ];
            }
        }

        return $goodFiles;
    }

    private function getMostRecent($files)
    {
        // Loop on goodfiles
        $recent = null;
        foreach ($files as $key=>$actual) {
            // If nor first file
            if($key !== 0){
                // Determine diff with most recent
                $diff = $actual['date']->diff($recent['date'], false)->format('%R');

                // If diff is negative, actual is more recent
                if($diff === "-"){
                    $recent = $actual;
                } else {
                    // TODO: Delete file
                }
            // If first file, store it as most recent
            } else {
                $recent = $actual;
            }
        }

        return $recent;
    }
}