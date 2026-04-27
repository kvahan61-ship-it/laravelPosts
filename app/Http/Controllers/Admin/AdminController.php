<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'superadmin')
            ->latest()
            ->get();
        $totalUsers = User::where('role', '!=', 'superadmin')->count();
        $blockedCount = User::where('role', '!=', 'superadmin')->where('is_blocked', true)->count();
        $activeCount = User::where('role', '!=', 'superadmin')->where('is_blocked', false)->count();

        return view('admin.admin', compact('totalUsers', 'blockedCount', 'activeCount', 'users'));
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return back()->with('success', 'Post deleted successfully.');
    }
    public function toggleBlock(User $user)
    {

        $user->update([
            'is_blocked' => !$user->is_blocked
        ]);
        if ($user->role === 'superadmin') {
            return back()->with('error', 'SuperAdmin-ին հնարավոր չէ արգելափակել:');
        }
        $message = $user->is_blocked ? 'Օգտատերը արգելափակվեց:' : 'Օգտատերը ապաարգելափակվեց:';

        return back()->with('success', $message);
    }


    public function destroyUser(User $user)
    {
        // 1. Գտնում ենք օգտատիրոջ բոլոր պոստերը
        foreach ($user->posts as $post) {
            // Ջնջում ենք պոստի նկարը սերվերից
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Ջնջում ենք պոստը
            $post->delete();
        }
        if (auth()->user()->role !== 'superadmin' && $user->role === 'admin') {
            return back()->with('error', 'Միայն SuperAdmin-ը կարող է ջնջել ադմիններին:');
        }

        // Պաշտպանություն SuperAdmin-ին ջնջելուց
        if ($user->role === 'superadmin') {
            return back()->with('error', 'SuperAdmin-ին հնարավոր չէ ջնջել:');
        }
        if ($user->role === 'superadmin') {
            return back()->with('error', 'SuperAdmin-ին հնարավոր չէ ջնջել:');
        }
        // 2. Ջնջում ենք օգտատիրոջ նկարը (եթե ունի avatar)
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // 3. Վերջնական ջնջում ենք օգտատիրոջը
        $user->delete();

        return back()->with('success', 'Օգտատերը և նրա բոլոր տվյալները հաջողությամբ ջնջվեցին:');
    }
    public function makeAdmin(User $user)
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        $user->update(['role' => 'admin']);
        return back()->with('success', $user->name . '-ը արդեն ադմին է:');
    }
    public function makeUser(User $user)
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        $user->update(['role' => 'user']);

        return back()->with('success', $user->name . '-ն այլևս ադմին չէ:');
    }
}
