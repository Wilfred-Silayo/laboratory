<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getData(Request $request)
    {
        $uid = auth()->user()->id;

        $query = User::select(['id', 'title', 'name', 'phone', 'email'])
            ->where('id', '!=', $uid);

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(10);
        $pagination = view('pagination', ['users' => $users])->render();

        if ($request->expectsJson()) {
            return response()->json([
                'users' => $users,
                'pagination' => $pagination,
            ]);
        }

        return view('users.users');
    }




    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully', 'success' => true]);
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'title' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|unique:users,phone,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->all());

        return back()->with(['status' => 'User updated successfully', 'type' => 'success']);
    }
}
