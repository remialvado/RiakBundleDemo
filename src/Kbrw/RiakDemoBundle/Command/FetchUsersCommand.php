<?php
namespace Kbrw\RiakDemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchUsersCommand extends ContainerAwareCommand {
    
    /**
     * @var \Kbrw\RiakBundle\Model\Bucket\Bucket 
     */
    protected $userBucket;
    
    protected function configure()
    {
        $this
            ->setName('riak:demo:users:fetch')
            ->setDescription('Fetch 10 users from Riak')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->userBucket = $this->getContainer()->get("riak.cluster.backend")->getBucket("user");
        $userIds = $this->userBucket->search("fakeFullTextSearch:all")->getResult()->extract("id");
        $users = $this->userBucket->fetch($userIds);
        print_r($users->getDatas());
    }
}