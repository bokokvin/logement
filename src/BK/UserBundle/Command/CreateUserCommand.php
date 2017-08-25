<?php

namespace BK\UserBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use FOS\UserBundle\Command\CreateUserCommand as BaseCommand;
 
class CreateUserCommand extends BaseCommand
{
	
	 /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('bk:user:create')
            ->getDefinition()->addArguments(array(
                new InputArgument('nom', InputArgument::REQUIRED, 'The lastname'),
                new InputArgument('prenom', InputArgument::REQUIRED, 'The firstname')
            ))
        ;
        $this->setHelp(<<<EOT
// L'aide qui va bien
EOT
            );
    }
 
    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username   = $input->getArgument('username');
        $email      = $input->getArgument('email');
        $password   = $input->getArgument('password');
        $nom        = $input->getArgument('nom');
        $prenom     = $input->getArgument('prenom');
        $inactive   = $input->getOption('inactive');
        $superadmin = $input->getOption('super-admin');
 
        /** @var \FOS\UserBundle\Model\UserManager $user_manager */
        $user_manager = $this->getContainer()->get('fos_user.user_manager');
 
        /** @var \Acme\AcmeUserBundle\Entity\User $user */
        $user = $user_manager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
		$user->setNom($nom);
		$user->setPrenom($prenom);
        $user->setEnabled((Boolean) !$inactive);
        $user->setSuperAdmin((Boolean) $superadmin);
 
        $user_manager->updateUser($user);
 
        $output->writeln(sprintf('Created user <comment>%s</comment>', $username));
    }
 
    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        parent::interact($input, $output);
        if (!$input->getArgument('nom')) {
            $nom = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a lastname:',
                function($nom) {
                    if (empty($nom)) {
                        throw new \Exception('Lastname can not be empty');
                    }
 
                    return $nom;
                }
            );
            $input->setArgument('nom', $nom);
        }
        if (!$input->getArgument('prenom')) {
            $prenom = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a firstname:',
                function($prenom) {
                    if (empty($prenom)) {
                        throw new \Exception('Firstname can not be empty');
                    }
 
                    return $prenom;
                }
            );
            $input->setArgument('prenom', $prenom);
        }
    }
}