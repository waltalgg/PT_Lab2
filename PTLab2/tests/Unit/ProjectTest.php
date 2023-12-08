<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ContactModel;
use App\Http\Controllers\MainController;



class ProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     */

    use RefreshDatabase;

    // Тест открытия главной страницы
    public function test_home()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    // Тест открытия review
    public function test_review()
    {
        $response = $this->get('/review');
        $response->assertStatus(200);
    }

    // Тест отработки очистки корзины
    public function test_clear_method()
    {
        $response = $this->get('/clear');
        $response->assertStatus(302);
    }

    // Тест на отработку /review/check методом post
    public function test_review_check_post()
    {
        $response = $this->post('/review/check');
        $response->assertStatus(302);
    }

    // Тест на обраотку /review/check методом get
    public function test_review_check_get()
    {
        $response = $this->get('/review/check');
        $response->assertStatus(405);
    }

    // Тест лимита корзины в 10 единиц каждого товара
    public function test_limit10()
    {
        $limit_check = 15;
        $response = $this->post('/review/check', [
            'count_vodka' => $limit_check,
            'count_beer' => $limit_check,
            'count_wine' => $limit_check,
            'count_whiskey' => $limit_check,
        ]);

        $this->assertEquals(10, ContactModel::where('name', 'Vodka')->first()->count);
        $this->assertEquals(10, ContactModel::where('name', 'Beer')->first()->count);
        $this->assertEquals(10, ContactModel::where('name', 'Wine')->first()->count);
        $this->assertEquals(10, ContactModel::where('name', 'Whiskey')->first()->count);
    }

    // Тест "склеивания" товаров одного вида / типа
    public function test_merge_items()
    {
        $count1 = 5;
        $count2 = 3;
        $response1 = $this->post('review/check', [
            'count_vodka' => $count1,
        ]);
        $response2 = $this->post('review/check', [
            'count_vodka' => $count2,
        ]);

        $contactModel = ContactModel::where('name', 'Vodka')->first();

        $this->assertEquals(8, $contactModel->count);
        $this->assertEquals(1, $contactModel::where('name', 'Vodka')->count());
    }
    // Тест пустой корзины после покупки
    public function test_clear_cart_after_purchase()
    {
        $response1 = $this->post('review/check',
        [
            'count_vodka' => 3,
            'count_whiskey' => 2,
        ]);

        $this->assertNotEmpty(ContactModel::where('name', 'Vodka')->first());
        $this->assertNotEmpty(ContactModel::where('name', 'Whiskey')->first());

        $response2 = $this->get('/clear');

        $this->assertEmpty( ContactModel::all());

    }

}
