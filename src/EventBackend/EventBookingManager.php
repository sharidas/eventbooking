<?php


namespace App\EventBackend;


use Doctrine\ORM\EntityManagerInterface;
use function Doctrine\DBAL\Query\QueryBuilder;

class EventBookingManager
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Get the data from the DB, with offset and limit.
     * The limit and offset are set if that's not passed from the URL.
     * This method implements glimpse of pagination.
     *
     * @param int $offset starting from where to fetch the data
     * @param int $limit  maximum rows fetched in this transaction
     * @return mixed[]
     */
    public function getAll($offset = 0, $limit = 50) {
        $connection = $this->entityManager->getConnection();
        $qb = $connection->createQueryBuilder();
        $result = $qb->select('participation_id', 'employee_name', 'employee_mail',
                    'event_id', 'event_name', 'participation_fee', 'event_date', 'version')
            ->from('event_booking')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->execute();
        return $result->fetchAll();
    }
}
