<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Console\Command;

class CreateBlog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:create
                            {title : Provide the title you want to set on blog}
                            {--user= : Provide Username if you want to create or use existing one}
                            {--status= : Provide Status For Blog (e.g A/I) Active/Inactive}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blog with default description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $title = $this->argument('title');
        $user = $this->option('user');
        $status = $this->option('status') ? $this->option('status') : 'Active';
        $description = fake()->paragraph(50, 5);

        if ($status) {
            $status = $this->setStatus($status);
        }

        $needDesc = $this->confirm('Do you want to add custom description ?');
        if($needDesc) {
            $description = $this->ask('Please Add Description');
            if (! $description) $description = fake()->paragraph(50, 5);
        }

        if (! User::find($user)) {
            $user = User::factory(['id' => $user])->create()->id;
        }

        Blog::create([
            'title' => $title,
            'user_id' => $user,
            'description' => $description,
            'view' => rand(1, 100),
            'status' => $status,
        ]);
    }

    public function setStatus($keyword) {
        if (in_array(strtolower($keyword), ['active', 'inactive'])) {
            if (strtolower($keyword) == 'active') {
                return 'Active';
            }
            if (strtolower($keyword) == 'inactive') {
                return 'InActive';
            }
        }

        print "Invalid Status Given. Acceptable is : 'Active', 'InActive'";
        exit;
    }
}
