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
        // Récupérer les utilisateurs en attente d'approbation
        $pendingUsers = User::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'pending_page');

        // Récupérer les utilisateurs actifs et suspendus
        $users = User::whereIn('status', ['active', 'suspended'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Dashebored_users', compact('pendingUsers', 'users'));
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

        if ($user->status !== 'pending') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cet utilisateur n\'est pas en attente d\'approbation.');
        }

        // Mettre à jour le statut de l'utilisateur
        $user->status = 'active';
        $user->save();

        // Envoi d'un email de confirmation (à implémenter)
        // Mail::to($user->email)->send(new AccountApproved($user));

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

        if ($user->status !== 'pending') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cet utilisateur n\'est pas en attente d\'approbation.');
        }

        // Supprimer les images associées au compte si elles existent
        if ($user->user_image) {
            Storage::delete('public/' . $user->user_image);
        }

        if ($user->identity_image) {
            Storage::delete('public/' . $user->identity_image);
        }

        // Supprimer l'utilisateur
        $user->delete();

        // Envoi d'un email de rejet (à implémenter)
        // Mail::to($user->email)->send(new AccountRejected($user));

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

        if ($user->status !== 'active') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cet utilisateur n\'est pas actif.');
        }

        // Mettre à jour le statut de l'utilisateur
        $user->status = 'suspended';
        $user->save();

        // Envoi d'un email de suspension (à implémenter)
        // Mail::to($user->email)->send(new AccountSuspended($user));

        return redirect()->route('admin.users.index')
            ->with('success', 'L\'utilisateur a été suspendu avec succès.');
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

        if ($user->status !== 'suspended') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Cet utilisateur n\'est pas suspendu.');
        }

        // Mettre à jour le statut de l'utilisateur
        $user->status = 'active';
        $user->save();

        // Envoi d'un email d'activation (à implémenter)
        // Mail::to($user->email)->send(new AccountActivated($user));

        return redirect()->route('admin.users.index')
            ->with('success', 'L\'utilisateur a été réactivé avec succès.');
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
