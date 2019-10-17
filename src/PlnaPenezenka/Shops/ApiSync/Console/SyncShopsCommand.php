<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\ApiSync\Console;

use PlnaPenezenka\Shops\ApiSync\ApiSyncService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SyncShopsCommand extends Command
{
    /** @var ApiSyncService */
    private $service;

    public function __construct(ApiSyncService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    protected function configure()
    {
        $this->setname('pp:api:sync-shops');
        $this->setDescription('Synchronizes Shops and Categories with plnapenezenka API');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->service->setOutput($output);
        $this->service->execute();
    }
}
