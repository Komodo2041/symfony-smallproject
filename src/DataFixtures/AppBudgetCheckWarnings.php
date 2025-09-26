<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
 
use App\Repository\BudgetRepository;
use App\Entity\Budget;
use App\Repository\CoreRepository;
use App\Entity\Core; 

class AppBudgetCheckWarnings extends Fixture
{
    public function load(ObjectManager $manager): void
    {
 
       $budgetRepository = $manager->getRepository(Budget::class);
       $actual = $this->getIds($budgetRepository->findminusbudget());
       $coreRepository = $manager->getRepository(Core::class);
       $old = $this->getIds($coreRepository->findBudgetMinusWarning());      
 
       $nowWarning = array_diff($actual, $old);
       $toRemoveWarning = array_diff($old, $actual);
       $pendingWarning = array_intersect($actual, $old);
  
       foreach ($nowWarning as $id) {
           $core = new Core();
           $core->setBudgetWarning($id, "Budget minus");
           $manager->persist($core);
           $manager->flush();
       }
       foreach ($toRemoveWarning as $id) { 
            $core = $coreRepository->findBy(['deleted' => 0, 'rel_id' => $id, 'type' => 'budget']);
            $core = $core[0];
            if ($core) {
                $core->deleted();
                $manager->persist($core);
                $manager->flush();   
            }
       }
      
       
       echo "Budżet:\n";
       echo "Dodano ".count($nowWarning)." ostrzerzeń\n"; 
       echo "Usunięto ".count($toRemoveWarning)." ostrzerzeń\n"; 
       echo "Utrzymano ".count($pendingWarning)." ostrzerzeń\n\n";
       
    }

    private function getIds($table) {
        $res = [];
        foreach ($table as $row) {
            $res[] = $row['id'];
        }
        return $res;
    }
}
