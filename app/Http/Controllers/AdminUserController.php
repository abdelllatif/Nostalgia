<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $totalUsers = User::where('role', '!=', 'admin')->count();
        $activeUsers = User::where('role', '!=', 'admin')
            ->where('status', 'avtive')
            ->count();
        $suspendedUsers = User::where('role', '!=', 'admin')
            ->where('status', 'suspended')
            ->count();
        $pendingUsers = User::where('role', '!=', 'admin')
            ->where('status', 'waiting_to_approved')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $currentSection = session('current_section', 'pending');

        return view('Dashebored_users', compact('users', 'totalUsers', 'activeUsers', 'suspendedUsers', 'pendingUsers', 'currentSection'));
    }

    /**
     * Approve a pending user registration.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $user = User::findOrFail($id);

        if ($user->status !== 'waiting_to_approved') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cet utilisateur n\'est pas en attente d\'approbation.');
        }

        $user->status = 'avtive';
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'L\'utilisateur a été approuvé avec succès.');
    }

    /**
     * Reject a pending user registration.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject($id)
    {
        $user = User::findOrFail($id);

        if ($user->status !== 'waiting_to_approved') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cet utilisateur n\'est pas en attente d\'approbation.');
        }

        if ($user->user_image) {
            Storage::disk('public')->delete($user->user_image);
        }
        if ($user->identity_image) {
            Storage::disk('public')->delete($user->identity_image);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'La demande d\'inscription a été rejetée.');
    }

    /**
     * Suspend an active user account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function suspend($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Vous ne pouvez pas suspendre un administrateur.');
        }

        if ($user->status !== 'avtive') {
            return redirect()->back()->with('error', 'Seuls les utilisateurs actifs peuvent être suspendus.');
        }

        $user->status = 'suspended';
        $user->save();

        session()->put('current_section', 'active');
        return redirect()->back()->with('success', 'Utilisateur suspendu avec succès.');
    }

    /**
     * Activate a suspended user account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Vous ne pouvez pas modifier le statut d\'un administrateur.');
        }

        if ($user->status !== 'suspended') {
            return redirect()->back()->with('error', 'Seuls les utilisateurs suspendus peuvent être réactivés.');
        }

        $user->status = 'avtive';
        $user->save();

        session()->put('current_section', 'active');
        return redirect()->back()->with('success', 'Utilisateur réactivé avec succès.');
    }

    /**
     * Display the specified user's information.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.view', compact('user'));
    }
}
