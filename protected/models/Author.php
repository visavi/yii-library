<?php

/**
 * This is the model class for table "authors".
 *
 * The followings are the available columns in table 'authors':
 * @property integer $id
 * @property string $full_name
 */
class Author extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'authors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name', 'required'),
			array('full_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, full_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'books' => array(self::MANY_MANY, 'Book', 'book_author(author_id, book_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'full_name' => 'Full Name',
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
		$criteria->compare('full_name',$this->full_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Возвращает топ-10 авторов по количеству книг за указанный год
     */
    public static function getTopAuthorsByYear(int $year): array
    {
        return Yii::app()->db->createCommand()
            ->select('a.id, a.full_name, COUNT(b.id) as book_count')
            ->from('authors a')
            ->join('book_author ba', 'a.id = ba.author_id')
            ->join('books b', 'ba.book_id = b.id')
            ->where('b.year = :year', [':year' => $year])
            ->group('a.id, a.full_name')
            ->order('book_count DESC')
            ->limit(10)
            ->queryAll();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Author the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
