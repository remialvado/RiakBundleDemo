<?php
namespace Kbrw\RiakDemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
use Kbrw\RiakDemoBundle\Model\User;

class PutUserCommand extends ContainerAwareCommand {
    
    /**
     * @var \Kbrw\RiakBundle\Model\Bucket\Bucket 
     */
    protected $userBucket;
    
    protected function configure()
    {
        $this
            ->setName('riak:demo:user:put')
            ->setDescription('Put (create or update) a user into Riak')
            ->addOption("id",    null, InputOption::VALUE_REQUIRED, "User id")
            ->addOption("email", null, InputOption::VALUE_REQUIRED, "User email")
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->userBucket = $this->getContainer()->get("riak.cluster.backend")->getBucket("user");
        $user = new User($input->getOption("id"), $input->getOption("email"));
        $this->userBucket->put(array($user->getId() => $user));
    }
}