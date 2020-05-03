<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Response;
use Inertia\ResponseFactory;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return Response|ResponseFactory
     */
    public function index(Request $request) {
        $users = $this->repository->search($request->q)->with('roles')->paginate($request->limit ?? 5);
        return inertia('Users/Index', [
            'users' => $users,
            'title' => 'Les utilisateurs'
        ]);
    }


    public function create() {

        return inertia('Users/Create', [
            'roles' => Role::all(),
        ]);
    }


    public function edit(User $user) {
        return inertia('Users/Edit', [
            'user' => $user->load('roles'),
            'roles' => Role::all(),
        ]);
    }


    /**
     * @param User $user
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(User $user, Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|string',
            'avatar' => 'file|nullable'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->avatar) {
            $user->avatar = $request->avatar;
        }
        $user->save();
        $user->update(['email' => $request->email, 'name' => $request->name, 'avatar' => $request->avatar]);
        $user->syncRoles(explode(',', $request->role));
        if($user->id === Auth::user()->id) {
            return back()->with('success', 'Opération effectuée !');

        }

        return redirect(route('users.index'))->with('success', 'Opération effectuée !');
    }


    /**
     * @param User $user
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user) {
        $user->delete();
        return back()->with('success', 'Opération effectuée !');
    }
}
