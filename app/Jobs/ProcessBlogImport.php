<?php

namespace App\Jobs;

use App\Imports\BlogsImport;
use App\Mail\ImportStatus;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProcessBlogImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Stores the unprocessed data
     * @var object
     *
     */
    public $unprocessedData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->unprocessedData = DB::table('blog_import')->where('processed', 'No')->get();
    }

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 60;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->unprocessedData as $data) {
            $importStatus = false;
            $user = User::select('id', 'name', 'email')->findorFail($data->user_id);

            DB::table('blog_import')
                ->where('id', $data->id)
                ->update(['proccess_start_date' => date('Y-m-d h:i:s')]);

            try {
                Excel::import(new BlogsImport($user->id), $data->filepath);

                DB::table('blog_import')
                ->where('id', $data->id)
                ->update([
                    'processed' => 'Yes',
                    'proccess_end_date' => date('Y-m-d h:i:s')
                ]);

                $importStatus = true;
            } catch (\Throwable $th) {

                $importStatus =false;

                DB::table('blog_import')
                    ->where('id', $data->id)
                    ->update([
                        'processed' => 'Error',
                        'exception' => $th->getMessage()
                    ]);
            }

            // Inform to the user for uploading status
            Mail::to($user->email)->send(new ImportStatus($user, $importStatus));

            Storage::delete($data->filepath);
        }

    }
}
