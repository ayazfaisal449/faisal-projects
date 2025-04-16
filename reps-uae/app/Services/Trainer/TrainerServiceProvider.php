<?php namespace Services\Trainer;

use Illuminate\Support\ServiceProvider;

use Services\Trainer\TrainerService;
use Models\Users\UsersProvider;
use Cranium\Trainer\Models\TrainerProvider;
use Cranium\TrainerMedia\Models\TrainerMediaProvider;
use Cranium\TrainerQualification\Models\TrainerQualificationProvider;
use Cranium\TrainerRegistrationCategory\Models\TrainerRegistrationCategoryProvider;
use Cranium\RegistrationCategory\Models\RegistrationCategoryProvider;
use Cranium\TrainerWorkExperience\Models\TrainerWorkExperienceProvider;
use Cranium\TrainerUpgradeStatus\Models\TrainerUpgradeStatusProvider;
use Cranium\TrainerUpgradeLevel\Models\TrainerUpgradeLevelProvider;

class TrainerServiceProvider extends ServiceProvider {

    public function register()
    {
       $this->app->bind('trainer', function()
        {
            return new TrainerService(new UsersProvider(), new TrainerMediaProvider(), 
                new TrainerQualificationProvider(), new TrainerRegistrationCategoryProvider(),
                new RegistrationCategoryProvider(), new TrainerWorkExperienceProvider(),
                new TrainerUpgradeStatusProvider(), new TrainerUpgradeLevelProvider(),
                new TrainerProvider());
        });
    }

}