<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function getCreatedDateAttribute()
    {
        // return $this->created_at->diffForHumans();
        return "#";
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 40;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'voteable');
    }

    public function votesAnswers()
    {
        return $this->morphedByMany(Answer::class, 'voteable');
    }

    public function voteQuesion(Question $question, $vote)
    {
        $voteQuesions = $this->voteQuestions();
        
        $this->_vote($voteQuesions, $question, $vote);
    }

    public function voteAnswer(Answer $answer, $vote)
    {
        $voteAnswer = $this->votesAnswers();

        $this->_vote($voteAnswer, $answer, $vote);
         
    }

    public function _vote($relationship, $model, $vote)
    {
        if($relationship->where('voteable_id', $model->id)->exists()) {
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        } else {
            $relationship->attach($model, ['vote' => $vote]);
        }

        $model->load('votes');
        $downVotes = (int) $model->downVotes()->sum('vote');
        $upVotes = (int) $model->upVotes()->sum('vote');

        $model->votes_count = $upVotes + $downVotes;

        $model->save();
    }

    
}
