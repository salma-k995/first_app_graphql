<?php

namespace App\GraphQL\Mutations;

use App\Notifications\TestNotification;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Mail;
use Hash;
use Illuminate\Support\Facades\DB;

final class UserMutator
{
    function userCreate($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::create($args);
        return $user;
    }

    function userUpdate($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::findOrFail($args['id']);
        $user->update($args['input']);
        $user->save();
        return $user;
    }

    function userDelete($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::findOrFail($args['id']);
        $user->delete();
        return $user;
    }

    function login($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::where('email', $args['email'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        return ['token' => $token, 'user' => $user];
    }


    function logout($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = $context->request->user();
        error_log(json_encode($user));
        $user->currentAccessToken()->delete();
        return "logout successfuly";
    }

    public function forgetPassword($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::where('email', $args['email'])->firstOrFail();
        $token = Str::random(6);
        DB::table('password_resets')->insert([
            'email' => $args['email'],
            'token' => $token,
            
            'created_at' => Carbon::now()
        ]);

        $user->notify(new TestNotification($token));
        return 'Your password updated successfuly';
    }

    function resetPassword($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $updatePassword = DB::table('password_resets')
            ->where('email', $args['email'])
            ->first();
        if ($args['token'] = $updatePassword->token) {
            $user = User::where('email', $args['email'])->first();
            $user->update($args['input']);
            $user->save();
            DB::table('password_resets')->where('email', $args['email'])->delete();
        }

        return $user;
    }

    function createUserRoles($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::findOrFail($args['id']);
        //$user = $context->request->user();
       // $roleIds = [1, 2];
        $user_roles = $user->roles()->attach($args['objects']);
        return $user;
    }
}
