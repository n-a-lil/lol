<?
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }
    
    public function musics()
    {
        return $this->hasMany(Music::class);
    }

}
