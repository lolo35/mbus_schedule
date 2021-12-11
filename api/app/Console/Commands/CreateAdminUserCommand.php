<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\AdminUsers;

class CreateAdminUserCommand extends Command {
    protected $signature = "create:user {--user=} {--password=}";
    protected $description = "Creates a admin user";

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        $user = $this->option('user');
        $password = hash('sha256', $this->option('password'));
        $this->info("creating admin user $user with password $password");
        $insert = new AdminUsers();
        $insert->division = "TRO";
        $insert->username = $user;
        $insert->password = $password;
        $insert->active = 1;
        $insert->type = 1;
        $insert->save();
    }
}