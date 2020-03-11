<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *  fields={"username"},
 *  message="Le user existe deja"
 * )
*/
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min=5,
     *     max=10,
     *     minMessage="il faut plus de 5 caracteres",
     *     maxMessage="il faut moins de 10 caracteres"
     * )
    */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min=5,
     *     max=10,
     *     minMessage="il faut plus de 5 caracteres",
     *     maxMessage="il faut moins de 10 caracteres"
     * )
    */
    private $password;


    /**
     * @var string
     * @Assert\Length(
     *     min=5,
     *     max=10,
     *     minMessage="il faut plus de 5 caracteres",
     *     maxMessage="il faut moins de 10 caracteres"
     * )
     * @Assert\EqualTo(propertyPath="password", message="les mots de passe ne sont pas equivalents")
    x*/
    private $confirmPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }

    /**
     * @param string $confirmPassword
     * @return User
     */
    public function setConfirmPassword(?string $confirmPassword): User
    {
        $this->confirmPassword = $confirmPassword;
        return $this;
    }


    /**
     * @inheritDoc
     *
     * UPDATE user SET roles = 'ROLE_USER'
     */
    public function getRoles()
    {
        /* return ['ROLE_USER']; */
        return [$this->roles];
    }


    public function setRoles(?string $roles): self
    {
        // si le roles est null
        if($roles === null)
        {
            $this->roles = "ROLE_USER";
        }else{
            $this->roles = $roles;
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // return '';
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {

    }

}
