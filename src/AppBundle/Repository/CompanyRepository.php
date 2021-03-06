<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Company;
use AppBundle\Entity\User;

/**
 * CompanyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompanyRepository extends \Doctrine\ORM\EntityRepository
{
    public function persist(Company $company)
    {
        $this->getEntityManager()->persist($company);
        $this->getEntityManager()->flush($company);

        return $company;
    }
}
