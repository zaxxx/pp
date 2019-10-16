<?php
declare(strict_types=1);

namespace PlnaPenezenka\Shops\ApiSync;

use PlnaPenezenka\Api\Client;
use PlnaPenezenka\Api\Exception\ClientException;
use PlnaPenezenka\Shops\ApiSync\DataTransformer\ApiCategoryTransformer;
use PlnaPenezenka\Shops\ApiSync\DataTransformer\ApiShopTransformer;
use PlnaPenezenka\Shops\ApiSync\Exception\ApiSyncException;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\OutputInterface;

class ApiSyncService
{
    /** @var Client */
    private $client;

    /** @var ApiCategoryTransformer */
    private $apiCategoryTransformer;

    /** @var ApiShopTransformer */
    private $apiShopTransformer;

    /** @var ApiSyncStorage */
    private $storage;

    /** @var OutputInterface */
    private $output;

    public function __construct(
        Client $client,
        ApiCategoryTransformer $apiCategoryTransformer,
        ApiShopTransformer $apiShopTransformer,
        ApiSyncStorage $storage
    ) {
        $this->client = $client;
        $this->apiCategoryTransformer = $apiCategoryTransformer;
        $this->apiShopTransformer = $apiShopTransformer;
        $this->storage = $storage;
        $this->output = new NullOutput();
    }

    public function setOutput(OutputInterface $output): void
    {
        $this->output = $output;
    }

    /**
     * @throws ApiSyncException
     */
    public function execute(): void
    {
        try {
            $this->client->authenticate();

            foreach ($this->client->categories() as $apiCategory) {
                $category = $this->apiCategoryTransformer->transform($apiCategory);
                $this->storage->saveCategory($category);
                $this->output->writeln("Saved category {$category->getPpApiId()}");
            }

            $this->storage->flush();

            foreach ($this->client->shops() as $apiShop) {
                $shop = $this->apiShopTransformer->transform($apiShop);
                $this->storage->saveShop($shop);
                $this->output->writeln("Saved shop {$shop->getPpApiId()}");
            }

            $this->storage->flush();
        } catch (ClientException $e) {
            throw new ApiSyncException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
