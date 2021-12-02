<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Traits\ApiResponder;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    use ApiResponder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return list of authors
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return $this->successResponse($authors);
    }

    /**
     * Create a new author
     * 
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:200',
            'gender' => 'required|max:10|in:male,female',
            'country' => 'required|max:200'
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * Show an existing author
     * 
     * @return Illuminate\Http\Response
     */
    public function show($author)
    {
        $author = Author::findOrFail($author);

        return $this->successResponse($author);
    }

    /**
     * Update an existing author
     * 
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $author)
    {
        $rules = [
            'name' => 'max:200',
            'gender' => 'max:10|in:male,female',
            'country' => 'max:200'
        ];

        $this->validate($request, $rules);

        $author = Author::findOrFail($author);
        $author->fill($request->all());
        if($author->isClean()){
            return $this->errorResponse('Atleast one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $author->save();

        return $this->successResponse($author); 
    }

    /**
     * Delete an existing author
     * 
     * @return Illuminate\Http\Response
     */
    public function destroy($author)
    {
        $author = Author::findOrFail($author);
        $author->delete();
        return $this->successResponse($author);
    }
}
