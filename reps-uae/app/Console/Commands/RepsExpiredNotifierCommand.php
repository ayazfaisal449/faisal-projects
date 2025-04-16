<?php

use Illuminate\Console\Command;

//Raimun of Cranium Creations
class RepsExpiredNotifierCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'reps:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends email to trainers whose membership is almost expiring.';

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
     * @return mixed
     */
    public function fire()
    {
        //* * * * * /full/path/of/your/php -q /path/to/the/artisan.php <command:name>
        
        $expiring_now = Trainer::getExpiringTrainers();
        $data = array();
        
        if ($expiring_now->count() > 0) {
            
            $emails = array();
            
            foreach ($expiring_now as $itm) {
                $trainer = array(
                    'reps_id'=>$itm->reps_id,
                    'expiry_date'=>$itm->expiry_date,
                    'email'=>$itm->users->email, //$itm->users->email
                    'name'=>trim($itm->users->first_name) . ' ' . trim($itm->users->last_name)
                );
                $data[] = $trainer;
                Mail::send('trainer.mail.almostExpiring2', $trainer, function($message) use($trainer) {
                    $message->to($trainer['email'], $trainer['name']);
                    $message->subject('Your REPs membership is expiring.');
                });
            }
        }
        
        $expiring_nxt = Trainer::getExpiringTrainersNextMonth();
        $dataExNxt = array();
        
        if ($expiring_nxt->count() > 0) {
            
            $emails = array();
            
            foreach ($expiring_nxt as $itm) {
                $trainer = array(
                    'reps_id'=>$itm->reps_id,
                    'expiry_date'=>$itm->expiry_date,
                    'email'=>$itm->users->email, //$itm->users->email
                    'name'=>trim($itm->users->first_name) . ' ' . trim($itm->users->last_name)
                );
                $dataExNxt[] = $trainer;
                Mail::send('trainer.mail.almostExpiring2', $trainer, function($message) use($trainer) {
                    $message->to($trainer['email'], $trainer['name']);
                    $message->subject('Your REPs membership is expiring.');
                });
            }
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}