<?php

namespace App\Tests\Entity;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
//php bin/phpunit tests/Entity/UserEntityTest.php --testdox
//php bin/phpunit tests/HomeTest.php --testdox
//php -S localhost:8000 -t public
class UserEntityTest extends KernelTestCase
{
    public function getEntity(): User{
        return (new User())
            ->setRoles(["ROLE_USER"])
            ->setName('user')
            ->setSurname('user')
            ->setEmail('user@gmail.com')
            ->setPassword('12345678');
    }
    public function assertHasErrors(User $user, int $number = 0){
        self::bootKernel();
        $error = self::$container->get('validator')->validate($user);
        $this->assertCount(0, $error);
    }
    public function testValidEntity(): void
    {
        $this->assertHasErrors($this->getEntity(),0);
    }
    public function testInvalidUserEntity(){
       /** $this->assertHasErrors($this->getEntity()->setEmail('khdfhdghsfkjr'),1);
        $this->assertHasErrors($this->getEntity()->setEmail('khdfh@dghsfkjr.com'),1);
        $this->assertHasErrors($this->getEntity()->setEmail('foulen@foulen.com'),1);
        $this->assertHasErrors($this->getEntity()->setEmail('foulen@foulen.com'),1);
        $this->assertHasErrors($this->getEntity()->setEmail('foulen@foulen.com'),1);*/
        $this->assertHasErrors($this->getEntity()->setEmail('foulen@foulen.com'),1);
    }

}
