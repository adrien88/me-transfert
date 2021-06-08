<?php

namespace App;

class Mail
{
    private array $targets = [];
    public ?string $subject = null;
    public ?string $message = null;
    public ?bool $isHtml = true;
    public ?array $joined = [];

    /**
     * Set email to mail.
     * 
     *  @param string $email destination email
     *  @param string $name [optional] Name of user
     *  @return bool
     */
    public function setEmail(string $email, string $name = null): bool
    {
        if (preg_match('/^[\w.-]+\@[\w.-]+\.[\w]{2,}$/i', $email)) {
            $this->targets[$email] = $name ?? '';
            return true;
        }
        return false;
    }

    /**
     * 
     */
    public function getEmails()
    {
        return $this->targets;
    }
}
