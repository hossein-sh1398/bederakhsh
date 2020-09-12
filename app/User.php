<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Like;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // protected $with = ['posts', 'comments'];
    // protected $withCount = ['posts', 'comments'];

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

    //
    public $dates = ['deleted_at'];

   
    public function comments()
    {
        return $this
            ->hasMany(Comment::class);
    }

    //دریافت تمام لایکهای کاربر
    public function likes()
    {
        return $this
            ->hasMany(Like::class);
    }

    // چک میکنه این که آیا کاربر در باره فلان مدل لایکی دارد
    public function liked( $subject )
    {
        return !! $this
            ->likes()
            ->where( [ 
                'likeable_id' => $subject->id, 
                'likeable_type' => get_class( $subject ) 
            ] )
            ->count();
    }


    public function votes()
    {
        return $this
            ->hasMany(Vote::class);
    }


    public function vote(array $data)
    {
        $count = $this
            ->votes()
            ->where( 'stage_id', $data[ 'stage' ] )
            ->count();

        if ( ( $count < 5 ) && ( $count + $data['count_vote'] <= 5 ) ) {

            collect( range( 1, $data['count_vote'] ) )

                ->each(function() use($data){

                    $this
                        ->votes()
                        ->create( [
                            'stage_id' => $data[ 'stage' ], 
                            'campaign_id' => $data[ 'campaign' ] 
                        ] );
                    
                });

            return true;

        } else {
            return false;
        }
    }



}
