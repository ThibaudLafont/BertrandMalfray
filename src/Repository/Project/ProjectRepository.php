<?php
namespace App\Repository\Project;

use App\Entity\Project\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function findByNewTime($criteria)
    {
        $statement = "
            SELECT p
            FROM App:Project\Project p
            JOIN App:Project\Category c
            WHERE c.name = :cat_name
        ";

        // Execute the query and store results
        $projects = $this->getEntityManager()
            ->createQuery($statement)
            ->setParameter('cat_name', $criteria['cat_name'])
            ->getArrayResult();

        // Return result
        return $projects;

    }
}