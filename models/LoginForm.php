<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Security;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 */
class LoginForm extends Model
{
    public string $username = '';
    public string $password = '';
    public bool $rememberMe = true;

    private User|null $_user = null;
    private bool $_userLoaded = false;

    public function __construct(
        private readonly Security $security,
        $config = []
    ) {
        parent::__construct($config);
    }

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            // Username và password bắt buộc nhập
            [['username', 'password'], 'required'],

            // RememberMe phải là kiểu boolean
            ['rememberMe', 'boolean'],

            // Kiểm tra mật khẩu
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Kiểm tra mật khẩu người dùng.
     */
    public function validatePassword(
        string $attribute,
        array|null $params
    ): void {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (
                !$user ||
                !$this->security->validatePassword(
                    $this->password,
                    $user->passwordHash
                )
            ) {
                $this->addError(
                    $attribute,
                    'Incorrect username or password.'
                );
            }
        }
    }

    /**
     * Đăng nhập người dùng.
     */
    public function login(): bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login(
                $this->getUser(),
                $this->rememberMe ? 3600 * 24 * 30 : 0
            );
        }

        return false;
    }

    /**
     * Tìm người dùng theo username.
     *
     * @return User|null
     */
    public function getUser(): User|null
    {
        if (!$this->_userLoaded) {
            $this->_user = User::findByUsername(
                $this->username
            );

            $this->_userLoaded = true;
        }

        return $this->_user;
    }
}
