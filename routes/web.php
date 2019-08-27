<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Book;
use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('books');
// });


Route::get('/',function() {
  $books = Book::all();
  return view('books',[
    'books' => $books
  ]);
});

Route::post('/book',function(Request $request){
  $validator = Validator::make($request->all(),[
    //nameを必須かつ255文字以内でのvalidation
    'name' => 'required|max:255',
  ]);

  if($validator->fails()){
    return redirect('/')
    ->withInput()
    ->withErrors($validator);
  }

  $book = new Book; //ORM
  $book->title = $request->name;
  $book->save();

  return redirect('/');

});

Route::delete('/book',function(Book $book){

});
