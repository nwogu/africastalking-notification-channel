<?php

namespace Nwogu\AfricasTalking;

class AfricasTalkingMessage
{
    /**
     * @var string
     * 
     */
    protected $content;

    /**
     * @var string|null
     * 
     * 
     */
    protected $from = null;

    /**
     * Set the content for this message
     * 
     * 
     * @param string $content
     * @return this
     */
    public function content(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the sender info for this message
     * 
     * @param string $from
     * @return this
     */
    public function from(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get Message Content
     * 
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get Sender Info
     * 
     * @return string
     */
    public function getSender()
    {
        return $this->from;
    }
}