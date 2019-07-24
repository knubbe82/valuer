<?php

namespace App;

use App\Notifications\FirstJobPost;
use App\Notifications\ModeratorReview;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

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

    /**
     * @return HasMany
     */
    public function jobs() :HasMany
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Save a job for user
     * @param $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function saveAJob($data)
    {
        $input = $data;
        if ($this->checkIsAFirstJob()) {
            $this->notify(new ModeratorReview());
            $job = $this->jobs()->create($input);
            return $this->notifyModerator($this, $job);
        }
        $input['approved'] = true;
        return $this->jobs()->create($input);
    }

    /**
     * Check if this is a first job by user
     * @return bool
     */
    protected function checkIsAFirstJob()
    {
        if ($this->jobs()->count() == 0) {
            return true;
        }

        return false;
    }

    /**
     * Notify moderator about posting a first job
     * @param $user
     * @param $data
     */
    protected function notifyModerator($user, $data)
    {
        Notification::send(User::role('moderator')->get(), new FirstJobPost($user, $data));
    }
}
