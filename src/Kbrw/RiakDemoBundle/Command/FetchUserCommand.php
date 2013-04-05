<?php
namespace Kbrw\RiakDemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class FetchUserCommand extends ContainerAwareCommand {
    
    /**
     * @var \Kbrw\RiakBundle\Model\Bucket\Bucket 
     */
    protected $userBucket;
    
    protected function configure()
    {
        $this
            ->setName('riak:demo:user:fetch')
            ->setDescription('Fetch a user from Riak')
            ->addOption("id", null, InputOption::VALUE_REQUIRED, "User id")
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->userBucket = $this->getContainer()->get("riak.cluster.backend")->getBucket("user");
        print_r($this->userBucket->uniq($input->getOption("id"))->getContent());
    }
}