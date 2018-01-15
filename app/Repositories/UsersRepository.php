<?php

namespace Fresh\Nashemisto\Repositories;

use Fresh\Nashemisto\User;
use Gate;
use File;

class UsersRepository extends Repository
{
    /**
     * UsersRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * @param $request
     * @param $user
     * @return array
     */
    public function updateUser($request, $user)
    {
        if (Gate::denies('USERS_ADMIN', $this->model)) {
            abort(404);
        }

        $data = $request->except('_token');

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            array_forget($data, 'password');
        }

        $user->fill($data)->update();
        $user->roles()->sync($data['roles'] ?? []);

        return ['status' => 'Дані користувача оновлені'];
    }

    /**
     * @param $user
     * @return array
     */
    public function deleteUser($user)
    {
        if (Gate::denies('USERS_ADMIN', $this->model)) {
            abort(404);
        }

        if (File::exists(public_path('photos/' . $user->id))) {
            File::deleteDirectory(public_path('photos/' . $user->id));
        }

        if ($user->delete()) {
            return ['status' => 'Користувача видалено'];
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function addUser($request)
    {

        if (Gate::denies('USERS_ADMIN', $this->model)) {
            abort(404);
        }

        $data = $request->all();

        $user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if (!$user) {
            return ['status' => 'Помилка створення користувача.'];
        }

        $user->roles()->sync($data['roles'] ?? []);

        return ['status' => 'Користувача додано.'];

    }

    public function getRoles()
    {
        return \Fresh\Nashemisto\Role::all()->reduce(function ($returnRoles, $role) {
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        }, []);
    }
}

?>