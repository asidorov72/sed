<?php
/**
 * src/App/Service/ICommandHandler.php
 *
 * @author Alexander Sidorov
 * @email alexsidorov1972@gmail.com
 * @date 16-05-2022
 */

namespace Console\App\Service;

interface ICommandHandler
{
    public function handle(array $params):array;
}