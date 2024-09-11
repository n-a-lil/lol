<?
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friends;

class FriendsController extends Controller
{
    public function showFriends()
    {
        $userId = session('user_id');

        if ($userId) {
            $friends = Friend::where('user_id', $userId)->get();
            return view('friends', ['friends' => $friends]);
        } 
    }

}
