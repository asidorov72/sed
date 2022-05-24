<?php
/**
 * src/App/Helper/LoggerHelper.php
 *
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Helper;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerHelper
{
    public $logger;

    private $errorLog;

    private $infoLog;

    public function __construct(string $channel)
    {
        $this->logger = new Logger($channel);
        $this->errorLog = FileHelper::setRealPath('/log/error.log');
        $this->infoLog = FileHelper::setRealPath('/log/info.log');
    }

    /**
     * @param string $error
     * @return void
     */
    public function log(string $error)
    {
        $this->logger->pushHandler(new StreamHandler($this->errorLog, \Monolog\Logger::ERROR));
        $this->logger->error($error);
    }

    /**
     * @param string $msg
     * @return void
     */
    public function debug(string $msg)
    {
        $this->logger->pushHandler(new StreamHandler($this->infoLog, \Monolog\Logger::DEBUG));
        $this->logger->debug($msg);
    }
}
