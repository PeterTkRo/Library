<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Book as BookRequest;
use Illuminate\Routing\Redirector;

class Library extends Controller
{
    /**
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function index(Request $request): \Illuminate\Foundation\Application|View|Factory|Redirector|RedirectResponse|Application
    {

        $booksQuery = Book::query()->select(['id', 'ISBN', 'name', 'author', 'genre']);
        $filterInputs = [
            'name' => 'like',
            'ISBN' => 'like',
            'author' => 'like',
            'genre' => '='];
        foreach ($filterInputs as $columnName => $operator) {
            $continue = false;
            if ($searchData = $request->get($columnName)){
                $search[$columnName] = $searchData;
                switch ($operator) {
                    case 'like':
                        $searchData = '%' . str_replace(' ', '%', $searchData) . '%';
                        break;
                    case '=':
                        if((int) $searchData < 0) {
                            $continue = true;
                        }
                }
                if ($continue) continue;
                $booksQuery->where($columnName, $operator, $searchData);
            }
        }
        $books = $booksQuery->paginate(20);
        if ($books->isEmpty() && Book::query()->first('id')->exists() && !isset($search)) {
           return redirect(route('library'));
        }
        return view('library.list', [
            'books' => $books,
            'title' => 'Books',
            'genres' => Book::GENRES,
            'search' => $search ?? [],
        ]);
    }

    /**
     * @param Request $request
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function create(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('library.form', [
            'title' => 'Add new Book',
            'genres' => Book::GENRES,
        ]);
    }

    /**
     * @param Request $request
     * @param Book $book
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Request $request, Book $book): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('library.view', [
            'book' => $book,
            'title' => 'Book ' . $book->name,
            'genres' => Book::GENRES,
        ]);
    }

    /**
     * @param Request $request
     * @param Book $book
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Request $request, Book $book): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('library.form', [
            'title' => 'Add new Book',
            'genres' => Book::GENRES,
            'book' => $book
        ]);
    }

    /**
     * @param BookRequest $request
     * @param Book|null $book
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function save(BookRequest $request, Book $book = null): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $bookToSave = $request->validated();
        if (!Book::query()
            ->Where('name', $bookToSave['name'])
            ->whereNot('id',$book->id ?? 0)->get('id')->isEmpty()
            ||
            !Book::query()
                ->Where('ISBN', $bookToSave['ISBN'])
                ->whereNot('id',$book->id ?? 0)->get('id')->isEmpty()
        ) {
            return redirect()->back()->withErrors('Name and ISBN must be unique');
        }
        $book = Book::query()->updateOrCreate(['id' => $book->id ?? -1], $bookToSave);
        return redirect(route('library'))->with('success', 'Success save book ' . $book->name);
    }

    /**
     * @param Request $request
     * @param Book $book
     * @return RedirectResponse
     */
    public function delete(Request $request, Book $book): RedirectResponse
    {
        $book->delete();
        return redirect()->back()->with('success', 'You success delete Book ' . $book->name);
    }
}
