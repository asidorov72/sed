<?php
/**
 * src/App/Helper/FileHelper.php
 *
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Helper;

use Exception;
use Console\App\Helper\LoggerHelper;

class FileHelper
{
    /**
     * Replaces a string in a file
     *
     * @param string $filePath
     * @param string $searchStr text to be replaced
     * @param string $replaceStr text
     * @param null $flag
     * @return array $Result status (success | error) & message (file exist, file permissions)
     * @throws Exception
     */
    public static function findAndReplaceStr(string $filePath, string $searchStr, string $replaceStr, $flag = null)
    {
        $result = array('status' => 'error', 'message' => '');

        $logger = new LoggerHelper('file-helper');

        $replaced = 0;

        if (file_exists($filePath)===TRUE) {

            if (is_writeable($filePath)) {

                try {
                    $fileContent = file_get_contents($filePath);
                    $fileContent = str_replace($searchStr, $replaceStr, $fileContent, $replaced);

                    if ($replaced === 0) {
                        $result["status"] = 'error';
                        $result["message"] = sprintf("Not found text '%s' in the file %s.", $searchStr, $filePath);

                        $logger->log(json_encode($result));
                    } else {
                        if (file_put_contents($filePath, $fileContent) > 0) {

                            if ($flag === null) {
                                $result["content"] = $fileContent;
                            }

                            $result["status"] = 'success';
                            $result["message"] = sprintf("Text '%s' was replaced with '%s'.", $searchStr, $replaceStr);

                            $logger->debug(json_encode($result));
                        } else {
                            $logger->log('Error while writing file.');
                            throw new Exception('Error while writing file.');
                        }
                    }
                } catch (Exception $e) {
                    $logger->log($e->getMessage());
                    throw new Exception($e->getMessage());
                }
            } else {
                $msg = 'File '.$filePath.' is not writable !';
                $logger->log($msg);
                throw new Exception($msg);
            }
        } else {
            $msg = 'File '.$filePath.' does not exist !';
            $logger->log($msg);
            throw new Exception($msg);
        }

        return $result;
    }

    /**
     * @param string $filePath
     * @return string
     */
    public static function setRealPath(string $filePath)
    {
        return dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . $filePath;
    }
}
