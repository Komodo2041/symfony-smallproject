<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Repository\InvoiceRepository;
use App\Entity\Invoice;
use App\Repository\CoreRepository;
use App\Entity\Core; 

class AppInvoiceCheckWarnings extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $invoiceRepository = $manager->getRepository(Invoice::class);
       $actual = $this->getIds($invoiceRepository->findUnpaidInvoice());
       $coreRepository = $manager->getRepository(Core::class);
       $old = $this->getIds($coreRepository->findUnpaidInvoiceWarning());      
 
       $nowWarning = array_diff($actual, $old);
       $toRemoveWarning = array_diff($old, $actual);
       $pendingWarning = array_intersect($actual, $old);
  
       foreach ($nowWarning as $id) {
           $core = new Core();
           $core->setInvoiceWarning($id, "Nieplacona faktura");
           $manager->persist($core);
           $manager->flush();
       }
       foreach ($toRemoveWarning as $id) { 
            $core = $coreRepository->findBy(['deleted' => 0, 'rel_id' => $id, 'type' => 'invoice']);
            $core = $core[0];
            if ($core) {
                $core->deleted();
                $manager->persist($core);
                $manager->flush();
            }
       }
      
       
       echo "Faktury:\n";
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
