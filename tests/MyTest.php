<?php

namespace App\tests;

use App\main\App;
use App\repositories\CartRepository;
use App\services\CartService;
use App\services\OrderService;
use App\services\Request;
use App\services\UserService;
use PHPUnit\Framework\TestCase;

class CartServiceTest extends TestCase
{
    /**
     *  
     * @param $sum
     * @param $cart
     *
     * @dataProvider getData
     */
    public function testGetCartTotalSum($sum, $cart)
    {

        $mockRequest = $this->createMock(Request::class);
        $mockRequest->method('session')->willReturn($cart);

        /**
         * @var MockObject|Request $mockRequest
         */
        $cartService = new CartService();
        $result = $cartService->getCartTotalSum($mockRequest);

        $this->assertEquals($result, $sum);
    }

    public function getData()
    {
        return [
            [500, [['price' => 100, 'count' => 5]]],
            [600, [['price' => 100, 'count' => 6]]],
        ];
    }
}

class OrderServiceTest extends TestCase
{
    public function testGetListOfStatus()
    {
        $orderService = new OrderService();
        $result = $orderService->getListOfStatus();

        $this->assertIsArray($result);
    }

    public function testGetListOfStatus2()
    {
        $orderService = new OrderService();
        $result = $orderService->getListOfStatus();

        $this->assertCount(5, $result);
    }
}

class UserServiceTest extends TestCase
{
    public function testIsAdmin()
    {
        $mockRequest = $this->createMock(Request::class);
        $mockRequest->method('session')->willReturn(['is_admin' => false]);

        $userService = new UserService();
        /**
         * @var MockObject|Request $mockRequest
         */
        $result = $userService->isAdmin($mockRequest);

        $this->assertFalse($result);
    }
}

class CartRepositoryTest extends TestCase
{
    public function testGetItemsId()
    {
        $mockApp = $this->createMock(App::class);
        $mockRequest = $this->createMock(Request::class);
        $mockRequest->method('session')->willReturn(['id' => 10, 'count' => 100, 'desc' => 'text']);
        $mockApp->request = $mockRequest;

        $cartRepository = new CartRepository();
        /**
         ** @var MockObject|App $mockApp
         */
        $result = $cartRepository->getItemsId($mockApp);

        $this->assertIsArray($result);
        $this->assertArrayHasKey(':0', $result);
        $this->assertContains('count', $result);
    }
}
