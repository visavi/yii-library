<?php

/**
 * This is the model class for table "books".
 *
 * The followings are the available columns in table 'books':
 * @property integer $id
 * @property string $title
 * @property integer $year
 * @property string $description
 * @property string $isbn
 * @property string $cover_image
 * @property integer $created_at
 */
class Book extends CActiveRecord
{
    public array $author_ids = [];
    public $cover_image_file = null;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, year', 'required'),
			array('year, created_at', 'numerical', 'integerOnly'=>true),
			array('title, cover_image', 'length', 'max'=>255),
			array('isbn', 'length', 'max'=>32),
            array('isbn', 'unique'),
			array('description', 'safe'),
            array('author_ids', 'safe'),
            array('cover_image_file', 'file', 'types' => 'jpg, jpeg, png, gif, webp', 'maxSize' => 5 * 1024 * 1024, 'allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, year, description, isbn, cover_image, created_at', 'safe', 'on'=>'search'),
		);
	}

    /**
     * After find
     */
    protected function afterFind()
    {
        if (!empty($this->authors)) {
            $this->author_ids = CHtml::listData($this->authors, 'id', 'id');
        }

        parent::afterFind();
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'authors' => array(self::MANY_MANY, 'Author', 'book_author(book_id, author_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'year' => 'Year',
			'description' => 'Description',
			'isbn' => 'Isbn',
			'cover_image' => 'Cover Image',
			'created_at' => 'Created At',
			'authors' => 'Авторы',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('isbn',$this->isbn,true);
		$criteria->compare('cover_image',$this->cover_image,true);
		$criteria->compare('created_at',$this->created_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Сохраняет связи книги с авторами
     */
    public function saveAuthors($authorIds): void
    {
        BookAuthor::model()->deleteAll('book_id = :book_id', [':book_id' => $this->id]);

        if (!empty($authorIds)) {
            foreach ($authorIds as $authorId) {
                $ba = new BookAuthor();
                $ba->book_id = $this->id;
                $ba->author_id = (int) $authorId;
                $ba->save(false);
            }
        }
    }

    /**
     * Сохраняет обложку книги
     */
    public function saveCoverImage(): void
    {
        if (!$this->cover_image_file instanceof CUploadedFile) {
            return;
        }

        $uploadDir = Yii::app()->basePath . '/../images/';
        $newFilePath = 'books/book_' . $this->id . '.' . $this->cover_image_file->getExtensionName();
        $newPath = $uploadDir . $newFilePath;


        if ($this->cover_image && file_exists($uploadDir . $this->cover_image)) {
            unlink($uploadDir . $this->cover_image);
        }

        $this->cover_image_file->saveAs($newPath);

        self::model()->updateByPk($this->id, ['cover_image' => $newFilePath]);
    }

    /**
     * Отправляет SMS всем подписчикам авторов этой книги
     */
    public function notifySubscribers(): void
    {
        foreach ($this->authors as $author) {
            $subscriptions = AuthorSubscription::model()->findAllByAttributes(['author_id' => $author->id]);

            foreach ($subscriptions as $sub) {
                $message = sprintf('Вышла новая книга автора %s: %s', $author->full_name, $this->title);
                if (mb_strlen($message, 'UTF-8') > 70) {
                    $message = mb_substr($message, 0, 67, 'UTF-8') . '...';
                }

                Yii::app()->smsPilot->send($sub->phone, $message);
            }
        }
    }
}
