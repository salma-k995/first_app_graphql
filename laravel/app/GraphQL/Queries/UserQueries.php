<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class UserQueries
{

    function users($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $users = User::all();
        return $users;
    }


    function user($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::findOrFail($args['id']);;
        return $user;
    }


    function userRoles($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user = User::findOrFail($args['id']);
        //$user = $context->request->user();
        $roles = $user->roles();
        return $user;
    }
}
