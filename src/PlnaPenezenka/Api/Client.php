<?php
declare(strict_types=1);

namespace PlnaPenezenka\Api;

use Generator;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\TransferException;
use PlnaPenezenka\Api\DataTransformer\CategoryArrayTransformer;
use PlnaPenezenka\Api\DataTransformer\ShopArrayTransformer;
use PlnaPenezenka\Api\Exception\ClientException;
use PlnaPenezenka\Api\Shops\Category;
use PlnaPenezenka\Api\Shops\Shop;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private const SHOPS_LIMIT = 20;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var GuzzleClient */
    private $client;

    /** @var string|null */
    private $authToken;

    /** @var CategoryArrayTransformer */
    private $categoryArrayTransformer;

    /** @var ShopArrayTransformer */
    private $shopArrayTransformer;

    public function __construct(
        string $username,
        string $password,
        GuzzleClient $client,
        CategoryArrayTransformer $categoryArrayTransformer,
        ShopArrayTransformer $shopArrayTransformer
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->client = $client;
        $this->categoryArrayTransformer = $categoryArrayTransformer;
        $this->shopArrayTransformer = $shopArrayTransformer;
    }

    /**
     * @throws ClientException
     */
    public function authenticate(): void
    {
        $response = $this->request('POST', '/authenticate', [
            'json' => [
                'method' => 'credentials',
                'data' => [
                    'username' => $this->username,
                    'password' => $this->password,
                ],
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $this->authToken = $data['token'] ?? null;
    }

    /**
     * @return Generator|Shop[]
     * @throws ClientException
     */
    public function shops(): Generator
    {
        $page = 0;
        do {
            $query = http_build_query([
                'page' => $page,
                'limit' => self::SHOPS_LIMIT,
            ]);
            $response = $this->request('GET', '/shops?' . $query);

            $data = json_decode($response->getBody()->getContents(), true);

            $list = $data['list'] ?? [];

            foreach ($list as $item) {
                yield $this->shopArrayTransformer->transform($item);
            }

            $page++;
        } while (count($list) > 0);
    }

    /**
     * @return Generator|Category[]
     * @throws ClientException
     */
    public function categories(): Generator
    {
        $response = $this->request('GET', '/shop-categories');

        $data = json_decode($response->getBody()->getContents(), true);

        $list = $data['list'] ?? [];

        foreach ($list as $item) {
            yield $this->categoryArrayTransformer->transform($item);
        }
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws ClientException
     */
    private function request(string $method, string $url, array $options = []): ResponseInterface
    {
        try {
            return $this->client->request($method, $url, $options);
        } catch (TransferException $e) {
            throw new ClientException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
