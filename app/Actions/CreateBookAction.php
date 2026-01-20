<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataObjects\Auth\RegisterUser;
use App\Models\User;
use App\Payloads\V1\NewBook;
use Illuminate\Database\DatabaseManager;
use App\Models\Book;



final readonly class CreateBookAction
{
    public function __construct(
        private DatabaseManager $database,
        private string $user,
    ) {}

    public function handle(NewBook $payload): Book
    {
        return $this->database->transaction(
            callback: fn() => Book::query()->create(
                attributes: $payload->toArray(
                   user:$this->user,
                ),
            ),
            attempts: 3,
        );
    }
}