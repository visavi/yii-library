<?php

class SubscribeForm extends CFormModel
{
    public int $author_id;
    public string $phone;

    public function rules(): array
    {
        return array(
            array('author_id, phone', 'required'),
            array('author_id', 'numerical', 'integerOnly' => true, 'min' => 1),
            array('phone', 'match', 'pattern' => '/^7\d{10}$/', 'message' => 'Телефон должен быть в формате +7XXXXXXXXXX'),

            array('phone', 'validateUnique'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(): array
    {
        return array(
            'id' => 'ID',
            'author_id' => 'Author',
            'phone' => 'Phone',
            'created_at' => 'Created At',
        );
    }

    /**
     * Validates the unique phone number for the author.
     */
    public function validateUnique($attribute, $params): void
    {
        if (!$this->hasErrors()) {
            $exists = AuthorSubscription::model()->exists(
                'author_id = :aid AND phone = :phone',
                [':aid' => $this->author_id, ':phone' => $this->phone]
            );
            if ($exists) {
                $this->addError('phone', 'Вы уже подписаны на этого автора!');
            }
        }
    }

    /**
     * Subscribes the author.
     */
    public function subscribe(): bool
    {
        if ($this->validate()) {
            $sub = new AuthorSubscription();
            $sub->author_id = $this->author_id;
            $sub->phone = $this->phone;

            return $sub->save(false);
        }

        return false;
    }

    /**
     * Validates the phone number.
     */
    protected function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->phone = preg_replace('/\D/', '', $this->phone);

            return true;
        }
        return false;
    }
}
