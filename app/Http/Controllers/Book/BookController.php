<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::get();
        return response(compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookRequest $request)
    {
        $input = $request->validated();
        if (!Book::create($input)) {
            return response()->json([
                'code' => 1,
                'error' => ['message' => 'The book is not created successfully']
            ], 500);
        }

        return response()->json(['code'=> 0], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBookRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $input = $request->validated();

        if (!Book::findOrFail($id)->update($input)) {
            return response()->json([
                'code' => 1,
                'error' => ['message' => 'This book doesn\'t updated]']
            ], 500);
        }

        $updatedBook = Book::findOrFail($id);
        return response()->json(['code'=> 0,'updatedBook' => $updatedBook], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!$book = Book::findOrFail($id)) {
            return response()->json(
                [
                    'code' => 1,
                    'error'=>['message'=>'This book doesnt exist!']
                ], 404);
        }

        $book->delete();

        return response()->json(['code'=>0],200);
    }
}
