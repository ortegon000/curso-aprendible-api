<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_books()
    {
        $books = Book::factory(10)->create();
        
        $this->getJson(route('books.index'))
            ->assertJsonFragment([
                'title' => $books[0]->title,
            ])
            ->assertJsonFragment([
                'title' => $books[1]->title,
            ]);
    }

    function test_can_get_one_book()
    {
        $book = Book::factory()->create();

        $this->getJson(route('books.show', $book))
            ->assertJsonFragment([
                'title' => $book->title
            ]);
    }

    function test_can_create_books() 
    {
        $this->postJson(route('books.store', []))
            ->assertJsonValidationErrorFor('title');

        $this->postJson(route('books.store'), [
                'title' => 'My new book'
            ])
            ->assertJsonFragment([
                'title' => 'My new book'
            ]);

        $this->assertDatabaseHas('books', [
                'title' => 'My new book'
            ]);
    }

    function test_can_update_books() {
        $book = Book::factory()->create();

        $this->patchJson(route('books.update', $book), [])
            ->assertJsonValidationErrorFor('title');

        $this->patchJson(route('books.update', $book), [
                'title' => 'Edited book'
            ])
            ->assertJsonFragment([
                'title' => 'Edited book'
            ]);

        $this->assertDatabaseHas('books', [
                'title' => 'Edited book'
            ]);
    }

    function test_can_delete_books()
    {
        $book = Book::factory()->create();

        $this->deleteJson(route('books.destroy', $book))
            ->assertNoContent();

        $this->assertDatabaseCount('books', 0);
    }
}
