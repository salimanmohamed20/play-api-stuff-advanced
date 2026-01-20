<?php

namespace App\Jobs\Books\V1;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Payloads\V1\NewBook;
use Illuminate\Database\DatabaseManager;

use function PHPUnit\Framework\callback;
use App\Models\Book;
use App\Actions\CreateBookAction;



class CreateBook implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public readonly NewBook $book, public string $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(CreateBookAction $action): void
    {
        
        $action->handle($this->book);
      
    }
}
