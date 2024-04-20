<?php

namespace App\EventListener;

use App\Event\PostSavedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class PostSavedListener implements EventSubscriberInterface
{
    private $kernel;
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public static function getSubscribedEvents()
    {
        return [
            PostSavedEvent::NAME => 'onPostSaved',
        ];
    }

    public function onPostSaved(PostSavedEvent $event)
    {
        $postData = $event->getPostData();
        $date = new \DateTime();
        $timeStamp = $date->format("y:m:d h:i:s");
        $filePath = $this->kernel->getProjectDir() .'/var/log/postData.txt';
        $success = file_put_contents($filePath, "[Time: ". $timeStamp . "]-". json_encode([$postData->getFirstName(), $postData->getLastName(), $postData->getEmail()]). PHP_EOL, FILE_APPEND);

        if ($success === false) {
            throw new \RuntimeException("Failed to write data to file: $filePath");
        }
    }
}