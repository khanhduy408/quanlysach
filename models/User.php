<?php

declare(strict_types=1);

namespace app\models;

use yii\base\BaseObject;
use yii\web\IdentityInterface;

class User extends BaseObject implements IdentityInterface
{
    private $_id;
    public string $username = '';
    public string $passwordHash = '';
    public string $authKey = '';
    public string $accessToken = '';
    public string $role = 'viewer';
    private static array $_users = [
       '100' => [
            'id' => '100',
            'username' => 'admin',
            'passwordHash' => '$2y$13$gYAywKSkhfZDq9FLNdm7buKnvlRxDexf5xipSMAxQPDUxpaptmZJu',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
            'role' => 'admin',
        ],
       '101' => [
            'id' => '101',
            'username' => 'demo',
            'passwordHash' => '$2y$13$alRLq1PGVMlGYwS/Y3iy3ewQns1Z8ol8Iq6Zb5k7ZwEhblA1aL29y',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
            'role' => 'viewer',
        ],
    ];
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): static|null
    {
        return isset(self::$_users[$id]) ? new static(self::$_users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): static|null
    {
        foreach (self::$_users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername(string $username): static|null
    {
        foreach (self::$_users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): string|null
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }
}
