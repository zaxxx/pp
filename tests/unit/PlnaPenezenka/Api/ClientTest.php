<?php
declare(strict_types=1);

namespace Tests\Unit\PlnaPenezenka\Api;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback;
use PHPUnit\Framework\TestCase;
use PlnaPenezenka\Api\Client;
use PlnaPenezenka\Api\DataTransformer\CategoryArrayTransformer;
use PlnaPenezenka\Api\DataTransformer\ShopArrayTransformer;
use PlnaPenezenka\Api\Shops\Shop;

class ClientTest extends TestCase
{
    public function testShopsIterateCorrectly(): void
    {
        $guzzleClient = $this->createMock(GuzzleClient::class);
        $guzzleClient->expects(self::exactly(2))
            ->method('request')
            ->willReturnOnConsecutiveCalls(
                new ReturnCallback(function (string $method, string $url, array $options = []) {
                    self::assertEquals('GET', $method);
                    self::assertEquals('/shops?page=0&limit=20', $url);

                    return new Response(200, [], file_get_contents(__DIR__ . '/shops.json'));
                }),
                new ReturnCallback(function (string $method, string $url, array $options = []) {
                    self::assertEquals('GET', $method);
                    self::assertEquals('/shops?page=1&limit=20', $url);

                    return new Response(200, [], '');
                })
            );

        $client = new Client('xxx', 'yyy', $guzzleClient, new CategoryArrayTransformer(), new ShopArrayTransformer());
        $shops = $client->shops();
        foreach ($shops as $shop) {
            self::assertInstanceOf(Shop::class, $shop);
        }
    }
}
