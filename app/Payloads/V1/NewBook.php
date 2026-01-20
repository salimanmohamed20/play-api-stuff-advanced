<?php
declare(strict_types=1);
namespace App\Payloads\V1;



final readonly class NewBook
{
    public function __construct(
        public string $title,
   
        public string $publisher,
        public string $publication_date,
        public string $description,
    )
    {
        
    }


    public function toArray(string $user):array
    {
        return [
            'title'=>$this->title,
            'user_id'=>$user,
            'publisher'=>$this->publisher,
            'publication_date'=>$this->publication_date,
            'description'=>$this->description,
        ];
    }
}
