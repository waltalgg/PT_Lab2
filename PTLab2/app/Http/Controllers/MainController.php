<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
    return view('home');
    }

    public function review()
    {
        $ContactModels = ContactModel::all();
        return view('review', ['ContactModels' => $ContactModels]);
    }

    public function review_check(Request $request)
    {
        $items = ['vodka', 'beer', 'wine', 'whiskey'];

        foreach ($items as $item)
        {
            $count = $request->input('count_' . $item);
            $existingItem = ContactModel::where('name', ucfirst($item))->first();

            if ($count !== null)
            {
                if ($existingItem)
                {
                    $totalCount = ContactModel::where('name', ucfirst($item))->sum('count');
                    if ($totalCount >= 10)
                    {
                        continue;
                    }
                    $diff = min(10 - $totalCount, $count);
                    $existingItem->count += $diff;
                    $existingItem->save();
                }
                else
                {
                    $newItem = new ContactModel();
                    $newItem->name = ucfirst($item);
                    $newItem->count = min(10, $count);
                    $newItem->save();
                }
            }
        }

        // После сохранения перенаправляем пользователя обратно на страницу просмотра товаров
        return redirect('/review');
    }

    public function Clear()
    {
        ContactModel::truncate();
        return redirect('/review')->with('status', 'Корзина очищена');
    }
}
