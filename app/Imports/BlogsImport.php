<?php

namespace App\Imports;

use App\Models\Blog;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class BlogsImport implements ToModel, WithStartRow, WithChunkReading
{
    /**
     * Stores the user id of App\Models\User
     * @var Integer $userId
     *
     */
    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try {
            Blog::create([
                'user_id' => $this->userId,
                'title' => $row[1],
                'description' => $row[2],
                'seo_keyword' => $row[3],
                'seo_description' => $row[4],
                'view' => 0,
                'status' => $row[5],
            ]);
        } catch (\Throwable $th) {
            abort(500, 'Could not insert to blog because of ' . $th->getMessage());
        }
    }
}
