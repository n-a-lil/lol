<?php
    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use App\Models\Post;
    use App\Models\User;

    class PostController extends Controller
    {
        public function showLayout()
        {
            $userId = session('user_id'); 

            if ($userId) {
                $user = User::find($userId); 
                $userName = $user->name; 
                return view('post.layout', ['userName' => $userName]); 
            } 
        }

        public function showLayout1()
        {
        return view('post.layout1');
        }
        
    }

?>