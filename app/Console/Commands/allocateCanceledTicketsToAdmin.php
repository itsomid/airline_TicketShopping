<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Console\Command;

class allocateCanceledTicketsToAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:allocate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'find canceled tickets and your customers who purchased these tickets and allocate an admin user to follow up the situation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $tickets = Ticket::canceled()->get();

//         return $users = User::admin()->withCount('adminTickets')->orderBy('admin_tickets_count', 'asc')->get();

        foreach ($tickets as $ticket) {
            $user = User::admin()->withCount('adminTickets')->orderBy('admin_tickets_count', 'asc')->first();
            $ticket->allocated_to_admin_id = $user->id;
            $ticket->save();
        }
        $this->info('Tickets allocate was successful!');
    }
}
