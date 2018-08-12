<?php

namespace App\Repository;

use App\Entity\Moving;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;



class MovingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Moving::class);
    }

    protected function paginate(QueryBuilder $qb, $limit = 20, $offset = 0)
    {
        if (0 == $limit) {
            throw new \LogicException('$limit & $offstet must be greater than 0.');
        }

        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));

        $currentPage = ceil(($offset + 1)/ $limit);
        $pager->setCurrentPage($currentPage);
        $pager->setMaxPerPage((int) $limit);

        return $pager;
    }
  
  
    public function search( $filter, $order = 'ASC', $limit = 20, $offset = 0)
    {
        $qb = $this 
                ->createQueryBuilder('m')
                ->select('m')
                ->orderBy('m.id', $order )
            ;
        if($filter  ){
            $qb
                ->where('m.name LIKE ?1')
                ->setParameter(1, '%'.$filter.'%');
        }

    return $this->paginate($qb, $limit, $offset);

    }
}