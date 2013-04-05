<?php
namespace Kbrw\RiakDemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Kbrw\RiakDemoBundle\Model\User;

class PutUsersCommand extends ContainerAwareCommand {
    
    /**
     * @var \Kbrw\RiakBundle\Model\Bucket\Bucket 
     */
    protected $userBucket;
    
    protected function configure()
    {
        $this
            ->setName('riak:demo:users:put')
            ->setDescription('Put (create or update) 20 users into Riak')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->userBucket = $this->getContainer()->get("riak.cluster.backend")->getBucket("user");
        for ($i = 0; $i < 20; $i++) {
            $this->userBucket->put(array("remi$i" => new User("remi$i@gmail.com")));
        }
    }
}