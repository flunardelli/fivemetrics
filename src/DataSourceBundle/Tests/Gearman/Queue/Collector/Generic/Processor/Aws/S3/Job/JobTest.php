<?php
/**
 * Created by PhpStorm.
 * User: fontans
 * Date: 7/11/17
 * Time: 3:58 PM
 */

namespace DataSourceBundle\Tests\Gearman\Queue\Collector\Generic\Processor\Aws\S3\Job;

use DataSourceBundle\Entity\Aws\S3\Region\RegionProvider;
use DataSourceBundle\Gearman\Queue\Collector\Generic\Generic;
use DataSourceBundle\Gearman\Queue\Collector\Generic\Processor\Aws\S3\Job\Job;
use EssentialsBundle\Entity\Account\Account;
use EssentialsBundle\Entity\DateTime\DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Class JobTest
 * @package DataSourceBundle\Tests\Gearman\Queue\Collector\Generic\Processor\Aws\S3\Job
 */
class JobTest extends TestCase
{
    /**
     * @var Job
     */
    protected $job;

    public function setUp()
    {
        $account = new Account();
        $account->setUid('test');

        $this->job = new Job(
            $account,
            DateTime::createFromFormat(
                'Y-m-d H:i:s',
                '2017-08-07 14:10:00'
            ),
            RegionProvider::factory('us-east-1'),
            'key',
            'secret'
        );
    }

    /**
     * @test
     */
    public function getProcessor()
    {
        $class = sprintf(
            '%s\%s',
            Generic::PROCESSORS_NAMESPACE,
            $this->job->getProcessor()
        );

        $processor = new $class();

        $this->assertInstanceOf(
            $class,
            $processor
        );
    }
}
