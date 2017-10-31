<?php

namespace App\Http\Controllers;

use App\Books;
use App\Http\Requests\BookRequestForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function PHPSTORM_META\type;

class BooksController extends Controller
{
    protected function create()
    {
        return view('books.create');
    }

    /**
     * @param BookRequestForm $form
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function store(BookRequestForm $form)
    {
        $form->persist();
        return redirect('home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function delete()
    {

        $book_id = intval(request('book_id'));
        \DB::transaction(function ( ) use(&$book_id){
            Books::where('id', '=', $book_id)->delete();
        });

        return redirect('home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function sort()
    {
        session()->flash('sort', request('sort'));
        return redirect('home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function order()
    {
        $incoming = $this->getIncomingBook(request());
        $order = intval(request('order'));
        $user_id = auth()->id();
        $original = $this->getOriginalBook($order, $user_id);
        $this->swapOrder($incoming, $original, $user_id);

        return redirect('home');
    }

    /**
     * @param $data
     * @return Books
     */
    protected function getIncomingBook($data)
    {
        return Books::where('user_id', '=', auth()->id())
            ->where('id', '=', $data['book_id'])
            ->first();
    }

    /**
     * @param $order
     * @param $user_id
     * @return null
     */
    protected function getOriginalBook($order , $user_id)
    {
        $count = 0;
        $ret = null;
        Books::where('user_id', '=', $user_id)->each(function ($item) use(&$count, &$order, &$ret) {
            $count++;
            $ret = null;
            if($count === $order)
            {
                $ret = $item;
                return false;
            }
            return true;
        });
        return $ret;
    }

    /**
     * @param $incoming
     * @param $original
     * @param $user_id
     */
    protected function swapOrder($incoming, $original, $user_id)
    {
        // set the incoming to the original books position
        try {
            DB::transaction(function () use(&$incoming, &$original, $user_id) {
                Books::where('user_id', '=', $user_id)
                    ->where('id', '=', $original->id)
                    ->update(['title' => $incoming->title,
                        'author' => $incoming->author,
                        'publication' => $incoming->publication,
                        'image' => $incoming->image
                    ]);
            });
        } catch (\Exception $e)
        {
            \Log::info('Failed to complete update' . $e->getMessage());
        }

        // set original to the incoming books position
        try {
            DB::transaction(function () use(&$incoming, &$original, $user_id) {
                Books::where('user_id', '=', $user_id)
                    ->where('id', '=', $incoming->id)
                    ->update(['title' => $original->title,
                        'author' => $original->author,
                        'publication' => $original->publication,
                        'image' => $original->image
                    ]);
            });
        } catch (\Exception $e) {
            \Log::info('Failed to complete update' . $e->getMessage());
        }
    }
}
