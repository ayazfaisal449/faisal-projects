<?php namespace Cranium\Trainer\Models;

use Cranium\Trainer\Models\Trainer;
use Cranium\Trainer\Models\TrainerTemp;
use Cranium\Trainer\Models\SubscriptionPayment;
use Cranium\Trainer\Models\UserId;

class TrainerProvider {
	
    /**
     * Gets all trainers.
     *
     * @return Collection
     * @author Chris @ Cranium Creations
     */
    public function getAll()
    {
        return $this->createModel()->newQuery()
            ->get();
    }
     public function getTrainerByMemNum($mem_num){
        
        return $this->createModel()
                    ->newQuery()
                    ->where('reps_id', '=', $mem_num)->first();
     }
    
    public function getSubscriptionPayments($status = 0) {
        return $this->createSubscriptionModel()
                    ->newQuery()
                    ->where('processStatus','=',$status)
                    ->groupBy('email')
                    ->get();
    }
    
    public function getApprovedSubscriptionPaymentsByTrainerId($trainer_id) {
        return $this->createSubscriptionModel()
                    ->newQuery()
                    ->where('processStatus','=',1)
                    ->where('trainer_id','=',$trainer_id)
                    ->orderBy('created_at', 'DESC')
                    ->get();
    }
    
    public function getSubscriptionPaymentById($id) {
        return $this->createSubscriptionModel()
                    ->newQuery()
                    ->find($id);
    }
    
    public function getSubscriptionPaymentByOwner($trainer_id) {
        return $this->createSubscriptionModel()
                    ->newQuery()
                    ->where('trainer_id','=',$trainer_id)
                    ->get();
    }
    
    public function getSubscriptionPaymentByOwnerAndStatus($trainer_id, $status) {
        return $this->createSubscriptionModel()
                    ->newQuery()
                    ->where('trainer_id','=',$trainer_id)
                    ->where('processStatus','=',$status)
                    ->get();
    }
    
    public function getExpiringThisMonth() {
        return $this->createModel()->newQuery()->where('status_id','<>',3)
                    ->whereRaw('YEAR(expiry_date) = YEAR(NOW())', array())
                    ->whereRaw('MONTH(expiry_date) = MONTH(NOW())', array())
                    ->get();
    }
    
    public function getExpiringNextMonth() {
        return $this->createModel()->newQuery()->where('status_id','<>',3)
                    ->whereRaw('YEAR(expiry_date) = YEAR(NOW() + INTERVAL 1 MONTH)', array())
                    ->whereRaw('MONTH(expiry_date) = MONTH(NOW() + INTERVAL 1 MONTH)', array())
                    ->get();
    }
    
    public function getExpiringOneMonth() {
        return $this->createModel()->newQuery()
                    ->whereRaw('YEAR(expiry_date) = YEAR(NOW() + INTERVAL 1 MONTH)', array())
                    ->whereRaw('MONTH(expiry_date) = MONTH(NOW() + INTERVAL 1 MONTH)', array())
                    ->whereRaw('DAY(expiry_date) = DAY(NOW() + INTERVAL 1 MONTH)', array())
                    ->where('status_id','<>',3)
                    ->get();
    }
    
    public function getExpiringTwoMonth() {
        return $this->createModel()->newQuery()
                    ->whereRaw('YEAR(expiry_date) = YEAR(NOW() + INTERVAL 2 MONTH)', array())
                    ->whereRaw('MONTH(expiry_date) = MONTH(NOW() + INTERVAL 2 MONTH)', array())
                    ->whereRaw('DAY(expiry_date) = DAY(NOW() + INTERVAL 2 MONTH)', array())
                    ->where('status_id','<>',3)
                    ->get();
    }

    /**
     * Gets all trainers who are expired by a week.
     *
     * @return Collection of trainers
     */
    public function getExpiredByAWeek() {
        return $this->createModel()->newQuery()
                ->whereRaw('YEAR(expiry_date) = YEAR(NOW() - INTERVAL 2 WEEK)', array())
                ->whereRaw('MONTH(expiry_date) = MONTH(NOW() - INTERVAL 2 WEEK)', array())
                ->whereRaw('DAY(expiry_date) = DAY(NOW() - INTERVAL 2 WEEK)', array())
                ->where('status_id','<>',3)
                ->get();
    }
    
    public function getTrainerByStatusId($statuses) {
        
//        return $this->createModel()->newQuery()
//                    ->whereIn("status_id", $statuses)
//                    ->get();
        return $this->createModel()->newQuery()
                    ->whereRaw("status_id IN ($statuses)", array())
                    ->get();
    }
    
    public function getTrainerByStatusIdNotExpired($statuses) {
        
        return $this->createModel()->newQuery()
                    ->whereRaw("status_id IN ($statuses)", array())
                    ->whereRaw("expiry_date >= NOW()", array())
                    ->get();
    }

    /**
     * Gets an isntance of the trainer for querying.
     *
     * @return Trainer
     * @author Chris @ Cranium Creations
     */
    private function createModel()
    {
        return new Trainer();
    }
    
    private function createSubscriptionModel()
    {
        return new SubscriptionPayment();
    }
    
    public function getTrainerTemp($email) {
        return $this->createTrainerTempModel()->newQuery()
                    ->where('email', '=', $email)
                    ->get()->first();
    }
    
    public function createTrainerTempModel()
    {
        return new TrainerTemp();
    }
}