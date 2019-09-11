<?php


namespace Foundation\File;


use Exception;

/**
 * This trait is used by PDO to run the migrations
 * Trait ReadsFiles
 * @package Foundation\File
 */
trait ReadsFiles
{

    /**
     * Read a file and return all content as a string
     * @param $filename
     * @return string
     * @throws Exception
     */
    protected function giveTheFullContent($filename): string
    {
        $handle = fopen($filename,'r');
        $content = fread($handle, filesize($filename));
        fclose($handle);
        if (!$content) {
            throw new Exception();
        }
        return $content;
    }
}