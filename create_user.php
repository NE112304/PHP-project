<?php

use App\Entity\User;
use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/vendor/autoload.php';

(new Dotenv())->bootEnv(__DIR__.'/.env');

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$kernel->boot();
$container = $kernel->getContainer();

$em = $container->get('doctrine')->getManager();
$hasher = $container->get('security.user_password_hasher');

$user = $em->getRepository(User::class)->findOneBy(['email' => 'test@example.com']);

if (!$user) {
    $user = new User();
    $user->setEmail('test@example.com');
    // Encode the password (you could also specificy the salt if needed)
    $password = $hasher->hashPassword($user, 'password');
    $user->setPassword($password);

    $em->persist($user);
    $em->flush();

    echo "User created: test@example.com / password\n";
} else {
    echo "User already exists.\n";
}
