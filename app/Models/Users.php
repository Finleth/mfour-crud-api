<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    /**
     * Validate a set of user data
     * 
     * @param string  $userData first_name
     * @param string  $userData last_name
     * @param string  $userData email
     * @param boolean $requireFields : whether to require all fields or not
     * 
     * @return array $userData
     */
    static public function validateUser($userData, $requireFields = false)
    {
        $response = [
            'valid' => true,
            'errors' => []
        ];

        if (isset($userData['first_name'])) {
            // name regex taken from https://stackoverflow.com/questions/2385701/regular-expression-for-first-and-last-name
            if (!preg_match('/^[\p{L}\'][ \p{L}\'-]*[\p{L}]$/u', $userData['first_name'])) {
                $response['valid'] = false;
                $response['errors'][] = 'The name "' . $userData['first_name'] . '" is not a valid first name.';
            }
        } elseif ($requireFields) {
            $response['valid'] = false;
            $response['errors'][] = 'The "first_name" field is required.';
        }

        if (isset($userData['last_name'])) {
            // name regex taken from https://stackoverflow.com/questions/2385701/regular-expression-for-first-and-last-name
            if (!preg_match('/^[\p{L}\'][ \p{L}\'-]*[\p{L}]$/u', $userData['last_name'])) {
                $response['valid'] = false;
                $response['errors'][] = 'The name "' . $userData['last_name'] . '" is not a valid last name.';
            }
        } elseif ($requireFields) {
            $response['valid'] = false;
            $response['errors'][] = 'The "last_name" field is required.';
        }

        if (isset($userData['email'])) {
            // email regex taken from https://emailregex.com
            $emailRegex = '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/';
            
            if (!preg_match($emailRegex, $userData['email'])) {
                $response['valid'] = false;
                $response['errors'][] = 'The email "' . $userData['email'] . '" is not a valid email.';
            }
        } elseif ($requireFields) {
            $response['valid'] = false;
            $response['errors'][] = 'The "email" field is required.';
        }

        return $response;
    }
}
