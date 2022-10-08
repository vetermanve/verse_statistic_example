<?php

namespace Stats\RunComponent;

use Stats\StatsConfig;
use Verse\Di\Env;
use Verse\Run\Component\RunComponentProto;
use Verse\StatisticClient\Encoder\JsonEncoder;
use Verse\StatisticClient\Stats;
use Verse\StatisticClient\StatsClientInterface;
use Verse\StatisticClient\Transport\LocalFileTransport;

class StatsClientSetup extends RunComponentProto
{

    public function run()
    {
        Env::getContainer()->setModule(StatsClientInterface::class, function () {
            $transport = new LocalFileTransport();
            $transport->setStatFilesDirectory(StatsConfig::getStatFilesDirectory());
            
            $client = new Stats();
            $client->setEncoder(new JsonEncoder());
            $client->setTransport($transport);
            
            return $client;  
        });
    }
}