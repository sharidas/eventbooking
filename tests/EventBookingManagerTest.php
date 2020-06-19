<?php

namespace App\Tests;

use App\EventBackend\EventBookingManager;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class EventBookingManagerTest extends TestCase
{
    private $entityManager;
    private $eventBookingManager;
    protected function setUp()
    {
        parent::setUp();

        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->eventBookingManager = new EventBookingManager($this->entityManager);
    }

    public function providesJsonData() {
        $data = '[
              {
                "participation_id": "1",
                "employee_name": "Reto Fanzen",
                "employee_mail": "reto.fanzen@no-reply.rexx-systems.com",
                "event_id": 1,
                "event_name": "PHP 7 crash course",
                "participation_fee": "0",
                "event_date": "2019-09-04 08:00:00",
                "version": "1.0.17+42"
              },
              {
                "participation_id": "2",
                "employee_name": "Reto Fanzen",
                "employee_mail": "reto.fanzen@no-reply.rexx-systems.com",
                "event_id": 2,
                "event_name": "International PHP Conference",
                "participation_fee": "1485.99",
                "event_date": "2019-10-21 10:00:00",
                "version": "1.0.17+59"
              },
              {
                "participation_id": "3",
                "employee_name": "Leandro Bußmann",
                "employee_mail": "leandro.bussmann@no-reply.rexx-systems.com",
                "event_id": 2,
                "event_name": "International PHP Conference",
                "participation_fee": "657.50",
                "event_date": "2019-10-21 10:00:00",
                "version": "1.0.15+83"
              },
              {
                "participation_id": "4",
                "employee_name": "Hans Schäfer",
                "employee_mail": "hans.schaefer@no-reply.rexx-systems.com",
                "event_id": 1,
                "event_name": "PHP 7 crash course",
                "participation_fee": "0",
                "event_date": "2019-09-04 06:00:00",
                "version": "1.0.17+65"
              },
              {
                "participation_id": "5",
                "employee_name": "Mia Wyss",
                "employee_mail": "mia.wyss@no-reply.rexx-systems.com",
                "event_id": 1,
                "event_name": "PHP 7 crash course",
                "participation_fee": "0",
                "event_date": "2019-09-04 06:00:00",
                "version": "1.0.17+65"
              },
              {
                "participation_id": "6",
                "employee_name": "Mia Wyss",
                "employee_mail": "mia.wyss@no-reply.rexx-systems.com",
                "event_id": 2,
                "event_name": "International PHP Conference",
                "participation_fee": "657.50",
                "event_date": "2019-10-21 08:00:00",
                "version": "1.1.3"
              },
              {
                "participation_id": "7",
                "employee_name": "Reto Fanzen",
                "employee_mail": "reto.fanzen@no-reply.rexx-systems.com",
                "event_id": 3,
                "event_name": "code.talks",
                "participation_fee": "474.81",
                "event_date": "2019-10-24 08:00:00",
                "version": "1.0.17+59"
              },
              {
                "participation_id": "8",
                "employee_name": "Hans Schäfer",
                "employee_mail": "hans.schaefer@no-reply.rexx-systems.com",
                "event_id": 3,
                "event_name": "code.talks",
                "participation_fee": "534.31",
                "event_date": "2019-10-24 06:00:00",
                "version": "1.1.3"
              }
        ]';
        $data = json_decode($data, true);

        return [
          [$data],
        ];
    }

    /**
     * Test to fetch the versions belonging to Europe/Berlin Timezone.
     * Here data is fetched and compared using php's version_compare method.
     *
     * @param $jsonData
     * @dataProvider providesJsonData
     */
    public function testBerlinTimeZone($jsonData) {
        $timeBerlin = [];
        $versionToCompare = "1.0.17+60";
        foreach ($jsonData as $datum) {
            if (version_compare($datum['version'], $versionToCompare, 'le')) {
                $timeBerlin[] = $datum;
            }
        }
        $this->assertEquals(4, count($timeBerlin));
    }

    /**
     * Test to fetch the versions belonging to UTC Timezone.
     * Here data is fetched and compared using php's version_compare method.
     *
     * @param $jsonData
     * @dataProvider providesJsonData
     */
    public function testUTCTimeZone($jsonData) {
        $timeUTC = [];
        $versionToCompare = "1.0.17+60";
        foreach ($jsonData as $datum) {
            if (version_compare($datum['version'], $versionToCompare, 'gt')) {
                $timeUTC[] = $datum;
            }
        }

        $this->assertEquals(4, count($timeUTC));
    }
}

