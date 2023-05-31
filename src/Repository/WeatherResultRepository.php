<?php

namespace App\Repository;

use App\Entity\WeatherResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WeatherResult>
 *
 * @method WeatherResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherResult[]    findAll()
 * @method WeatherResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherResult::class);
    }

    public function add(WeatherResult $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(WeatherResult $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findLastTemperatureResults(string $limit)
    {
        return $this->findBy([], ['checkTime'=>'DESC'], $limit);
        
    }
}
