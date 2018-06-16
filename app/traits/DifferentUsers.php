<?php
namespace Traits;
trait DifferentUsers
{
    public function showProgrammers() {
        $usersRoles = User::all();
        $users = [];
        for($i = 0; $i < count($usersRoles); $i++){
            if($usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'Programmer'){
                array_push($users, $usersRoles[$i]);
            }
        }

        return view('users.index')->with('users', $users);
    }

    public function showEmployees() {
        $usersRoles = User::all();
        $users = [];
        for($i = 0; $i < count($usersRoles); $i++){
            if($usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'TeamLeader' ||
                $usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'Programmer' ||
                $usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'ProjectMan'){
                array_push($users, $usersRoles[$i]);
            }
        }

        return view('users.index')->with('users', $users);
    }

    public function showClients() {
        if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('ProjectMan') || Auth::user()->hasRole('TeamLeader')){
            $usersRoles = User::all();
            $users = [];
            for($i = 0; $i < count($usersRoles); $i++){
                if($usersRoles[$i]->roles()->pluck('name')->implode(' ') === 'Client'){
                    array_push($users, $usersRoles[$i]);
                }
            }
        }
        else{
            $users = User::showUsers('Client');
        }

        return view('users.index')->with('users', $users);
    }
}