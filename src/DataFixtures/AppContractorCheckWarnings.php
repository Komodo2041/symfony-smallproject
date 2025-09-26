<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Repository\InvoiceRepository;
use App\Entity\Invoice;
use App\Repository\CoreRepository;
use App\Entity\Core; 

class AppContractorCheckWarnings extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $invoiceRepository = $manager->getRepository(Invoice::class);
       $actual = $this->getIds($invoiceRepository->findContractorUnpaidInvoice());
     
       $coreRepository = $manager->getRepository(Core::class);
       $old = $this->getIds($coreRepository->findUnpaidContractorWarning());      
 
       $nowWarning = array_diff($actual, $old);
       $toRemoveWarning = array_diff($old, $actual);
       $pendingWarning = array_intersect($actual, $old);
  
       foreach ($nowWarning as $id) {
           $core = new Core();
           $core->setContractorWarning($id, "Klient ma duzo nieoplaconych faktur");
           $manager->persist($core);
           $manager->flush();
       }
       foreach ($toRemoveWarning as $id) { 
            $core = $coreRepository->findBy(['deleted' => 0, 'rel_id' => $id, 'type' => 'contractor']);
            $core = $core[0];
            if ($core) {
                $core->deleted();
                $manager->persist($core);
                $manager->flush();
            }
       }
      
       
       echo "Kontraktorzy :\n";
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
