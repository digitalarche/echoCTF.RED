<?php

namespace app\modules\challenge\models;

use Yii;
use yii\behaviors\AttributeTypecastBehavior;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property int $challenge_id
 * @property string|null $name
 * @property string|null $description
 * @property float|null $points
 * @property string $player_type
 * @property string|null $code
 * @property int $weight
 * @property string $ts
 * @property int|null $parent
 *
 * @property PlayerQuestion[] $playerQuestions
 * @property Challenge $challenge
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

    public function behaviors()
    {
        return [
            'typecast' => [
                'class' => AttributeTypecastBehavior::class,
                'attributeTypes' => [
                    'id' => AttributeTypecastBehavior::TYPE_INTEGER,
                    'challenge_id' => AttributeTypecastBehavior::TYPE_INTEGER,
                    'points' =>  AttributeTypecastBehavior::TYPE_INTEGER,
                ],
                'typecastAfterValidate' => true,
                'typecastBeforeSave' => true,
                'typecastAfterFind' => true,
          ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['challenge_id'], 'required'],
            [['challenge_id', 'weight', 'parent'], 'integer'],
            [['description', 'player_type'], 'string'],
            [['points'], 'number'],
            [['ts'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'challenge_id' => 'Challenge ID',
            'name' => 'Name',
            'description' => 'Description',
            'points' => 'Points',
            'player_type' => 'Player Type',
            'code' => 'Code',
            'weight' => 'Weight',
            'ts' => 'Ts',
            'parent' => 'Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayerQuestions()
    {
        return $this->hasMany(PlayerQuestion::class, ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswered()
    {
        return $this->hasOne(PlayerQuestion::class, ['question_id' => 'id'])->andOnCondition(['player_id'=>Yii::$app->user->id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChallenge()
    {
        return $this->hasOne(Challenge::class, ['id' => 'challenge_id']);
    }

    public function save($runValidation = true, $attributeNames = NULL)
    {
        throw new \LogicException("Saving is disabled for this model.");
    }
}
