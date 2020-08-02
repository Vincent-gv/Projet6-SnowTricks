<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    /**
     * @param $trick
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function findAllPaginated($trick, int $page, int $limit): Paginator
    {
        if (!is_numeric($page)) {
            throw new \InvalidArgumentException(
                'Incorrect page number'
            );
        }
        if (!is_numeric($limit)) {
            throw new \InvalidArgumentException(
                'Incorrect limit value'
            );
        }
        $query = $this->createQueryBuilder('c')
            ->addOrderBy('c.id', 'DESC')
            ->where('c.trick =' . $trick->getId())
            ->getQuery()
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return new Paginator($query);
    }
}
