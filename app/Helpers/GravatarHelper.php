<?php

namespace App\Helpers;

class GravatarHelper
{
    /**
     * Get the Gravatar URL for a given email.
     *
     * @param string $email The email address.
     * @param int $size The size of the Gravatar image (default is 80 pixels).
     * @param string $default The default image to show if the user does not have a Gravatar.
     * @param string $rating The rating of the image (default is 'g').
     * @return string The Gravatar URL.
     */
    public static function getGravatar($email, $size = 80, $default = 'mp', $rating = 'g')
    {
        $emailHash = md5(strtolower(trim($email)));
        return "https://www.gravatar.com/avatar/$emailHash?s=$size&d=$default&r=$rating";
    }
}
