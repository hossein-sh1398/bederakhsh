<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Like;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Discount\Entities\Discount;
use App\User;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
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

        if ( $this->checkCountVote( $count, $data['count_vote'] ) ) {

            collect( range( 1, $data['count_vote'] ) )

                ->each( function() use ($data) {

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

    private function checkCountVote($count, $count_vote)
    {
        return ( $count < 5 ) && ( $count + $count_vote <= 5 );
    }


    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function permishns()
    {
        return $this->belongsToMany(Permishn::class);
    }

    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }

}
